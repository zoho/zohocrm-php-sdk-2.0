<?php
namespace Zoho\Crm\RelatedLists;

use Zoho\Crm\Util\Model;

class ResponseWrapper implements Model, ResponseHandler
{

	private  $relatedLists;
	private  $keyModified=array();

	/**
	 * The method to get the relatedLists
	 * @return array A array representing the relatedLists
	 */
	public  function getRelatedLists()
	{
		return $this->relatedLists;

	}

	/**
	 * The method to set the value to relatedLists
	 * @param array $relatedLists A array
	 */
	public  function setRelatedLists(array $relatedLists)
	{
		$this->relatedLists=$relatedLists;
		$this->keyModified['related_lists'] = 1;

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
