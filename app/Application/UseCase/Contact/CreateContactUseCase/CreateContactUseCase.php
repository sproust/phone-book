<?php declare(strict_types=1);

namespace App\Application\UseCase\Contact\CreateContactUseCase;

use App\Application\Repository\ContactRepository;
use App\Domain\VO\ContactVO;
use DateTimeImmutable;
use InvalidArgumentException;

final readonly class CreateContactUseCase
{

	public function __construct(private ContactRepository $contactRepository)
	{
	}

	public function process(CreateContactUseCaseInput $input): ContactVO
	{
		$existingContact = $this->contactRepository->findByPhone($input->phone);

		if ($existingContact !== null) {
			throw new InvalidArgumentException('Contact already exists.');
		}

		$contact = $this->contactRepository->createEntity();
		$contact->setFirstName($input->firstName);
		$contact->setLastName($input->lastName);
		$contact->setPhone($input->phone);
		$contact->setCreatedAt(new DateTimeImmutable());
		$this->contactRepository->insert($contact);

		return new ContactVO(
			id: $contact->getId(),
			firstName: $contact->getFirstName(),
			lastName: $contact->getLastName(),
			phone: $contact->getPhone(),
			createdAt: $contact->getCreatedAt(),
			updatedAt: $contact->getUpdatedAt()
		);
	}

}