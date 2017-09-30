<?php

namespace app\libs;

use \system\models\Model;

/**
* @Author: Vinay Gokuladas Khobragade
* @Package: Validation Class for Surface. (Inbuilt Library)
*/
class Validation extends Model
{
	function __construct()
	{
		parent::__construct();
		$this->errors = 0;
	}

	function validate($input, $rules = '')
	{	
		
		$rules = explode('|', $rules);
		
		foreach($rules as $rule)
		{
			if($rule == 'required')
			{
				
				if($this->required($input)) {}
				else $this->errors++;
			}

			//USE === for strpos or > -1
			else if(strpos($rule, 'minlength') !== FALSE)
			{
				$value = explode('=', $rule)[1];
				if($this->minlength($input, $value)) {  }
				else $this->errors++;
			}

			else if(strpos($rule, 'maxlength') !== FALSE)
			{
				$value = explode('=', $rule)[1];
				if($this->maxlength($input, $value)) {}
				else $this->errors++;
			}

			else if(strpos($rule, 'unique') !== FALSE)
			{
				$column = explode('=', $rule)[1];
				if($this->unique($input, $column)) {}
				else $this->errors++;
			}
		} //foreach

		if($this->getErrors() == 0)
		{
			return true;
		}
		else {
			return false;
		}
	}

	function required($input)
	{
		if(strlen($input) == 0)
		{
			return false;
		}

		else return true;

	}

	function maxlength($input, $maxlength)
	{
		if(strlen($input) <= $maxlength)
		{
			$this->errors++;
		}
		else return false;
	}

	function minlength($input, $minlength)
	{
		if(strlen($input) >= $minlength)
		{
			return true;
		}
		
		else {
			return false; }

	}

	function unique($input, $column) {
		$sql = "SELECT * FROM users WHERE $column = :input";
		if($result = $this->pdoQuery($sql)) {
			$result->bindParam(':input', $input);
			$result->execute();
			if($result->rowCount() == 0) {
				return true;
			} else return false;
		} else {return false;}
	}	

	function getErrors()
	{
		return $this->errors;
	}

}