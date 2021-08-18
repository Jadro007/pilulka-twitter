<?php declare(strict_types=1);

namespace App\Factory;

use App\DTO\Tweet;
use App\Repository\TwitterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TwitterFactory extends AbstractController
{
	private $twitterRepository;

	public function __construct(TwitterRepository $twitterRepository)
	{
		$this->twitterRepository = $twitterRepository;
	}


	/**
	 * @return Tweet[]
	 * @throws \App\Repository\Exception\TwitterRequestException
	 */
	public function createTweets(): array
	{
		$data = $this->twitterRepository->load();

		if (isset($data->data) === false) {
			return [];
		}

		$tweets = [];

		foreach ($data->data as $row) {
			$tweets[] = new Tweet(
				$row->id,
				$row->text
			);
		}

		return $tweets;
	}
}
