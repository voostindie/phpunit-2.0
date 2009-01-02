<?php

define('PHPUNIT_TESTRESULT_SUCCESS', 0);
define('PHPUNIT_TESTRESULT_FAILURE', 1);

class TestResult
{
    function TestResult()
    {
        $this->tests     = array();
        $this->results   = array_fill(0, 2, 0);
        unset($this->test);
        unset($this->method);
    }

    function setActiveTest($test)
    {
        $this->tests[$test] =  array();
        $this->test         =& $this->tests[$test];
    }

    function setActiveMethod($method)
    {
        $this->test[$method] =  array('name' => $method);
        $this->method        =& $this->test[$method];
    }

    function setResult($type, $message = '')
    {
        $this->method['type']    = $type;
        $this->method['message'] = $message;
        ++$this->results[$type];
    }

    function getTotal()
    {
        return array_sum($this->results);
    }

    function getCount($type)
    {
        return $this->results[$type];
    }

    function getTests()
    {
        return array_keys($this->tests);
    }

    function &getTest($name)
    {
        return $this->tests[$name];
    }
}
?>
