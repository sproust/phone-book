<?php

declare(strict_types=1);

namespace App\Infrastructure\GraphQL\Resolver\Query;

use App\Application\UseCase\Contact\ListContactUseCase\ListContactUseCase;

final readonly class ContactsQueryResolver
{
	public function __construct(private ListContactUseCase $listContactEndpoint)
	{
	}

	/**
	 * @return list<array<string, mixed>>
	 */
	public function resolve(): array
	{
		$contacts = $this->listContactEndpoint->process();

		$contactsArray = [];
		foreach ($contacts->contacts as $contact) {
			$contactsArray[] = [
				'id' => $contact->id,
				'firstName' => $contact->firstName,
				'lastName' => $contact->lastName,
				'phone' => $contact->phone,
				'createdAt' => $contact->createdAt->format('Y-m-d H:i:s'),
				'updatedAt' => $contact->updatedAt?->format('Y-m-d H:i:s'),
			];
		}

		return $contactsArray;
	}
}
