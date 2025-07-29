<?php

declare(strict_types=1);

namespace App\Infrastructure\GraphQL\Resolver\Mutation;

use App\Application\UseCase\Contact\CreateContactUseCase\CreateContactUseCase;
use App\Application\UseCase\Contact\CreateContactUseCase\CreateContactUseCaseInput;

final readonly class CreateContactMutationResolver
{
	public function __construct(private CreateContactUseCase $createContactUseCase)
	{
	}

	/**
	 * @return array<string, mixed>
	 */
	public function resolve(CreateContactUseCaseInput $input): array
	{
		$contact = $this->createContactUseCase->process($input);

		return [
			'id' => $contact->id,
			'firstName' => $contact->firstName,
			'lastName' => $contact->lastName,
			'phone' => $contact->phone,
			'createdAt' => $contact->createdAt->format('Y-m-d H:i:s'),
			'updatedAt' => $contact->updatedAt?->format('Y-m-d H:i:s'),
		];
	}
}
