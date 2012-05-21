<?php

/**
 * Test class
 */

namespace smCore;
use smCore\Language;

/**
 * Runtime exception, it is thrown in many non-critical situations.
 */
class Exception extends \Exception
{
	private $_area = '';

	/**
	 * Construct the exception. Takes an optional, additional parameter, $area, to specify
	 * the package the exception occurs in. May be used later to construct the message.
	 * i.e. $area='validation', or 'security', may be used to add information to the final message.
	 *
	 * @param  mixed $msg
	 * @param  int $code
	 * @param \Exception|null|\smCore\Exception $previous
	 * @param string $area=null
	 * @return \smCore\Exception
	 */
	public function __construct($msg = '', $code = 0, \Exception $previous = null, $area = null)
	{
		parent::__construct($msg, (int) $code, $previous);
		if (!empty($area))
			$this->_area = $area;
	}

	/**
	 * Display information about this exception.
	 */
	public function printOut()
	{
		$message = '<b>Code ' . $this->getCode() . ': ' . $this->getMessage() . '</b><br />';
        $message .= 'Line ' . $this->getLine() . ' in ' . $this->getFile() . '<br />';
        $message .= '<pre>';
        $message .= $this->getTraceAsString();
        $message .= '</pre>';
        return $message;
	}
}