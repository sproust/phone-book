<?php declare(strict_types=1);

namespace App\Application\UseCase\Contact\UpdateContactUseCase;

use App\Application\Repository\ContactRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityNotFoundException;

final readonly class UpdateContactUseCase
{

	public function __construct(private ContactRepository $contactRepository)
	{
	}

	public function process(UpdateContactUseCaseInput $input): bool
	{
		$contact = $this->contactRepository->findById($input->id);

		if ($contact === null) {
			throw new EntityNotFoundException('Contact not found.');
		}

		$contact->setFirstName($input->firstName);
		$contact->setLastName($input->lastName);
		$contact->setPhone($input->phone);
		$contact->setUpdatedAt(new DateTimeImmutable());
		$this->contactRepository->update($contact);

		return true;
	}

}