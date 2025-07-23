<?php

declare(strict_types=1);

namespace App\Presentation\Home;

use JetBrains\PhpStorm\NoReturn;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{
	#[NoReturn] public function actionDefault(): void
	{
		$this->sendResponse(
			new JsonResponse([
				'message' => 'Welcome to phone-book API'
			])
		);
	}
}
