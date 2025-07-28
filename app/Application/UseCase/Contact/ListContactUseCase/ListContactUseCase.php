<?php declare(strict_types=1);

namespace App\Application\UseCase\Contact\ListContactUseCase;

use App\Application\Repository\ContactRepository;

final readonly class ListContactUseCase
{

	public function __construct(private ContactRepository $contactRepository)
	{
	}

	public function process(): ListContactUseCaseOutput
	{
		$contacts = $this->contactRepository->findAll();

		$contactVOs = [];
		foreach ($contacts as $contact) {
			$contactVOs[] = new ListContactUseCaseVO(
				id: $contact->getId(),
				firstName: $contact->getFirstName(),
				lastName: $contact->getLastName(),
				phone: $contact->getPhone(),
				createdAt: $contact->getCreatedAt(),
				updatedAt: $contact->getUpdatedAt()
			);
		}

		return new ListContactUseCaseOutput($contactVOs);
	}

}