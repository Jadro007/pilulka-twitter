<?php

namespace App\Tests\Repository;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Repository\Exception\TwitterRequestException;
use App\Repository\TwitterRepository;
use PHPUnit\Framework\TestCase;

class TwitterRepositoryTest extends TestCase
{

	public function testLoadingTwitterHappyPath()
	{

		$twitterOAuthMock = $this->createStub(TwitterOAuth::class);


		$twitterOAuthMock
			->method("setApiVersion")
			->with("2");

		$tweetData = new \stdClass();
		$tweetData->name = "name";
		$tweetData->id = "id";

		$twitterData = new \stdClass();
		$twitterData->data = [
			$tweetData
		];

		$twitterOAuthMock
			->method("get")
			->willReturn($twitterData);


		$twitterOAuthMock
			->method("getLastHttpCode")
			->willReturn(200);

		$twitterRepository = new TwitterRepository(
			$twitterOAuthMock
		);

		$this->assertSame($twitterData, $twitterRepository->load());

	}

	public function testLoadingTwitterError()
	{
		$twitterOAuthMock = $this->createStub(TwitterOAuth::class);

		$twitterOAuthMock
			->method("setApiVersion")
			->with("2");

		$twitterOAuthMock
			->method("get")
			->willReturn(null);


		$twitterOAuthMock
			->method("getLastHttpCode")
			->willReturn(404);

		$twitterOAuthMock
			->method("getLastBody")
			->willReturn(["error" => "yes"]);

		$twitterRepository = new TwitterRepository(
			$twitterOAuthMock
		);

		$this->expectException(TwitterRequestException::class);
		$this->expectExceptionMessage("Communication with Twitter is broken. Code 404, message: {\"error\":\"yes\"}");

		$twitterRepository->load();

	}
}
