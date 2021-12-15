<?php
namespace App\Acl;

class Exception extends \Exception
{
	public function __Construct($role, $path)
	{
		$msg = $role.' doesn\'t allowed to: '.$path;
		parent::__Construct($msg);
	}
}
