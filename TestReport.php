<?php
require_once(ECLIPSE_ROOT . 'ArrayIterator.php');
require_once(ECLIPSE_ROOT . 'Loop.php');

class TestReport
{
    var $testResult;
    var $missingFiles;

    function TestReport(&$testResult, $missingFiles = array())
    {
        $this->testResult   =& $testResult;
        $this->missingFiles =  $missingFiles;
    }

    function show($title = 'PHP Unit Test Result')
    {
        $result    =& $this->testResult;
        $total     =  $result->getTotal();
        $successes =  $result->getCount(PHPUNIT_TESTRESULT_SUCCESS);
        $failures  =  $result->getCount(PHPUNIT_TESTRESULT_FAILURE);
        $missing   =  $this->missingFiles;
        include(PHPUNIT_ROOT . 'report.php');
    }
}

class TestResultPrinter extends LoopManipulator
{
    function TestResultPrinter(&$result)
    {
        $this->result =& $result;
    }

    function prepare()
    {
        echo "    <h2>Full report</h2>\n";
        echo "    <table>\n";
    }

    function current(&$element)
    {
        $name = preg_replace('/(.+)Test/', '$1', $element);
        echo "      <tr>\n";
        echo "        <th colspan=\"2\">", $name, "</th>\n";
        echo "      </tr>\n";
        Loop::run(
            new ArrayIterator($this->result->getTest($element)),
            new MethodResultPrinter(array('dark', 'light'))
        );
    }

    function finish()
    {
        echo "    </table>\n";
    }
}

class MethodResultPrinter extends LoopManipulator
{
    var $styles;
    var $index;
    var $count;

    function MethodResultPrinter($styles)
    {
        $this->styles = $styles;
        $this->index  = 0;
        $this->count  = count($styles);
    }

    function current($element)
    {
        $name        = preg_replace('/test(.+)/', '$1', $element['name']);
        $css         = $this->styles[$this->index];
        $this->index = ($this->index + 1) % $this->count;
        echo "      <tr>\n";
        echo "        <td class=\"$css\" width=\"10%\">$name</td>\n";
        echo "        <td class=\"$css\">${element['message']}</td>\n";
        echo "      </tr>\n";
    }
}

class MissingTestsPrinter extends LoopManipulator
{
    function prepare()
    {
        echo <<<EOF_HEADER
    <h2>Missing test units</h2>
    <p>
      This test suite was generated automatically from a set of source files.
      Not every file in this set has a corresponding test unit. For a complete
      test suite, implement test units for the following classes, so that this
      message will disappear:
    </p>
    <ul>

EOF_HEADER;
    }

    function current(&$element)
    {
        echo "      <li>", basename($element, '.php'), "</li>\n";
    }

    function finish()
    {
        echo "    </ul>\n";
    }
}
?>
