<?php

namespace App\Application\UseCase\Contact\CreateContactUseCase;

final readonly class CreateContactUseCaseInput
{

	public function __construct(public string $firstName, public string $lastName, public string $phone)
	{
	}

}