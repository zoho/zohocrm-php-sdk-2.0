<?php
namespace Zoho\Crm\Records;

use Zoho\Crm\Util\Choice;
use Zoho\Crm\Util\Model;

class SuccessResponse implements Model, ActionResponse, FileHandler
{

	private  $status;
	private  $code;
	private  $duplicateField;
	private  $action;
	private  $message;
	private  $details;
	private  $keyModified=array();

	/**
	 * The method to get the status
	 * @return Choice An instance of Choice
	 */
	public  function getStatus()
	{
		return $this->status;

	}

	/**
	 * The method to set the value to status
	 * @param Choice $status An instance of Choice
	 */
	public  function setStatus(Choice $status)
	{
		$this->status=$status;
		$this->keyModified['status'] = 1;

	}

	/**
	 * The method to get the code
	 * @return Choice An instance of Choice
	 */
	public  function getCode()
	{
		return $this->code;

	}

	/**
	 * The method to set the value to code
	 * @param Choice $code An instance of Choice
	 */
	public  function setCode(Choice $code)
	{
		$this->code=$code;
		$this->keyModified['code'] = 1;

	}

	/**
	 * The method to get the duplicateField
	 * @return string A string representing the duplicateField
	 */
	public  function getDuplicateField()
	{
		return $this->duplicateField;

	}

	/**
	 * The method to set the value to duplicateField
	 * @param string $duplicateField A string
	 */
	public  function setDuplicateField(string $duplicateField)
	{
		$this->duplicateField=$duplicateField;
		$this->keyModified['duplicate_field'] = 1;

	}

	/**
	 * The method to get the action
	 * @return Choice An instance of Choice
	 */
	public  function getAction()
	{
		return $this->action;

	}

	/**
	 * The method to set the value to action
	 * @param Choice $action An instance of Choice
	 */
	public  function setAction(Choice $action)
	{
		$this->action=$action;
		$this->keyModified['action'] = 1;

	}

	/**
	 * The method to get the message
	 * @return Choice An instance of Choice
	 */
	public  function getMessage()
	{
		return $this->message;

	}

	/**
	 * The method to set the value to message
	 * @param Choice $message An instance of Choice
	 */
	public  function setMessage(Choice $message)
	{
		$this->message=$message;
		$this->keyModified['message'] = 1;

	}

	/**
	 * The method to get the details
	 * @return array A array representing the details
	 */
	public  function getDetails()
	{
		return $this->details;

	}

	/**
	 * The method to set the value to details
	 * @param array $details A array
	 */
	public  function setDetails(array $details)
	{
		$this->details=$details;
		$this->keyModified['details'] = 1;

	}

	/**
	 * The method to check if the user has modified the given key
	 * @param string $key A string
	 * @return int A int representing the modification
	 */
	public  function isKeyModified(string $key)
	{
		if(((array_key_exists($key, $this->keyModified))))
		{
			return $this->keyModified[$key];

		}
		return null;

	}

	/**
	 * The method to mark the given key as modified
	 * @param string $key A string
	 * @param int $modification A int
	 */
	public  function setKeyModified(string $key, int $modification)
	{
		$this->keyModified[$key] = $modification;

	}
}
