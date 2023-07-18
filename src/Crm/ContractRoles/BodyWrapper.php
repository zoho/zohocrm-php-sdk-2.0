<?php
namespace Zoho\Crm\ContractRoles;

use Zoho\Crm\Util\Model;

class BodyWrapper implements Model
{

	private  $contactRoles;
	private  $keyModified=array();

	/**
	 * The method to get the contactRoles
	 * @return array A array representing the contactRoles
	 */
	public  function getContactRoles()
	{
		return $this->contactRoles;

	}

	/**
	 * The method to set the value to contactRoles
	 * @param array $contactRoles A array
	 */
	public  function setContactRoles(array $contactRoles)
	{
		$this->contactRoles=$contactRoles;
		$this->keyModified['contact_roles'] = 1;

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
