<?php declare(strict_types=1);

namespace App\Presentation\GraphQL\Contact;


use App\Application\UseCase\Contact\CreateContactUseCase\CreateContactUseCase;
use App\Application\UseCase\Contact\CreateContactUseCase\CreateContactUseCaseInput;
use App\Application\UseCase\Contact\UpdateContactUseCase\UpdateContactUseCase;
use App\Application\UseCase\Contact\UpdateContactUseCase\UpdateContactUseCaseInput;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

final class ContactMutation extends ObjectType
{
	public function __construct(
		private readonly CreateContactUseCase $createContactEndpoint,
		private readonly UpdateContactUseCase $updateContactEndpoint,
		private readonly ContactType          $contactType
	) {
		parent::__construct([
			'name' => 'Mutation',
			'fields' => [
				'createContact' => [
					'type' => $this->contactType,
					'args' => [
						'firstName' => Type::nonNull(Type::string()),
						'lastName' => Type::nonNull(Type::string()),
						'phone' => Type::nonNull(Type::string())
					],
					'resolve' => fn ($root, array $args) => $this->createContactEndpoint->process(new CreateContactUseCaseInput(
						firstName: $args['firstName'],
						lastName: $args['lastName'],
						phone: $args['phone']
					))
				],
				'updateContact' => [
					'type' => $this->contactType,
					'args' => [
						'id' => Type::nonNull(Type::id()),
						'firstName' => Type::string(),
						'lastName' => Type::string(),
						'phone' => Type::string()
					],
					'resolve' => fn ($root, array $args) => $this->updateContactEndpoint->process(new UpdateContactUseCaseInput(
						id: $args['id'],
						firstName: $args['firstName'],
						lastName: $args['lastName'],
						phone: $args['phone']
					))
				]
			]
		]);
	}
}