<?php

namespace App\Application\UseCase\Contact\DetailContactUseCase;

use DateTimeImmutable;

final readonly class DetailContactUseCaseVO
{

	public function __construct(
		public int                $id,
		public string             $firstName,
		public string             $lastName,
		public string             $phone,
		public DateTimeImmutable  $createdAt,
		public ?DateTimeImmutable $updatedAt
	)
	{
	}

}