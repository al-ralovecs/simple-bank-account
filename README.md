# Simple Bank Solution (Job Home assignment)

Steps to get the system up:

1. after cloning a repository to your machine
2. execute command:
```
make dev up && docker logs bank-task-dev -f
```
it will download and build docker image, install vendors, create database, load migrations and fixtures.
after you see from the console, that everything is finished, you can try out the functionality.

## Code-quality

repository contains three code quality tools:

1. CS-Fixer, run by command
```
make dev cs-fixer
```
2. PHP-Stan, run by
```
make dev phpstan
```
3. PHPUnit with tests, run by
```
make dev phpunit
```
code coverage is supported and html report will be generated to folder ./var/coverage

## CI compliance

The repository is made with support for CI/CD pipelines.
The CI part with all the code quality checks is executed by command
```
make ci
```

## Try out functionality by your self

The project uses port 80 for http requests/responses. It can be changed in file
./etc/docker/.env - environment variable WEB_APP_PORT.

The following api urls are accessible:

### Clients

GET /api/user - list all clients

POST /api/user - create a client, provide json content:
```
{
    "email": "john@doe.com"
}
```
GET /api/user/{userId} - get info about a client by its id

### Accounts

GET /api/user/{userId}/account - list all the client's accounts with their current balance

POST /api/user/{userId}/account - create a new account for the client, by providing json body:
```
{   
    "currency": "<three-letter currency code>"
}
```

### Transactions

GET /api/account/{accountId}/transaction - list all the transactions of the account

POST /api/transaction - create a new money transaction, by providing request json body:
```
{
    "sourceAccount": "<uuid of the account to transfer money from>",
    "targetAccount": "<uuid of the account to transfer money to>",
    "currency": "<three-letter currency code>",
    "amount": <integer! amount OF CENTS! to transfer>
}
```

## Currency conversion

For the conversion, there in the project are utilized two approaches.
First, there is an exchange rate from EUR to some 32 currencies existing in database from fixtures.
Second, the project utilizes public api https://api.freecurrencyapi.com , the access key is supplied.
This api has a limit of 10 requests per 10 minutes, so be precaucious.


Have a nice investigation!
