<?php

namespace App\Presentation\GraphQL\Resolver\Query;


use App\Application\UseCase\Contact\DetailContactUseCase\DetailContactUseCase;

final readonly class ContactQueryResolver
{

	public function __construct(private DetailContactUseCase $detailContactEndpoint)
	{
	}

	public function resolve(string $phone): array
	{
		$contact = $this->detailContactEndpoint->process($phone);

		return [
			'id' => $contact->id,
			'firstName' => $contact->firstName,
			'lastName' => $contact->lastName,
			'phone' => $contact->phone,
			'createdAt' => $contact->createdAt->format('Y-m-d H:i:s'),
			'updatedAt' => $contact->updatedAt?->format('Y-m-d H:i:s')
		];
	}
}