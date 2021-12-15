<?php
namespace App\Boot;

class AppException extends \Error {
	function __Construct(int $ec) {
		parent::__construct('', $ec);
	}
}