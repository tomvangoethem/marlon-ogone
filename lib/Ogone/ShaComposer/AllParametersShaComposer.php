<?php
namespace Ogone\ShaComposer;

/**
 * SHA string composition the "new way", using all parameters in the request
 */
class AllParametersShaComposer extends AbstractShaComposer
{
	public function compose($requestParameters)
	{
		// use lowercase internally
		$requestParameters = array_change_key_case($requestParameters, CASE_LOWER);
		
		// sort parameters
		ksort($requestParameters);
		
		// compose SHA string
		$shaString = '';
		foreach($requestParameters as $key => $value)
		{
			if($value !== null) {
				$shaString .= strtoupper($key) . '=' . trim($value) . $this->passphrase;
			}
		}
		
		return strtoupper(sha1($shaString));
	}
}