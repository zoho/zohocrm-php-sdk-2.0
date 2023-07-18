<?php
namespace Zoho\Crm\Query;

use Zoho\Crm\Util\Model;

class BodyWrapper implements Model
{

	private  $selectQuery;
	private  $keyModified=array();

	/**
	 * The method to get the selectQuery
	 * @return string A string representing the selectQuery
	 */
	public  function getSelectQuery()
	{
		return $this->selectQuery;

	}

	/**
	 * The method to set the value to selectQuery
	 * @param string $selectQuery A string
	 */
	public  function setSelectQuery(string $selectQuery)
	{
		$this->selectQuery=$selectQuery;
		$this->keyModified['select_query'] = 1;

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
