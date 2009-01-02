<?php
/*!
 * Sample PHPUnit invocation file.
 */

define('PHPUNIT_ROOT', '/data/www/lib/phpunit-2_0/');
define('ECLIPSE_ROOT', '/data/www/lib/eclipse-3_3/');

define('CODE_ROOT'   , '/data/www/lib/eclipse-3_3/');
define('TEST_ROOT'   , CODE_ROOT . 'tests/');

require_once(PHPUNIT_ROOT . 'TestSuiteCreator.php');
require_once(PHPUNIT_ROOT . 'TestReport.php');

$creator =& new TestSuiteCreator;
$creator->addSuite(
    CODE_ROOT,
    TEST_ROOT
);
$suite  =& $creator->getSuite();
$report =& new TestReport(
    $suite->run(), 
    $creator->getMissingTestFiles()
);
$report->show('Eclipse 3.3 Unit Tests');
?>
