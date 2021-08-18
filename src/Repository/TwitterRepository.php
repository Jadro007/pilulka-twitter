<?php declare(strict_types=1);

namespace App\Repository;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Repository\Exception\TwitterRequestException;

class TwitterRepository
{
	private $connection;

	public function __construct(TwitterOAuth $twitterOAuth)
	{
		$this->connection = $twitterOAuth;
	}

	/**
	 * @throws TwitterRequestException
	 */
	public function load(): \stdClass
	{
		$this->connection->setApiVersion('2');

		try {
			$content = $this->connection->get('tweets/search/recent', ['query' => "pilulka.cz"]);
		} catch (\Abraham\TwitterOAuth\TwitterOAuthException $exception) {
			throw new TwitterRequestException(
				0,
				"Error during communication"
			);
		}

		if ($this->connection->getLastHttpCode() !== 200) {
			throw new TwitterRequestException(
				$this->connection->getLastHttpCode(),
				json_encode($this->connection->getLastBody())
			);
		}

		return $content;
	}
}
