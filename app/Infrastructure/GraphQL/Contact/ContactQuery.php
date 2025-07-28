<?php declare(strict_types=1);

namespace App\Infrastructure\GraphQL\Contact;

use App\Infrastructure\GraphQL\Resolver\Query\ContactQueryResolver;
use App\Infrastructure\GraphQL\Resolver\Query\ContactsQueryResolver;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

final class ContactQuery extends ObjectType
{
	public function __construct(
		private readonly ContactType $contactType,
		private readonly ContactQueryResolver $contactQueryResolver,
		private readonly ContactsQueryResolver $contactsQueryResolver,
	) {
		parent::__construct([
			'name' => 'Query',
			'fields' => [
				'contacts' => [
					'type' => Type::listOf($this->contactType),
					'resolve' => fn () => $this->contactsQueryResolver->resolve()
				],
				'contact' => [
					'type' => $this->contactType,
					'args' => ['phone' => Type::nonNull(Type::string())],
					'resolve' => fn ($root, array $args) => $this->contactQueryResolver->resolve($args['phone'])
				]
			]
		]);
	}
}