<?php

declare(strict_types=1);

namespace App\Infrastructure\GraphQL\Contact;

use App\Application\UseCase\Contact\CreateContactUseCase\CreateContactUseCaseInput;
use App\Application\UseCase\Contact\UpdateContactUseCase\UpdateContactUseCaseInput;
use App\Infrastructure\GraphQL\Resolver\Mutation\CreateContactMutationResolver;
use App\Infrastructure\GraphQL\Resolver\Mutation\UpdateContactMutationResolver;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

final class ContactMutation extends ObjectType
{
	public function __construct(
		private readonly CreateContactMutationResolver $createContactMutationResolver,
		private readonly UpdateContactMutationResolver $updateContactMutationResolver,
		private readonly ContactType $contactType
	) {
		parent::__construct([
			'name' => 'Mutation',
			'fields' => [
				'createContact' => [
					'type' => $this->contactType,
					'args' => [
						'firstName' => Type::nonNull(Type::string()),
						'lastName' => Type::nonNull(Type::string()),
						'phone' => Type::nonNull(Type::string()),
					],
					'resolve' => fn($root, array $args) => $this->createContactMutationResolver->resolve(
						new CreateContactUseCaseInput(
							firstName: $args['firstName'],
							lastName: $args['lastName'],
							phone: $args['phone']
						)
					),
				],
				'updateContact' => [
					'type' => $this->contactType,
					'args' => [
						'id' => Type::nonNull(Type::id()),
						'firstName' => Type::string(),
						'lastName' => Type::string(),
						'phone' => Type::string(),
					],
					'resolve' => fn($root, array $args) => $this->updateContactMutationResolver->resolve(
						new UpdateContactUseCaseInput(
							id: (int) $args['id'],
							firstName: $args['firstName'],
							lastName: $args['lastName'],
							phone: $args['phone']
						)
					),
				],
			],
		]);
	}
}
