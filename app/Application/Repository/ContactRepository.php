<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Entity\ContactEntity;

interface ContactRepository
{
	public function createEntity(): ContactEntity;

	public function insert(ContactEntity $contact): void;

	public function update(ContactEntity $contact): void;

	/**
	 * @return array<ContactEntity>
	 */
	public function findAll(): array;

	public function findById(int $id): ?ContactEntity;

	public function findByPhone(string $phone): ?ContactEntity;
}
