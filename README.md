# phone-book

## Installation

1. Clone the repository
2. Make directories "temp" and "log" (writable)
3. Copy `.env.example` to `.env` to set the environment variables
4. Start up development environment
```bash
  make up
```
5. Initialize the project
```bash
  make init
```

## Usage
1. Go to URL `http://localhost/graphiql`
2. Use GraphiQL to test the API

Use the following queries to test the API:

List all contacts:
```graphql
query Contacts {
  contacts {
    id
    firstName
    lastName
    phone
    createdAt
    updatedAt
  }
}
```

Details of a specific contact:
```graphql
query Contact {
    contact(phone: "420123456789") {
        id
        firstName
        lastName
        phone
        createdAt
        updatedAt
    }
}
```

Create a new contact:
```graphql
mutation CreateContact {
    createContact (
        firstName: "Foo",
        lastName: "Bar",
        phone: "420724606098",
    ) {
        id
        firstName
        lastName
        phone
        createdAt
        updatedAt
    }
}
```

Update an existing contact:
```graphql
mutation UpdateContact {
    updateContact (
        id: 1,
        firstName: "FooFoo",
        lastName: "BarBar",
        phone: "421456456456",
    ) {
        id
        firstName
        lastName
        phone
        createdAt
        updatedAt
    }
}
```