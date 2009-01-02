<?php
require_once(PHPUNIT_ROOT . 'TestResult.php');
require_once(PHPUNIT_ROOT . 'TestCase.php');

class TestSuite
{
    var $files;

    function TestSuite()
    {
        $this->files = array();
    }

    function addFile($file)
    {
        if (file_exists($file))
        {
            array_push($this->files, $file);
            return true;
        }
        return false;
    }

    function addDirectory($directory, $pattern = '/(.+)Test.php/')
    {
        $added  = 0;
        if (!is_dir($directory))
        {
            return $added;
        }
        $handle = opendir($directory);
        while (false !== ($file = readdir($handle)))
        {
            if (preg_match($pattern, $file) &&
                $this->addFile($directory . '/'. $file))
            {
                ++$added;
            }
        }
        closedir($handle);
        return $added;
    }

    function run()
    {
        $GLOBALS['PHPUNIT_TEST_RESULT'] =& new TestResult();;
        foreach($this->files as $file)
        {
            include_once($file);
            $class =  basename($file, '.php');
            $test  =& new $class;
            $test->run($class, $GLOBALS['PHPUNIT_TEST_RESULT']);
        }
        return $GLOBALS['PHPUNIT_TEST_RESULT'];
    }
}
?>
