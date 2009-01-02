<?php
require_once(PHPUNIT_ROOT . 'Assert.php');

class TestCase
{
    // MANIPULATORS

    function run($class, &$result) {
        $result->setActiveTest($class);
        $this->setUp();
        $methods = get_class_methods($this);
        foreach($methods as $method) {
            if (preg_match('/test(.+)/', $method)) {
                $result->setActiveMethod($method);
                $this->$method();
            }
        }
        $this->tearDown();
    }

    /**
     * Set up the fixture to use in this test
     */
    function setUp() {
    }

    /**
     * Tear down the fixture used in this test
     */
    function tearDown() {
    }
}
?>
