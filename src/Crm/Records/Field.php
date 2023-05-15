<?php
namespace Zoho\Crm\Records;

class Field
{

	private  $apiName;

	/**
	 * Creates an instance of Field with the given parameters
	 * @param string $apiName A string
	 */
	public function __Construct(string $apiName)
	{
		$this->apiName=$apiName;

	}

	/**
	 * The method to get the aPIName
	 * @return string A string representing the apiName
	 */
	public  function getAPIName()
	{
		return $this->apiName;

	}
}
