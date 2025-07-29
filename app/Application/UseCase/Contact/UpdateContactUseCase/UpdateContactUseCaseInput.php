<?php

declare(strict_types=1);

namespace App\Application\UseCase\Contact\UpdateContactUseCase;

use InvalidArgumentException;

final readonly class UpdateContactUseCaseInput
{
	public function __construct(public int $id, public string $firstName, public string $lastName, public string $phone)
	{
		if (!preg_match('/^[1-9]\d{1,14}$/', $this->phone)) {
			throw new InvalidArgumentException('Invalid phone number format. Must follow E.164 format.');
		}
	}
}
