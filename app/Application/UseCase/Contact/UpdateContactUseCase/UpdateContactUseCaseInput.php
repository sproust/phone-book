<?php

namespace App\Application\UseCase\Contact\UpdateContactUseCase;

final readonly class UpdateContactUseCaseInput
{

	public function __construct(public int $id, public string $firstName, public string $lastName, public string $phone)
	{
	}

}