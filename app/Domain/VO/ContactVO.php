<?php

declare(strict_types=1);

namespace App\Domain\VO;

use DateTimeImmutable;

final readonly class ContactVO
{
	public function __construct(
		public int $id,
		public string $firstName,
		public string $lastName,
		public string $phone,
		public DateTimeImmutable $createdAt,
		public ?DateTimeImmutable $updatedAt
	) {
	}
}
