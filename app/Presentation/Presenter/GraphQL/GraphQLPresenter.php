<?php declare(strict_types=1);

namespace App\Presentation\Presenter\GraphQL;

use GraphQL\Error\DebugFlag;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
use Nette\Application\Request;
use Nette\Application\Response;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\Responses\TextResponse;
use Nette\Application\UI\Presenter;
use Nette\Http\IResponse;

final class GraphQLPresenter extends Presenter
{
	public function __construct(
		private readonly Schema $schema,
		private readonly IResponse $httpResponse
	) {
	}


	public function run(Request $request): Response
	{
		if ($request->getParameter('action') === 'ui') {
			return new TextResponse(file_get_contents(__DIR__ . '/../templates/graphiql.html'));
		}

		$this->httpResponse->setContentType('application/json', 'utf-8');

		try {
			$rawInput = file_get_contents('php://input');
			if ($rawInput === false) {
				return new JsonResponse(['errors' => [['message' => 'Nepodařilo se přečíst vstupní data']]]);
			}

			$input = json_decode($rawInput, true);
			if ($input === null) {
				return new JsonResponse(['message' => 'Welcome to phone-book API']);
			}

			$result = GraphQL::executeQuery(
				$this->schema,
				$input['query'],
				null,
				null,
				$input['variables'] ?? null
			)->toArray(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE);

			return new JsonResponse($result);
		} catch (\Throwable $e) {
			return new JsonResponse([
				'errors' => [
					[
						'message' => $e->getMessage(),
						'code' => $e->getCode()
					]
				]
			]);
		}
	}

}