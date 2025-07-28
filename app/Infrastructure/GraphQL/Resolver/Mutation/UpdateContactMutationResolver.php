<?php

namespace App\Infrastructure\GraphQL\Resolver\Mutation;


use App\Application\UseCase\Contact\UpdateContactUseCase\UpdateContactUseCase;
use App\Application\UseCase\Contact\UpdateContactUseCase\UpdateContactUseCaseInput;

final readonly class UpdateContactMutationResolver
{

	public function __construct(private UpdateContactUseCase $updateContactUseCase)
	{
	}

	public function resolve(UpdateContactUseCaseInput $input): array
	{
		$contact = $this->updateContactUseCase->process($input);

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