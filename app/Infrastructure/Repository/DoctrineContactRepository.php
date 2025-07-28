<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;


use App\Application\Repository\ContactRepository;
use App\Domain\Entity\ContactEntity;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DoctrineContactRepository implements ContactRepository
{
	public function __construct(private EntityManagerInterface $entityManager)
	{
	}

	public function createEntity(): ContactEntity
	{
		return new ContactEntity();
	}

	public function insert(ContactEntity $contact): void
	{
		$this->entityManager->persist($contact);
		$this->entityManager->flush();
	}

	public function update(ContactEntity $contact): void
	{
		$this->entityManager->flush();
	}

	public function findAll(): array
	{
		return $this->entityManager->getRepository(ContactEntity::class)->findAll();
	}

	public function findById(int $id): ?ContactEntity
	{
		return $this->entityManager->getRepository(ContactEntity::class)->find($id);
	}

	public function findByPhone(string $phone): ?ContactEntity
	{
		return $this->entityManager->getRepository(ContactEntity::class)->findOneBy(['phone' => $phone]);
	}


}