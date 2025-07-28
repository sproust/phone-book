<?php declare(strict_types=1);

namespace App\Application\UseCase\Contact\CreateContactUseCase;

use App\Application\Repository\ContactRepository;
use DateTimeImmutable;

final readonly class CreateContactUseCase
{

	public function __construct(private ContactRepository $contactRepository)
	{
	}

	public function process(CreateContactUseCaseInput $input): int
	{
		$contact = $this->contactRepository->createEntity();
		$contact->setFirstName($input->firstName);
		$contact->setLastName($input->lastName);
		$contact->setPhone($input->phone);
		$contact->setCreatedAt(new DateTimeImmutable());
		$this->contactRepository->insert($contact);

		return $contact->getId();
	}

}