<?php

namespace App\Application\UseCase\Contact\CreateContactUseCase;

use InvalidArgumentException;

final readonly class CreateContactUseCaseInput
{

	public function __construct(public string $firstName, public string $lastName, public string $phone)
	{
		if (!preg_match('/^\+[1-9]\d{1,14}$/', $this->phone)) {
			throw new InvalidArgumentException('Invalid phone number format. Must follow E.164 format.');
		}
	}

}