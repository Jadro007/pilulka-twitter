<?php declare(strict_types=1);

namespace App\DTO;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Tweet extends AbstractController
{

	private $id;
	private $text;

	public function __construct(string $id, string $text)
	{
		$this->id = $id;
		$this->text = $text;
	}

	public function getId(): string
	{
		return $this->id;
	}

	public function getText(): string
	{
		return $this->text;
	}

}
