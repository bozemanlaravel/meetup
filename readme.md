# Bozeman Meetup

## We're building this open source version of meetup.com as a fun way to learn and collaborate.
Join us on [Bozeman Laravel Slack]

## Requirements
- [PHP 7](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [NodeJS](https://nodejs.org/en/)
## Getting Started
- Clone this repository on your machine and `cd` into it
- Run `composer install`
- Duplicate the `env.example` file and change the name to `.env`
- Run `./vendor/bin/sail up`
- To seed your initial admin user, run `sail artisan migrate --seed`
- To generate an app key, run `sail artisan key:generate`
- In the terminal, run `npm install && npm run dev`

## Testing
The goal is to create the app using TDD, so any code you write should be tested.
We're always eager to help. If you have questions about anything in this app, reach out.
The tests are set up to use a sqlite :memory: database, so there is no configuration needed.

### To run the test suite
- Open the terminal to the root of the project.
- Type in vendor/bin/phpunit and it should just work. 


[Bozeman Laravel Slack]: https://join.slack.com/t/bozemanlaravel/shared_invite/enQtMjczODQ1Mzg4ODg2LWRjYWFlMzg0YWIzZjAzOTY1YjQyN2RjMmZjNDAxNTNlNmU5MjRiYzVlYWUyOTU5NWY5ODMyNDliNTMyMGU0NWI
