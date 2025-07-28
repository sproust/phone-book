<?php declare(strict_types=1);

namespace App\Application\UseCase\Contact\DetailContactUseCase;

use App\Application\Repository\ContactRepository;
use App\Domain\VO\ContactVO;
use Doctrine\ORM\EntityNotFoundException;

final readonly class DetailContactUseCase
{

	public function __construct(private ContactRepository $contactRepository)
	{
	}

	public function process(string $phone): ContactVO
	{
		$contact = $this->contactRepository->findByPhone($phone);

		if ($contact === null) {
			throw new EntityNotFoundException('Contact not found.');
		}

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