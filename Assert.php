<?php
/**
 * Class Assert has only static methods that can be used to check conditions
 * and trigger errors if they are not met.
 */
class Assert
{
    function failure($message)
    {
        $GLOBALS['PHPUNIT_TEST_RESULT']->setResult(
            PHPUNIT_TESTRESULT_FAILURE,
            $message
        );
    }

    function success()
    {
        $GLOBALS['PHPUNIT_TEST_RESULT']->setResult(
            PHPUNIT_TESTRESULT_SUCCESS,
            'OK'
        );
    }

    /**
     * Check a boolean value and generate a fatal error if it is \c false. If
     * no error message is specified, the default is 'Assertion failed.'.
     * \param $bool the boolean value to check
     * \param the error message to generate if \c $bool evaluates to \c false
     * \static
     */
	function assert($bool, $message = '')
	{
		if (!$bool)
		{
			if ($message == '')
			{
				$message = "Assertion failed.";
			}
            Assert::failure($message);
            return;
		}
        Assert::success();
	}

    /**
     * Compare two values and trigger a warning if they are unequal. If no error
     * message is specified, the two values will be printed.
     * \param $value1 the first value
     * \param $value2 the second value
     * \param the error message to generate if \c $value1 \c != \c $value2
     * \static
     */
	function equals($value1, $value2, $message = '')
	{
		if ($value1 != $value2)
		{
			if ($message == '')
			{
				$message = "Assertion failed: <b>'$value1' != '$value2'</b>";
			}
			Assert::failure($message);
            return;
		}
        Assert::success();
	}

    /**
     * Check if a value is \c true and trigger a warning if this is not the case.
     * \param $bool the value to check for true-ness
     * \param $message the error message to generate if \c $bool equals \c false
     * \static
     */
    function equalsTrue($bool, $message = '')
	{
    	Assert::equals($bool, true, $message);
    }

    /**
     * Check if a value is \c false and trigger a warning if this is not the case.
     * \param $bool the value to check for false-ness
     * \param $message the error message to generate if \c $bool equals \c true
     * \static
     */
    function equalsFalse($bool, $message = '')
	{
    	Assert::equals($bool, false, $message);
    }
}
?>