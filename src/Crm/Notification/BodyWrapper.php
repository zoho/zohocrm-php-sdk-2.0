<?php
namespace Zoho\Crm\Notification;

use Zoho\Crm\Util\Model;

class BodyWrapper implements Model
{

	private  $watch;
	private  $keyModified=array();

	/**
	 * The method to get the watch
	 * @return array array representing the watch
	 */
	public  function getWatch()
	{
		return $this->watch;
	}

	/**
	 * The method to set the value to watch
	 * @param array $watch A array
	 */
	public  function setWatch(array $watch)
	{
		$this->watch=$watch;
		$this->keyModified['watch'] = 1;

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
