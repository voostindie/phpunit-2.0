<?php
require_once(PHPUNIT_ROOT . 'TestSuite.php');

class TestSuiteCreator
{
    var $testSuite;
    var $sourceDirectory;
    var $testDirectory;
    var $missingFiles;

    function TestSuiteCreator()
    {
        $this->testSuite    =& new TestSuite;
        $this->missingFiles =  array();
        unset($this->sourceDirectory);
        unset($this->testDirectory);
    }

    /**
     * \private
     */
    function addTest($sourceFile)
    {
        $testFile  = $this->testDirectory . '/' .
            preg_replace('/(.+)\.php/', '$1Test.php', $sourceFile);
        if (file_exists($testFile))
        {
            include_once($this->sourceDirectory . '/' . $sourceFile);
            $this->testSuite->addFile($testFile);
            return true;
        }
        array_push($this->missingFiles, $sourceFile);
        return false;
    }

    function addSuite($sourceDirectory, $testDirectory)
    {
        $added = 0;
        if (!is_dir($sourceDirectory) || !is_dir($testDirectory))
        {
            return $added;
        }
        $this->sourceDirectory = $sourceDirectory;
        $this->testDirectory   = $testDirectory;
        $handle = opendir($this->sourceDirectory);
        while (false !== ($file = readdir($handle)))
        {
            if (!preg_match('/(.+)\.php/i', $file))
            {
                continue;
            }
            if ($this->addTest($file))
            {
                ++$added;
            }
        }
        return $added;
    }

    function &getSuite()
    {
        return $this->testSuite;
    }

    function getMissingTestFiles()
    {
        sort($this->missingFiles);
        return $this->missingFiles;
    }
}
?>
