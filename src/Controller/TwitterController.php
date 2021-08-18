<?php declare(strict_types=1);

namespace App\Controller;

use App\Factory\TwitterFactory;
use App\Repository\Exception\TwitterRequestException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwitterController extends AbstractController
{
	private const JSON_FORMAT = "json";

	private $twitterFactory;


	public function __construct(TwitterFactory $twitterFactory)
	{
		$this->twitterFactory = $twitterFactory;

	}

	#[Route('/twitter', name: 'twitter')]
	public function index(Request $request): Response
	{
		$error = false;
		$tweets = null;
		try {
			$tweets = $this->twitterFactory->createTweets();
		} catch (TwitterRequestException $e) {
			$error = true;
		}

		if ($request->query->get('format') == self::JSON_FORMAT) {
			return $this->json($tweets);
		}

		return $this->render('twitter/index.html.twig', [
			'controller_name' => 'TwitterController',
			'tweets' => $tweets,
			'error' => $error,

		]);
	}

}
