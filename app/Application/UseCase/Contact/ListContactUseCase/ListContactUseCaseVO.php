<?php

namespace App\Application\UseCase\Contact\ListContactUseCase;

use DateTimeImmutable;

final readonly class ListContactUseCaseVO
{

	public function __construct(
		public int $id,
		public string $firstName,
		public string $lastName,
		public string $phone,
		public DateTimeImmutable $createdAt,
		public ?DateTimeImmutable $updatedAt
	)
	{
	}

}