<?php

namespace App\Repository\Exception;


class TwitterRequestException extends \Exception
{

	public function __construct(int $code, string $message)
	{
		parent::__construct("Communication with Twitter is broken. Code $code, message: $message");
	}

}