# Bozeman Meetup

## We're building this open source version of meetup.com as a fun way to learn and collaborate.
Join us on [Bozeman Laravel Slack]

## Requirements
- [Docker](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [PHP 7](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)
- [NodeJS](https://nodejs.org/en/)
## Getting Started
### Using [Laravel Sail](https://laravel.com/docs/8.x/sail#installation)
- Clone this repository on your machine and `cd` into it
- Run `./vendor/bin/sail up`
- To seed your initial admin user, run `./vendor/bin/sail artisan migrate --seed`
- To generate an app key, run `./vendor/bin/sail artisan key:generate`
- In the terminal, run `npm install && npm run dev`

### Using [Laravel Valet](https://laravel.com/docs/8.x/valet#installation)
- Clone this repository on your machine and `cd` into it
- Run `valet link`
- Setup a new MySQL database called *meetup*
    - We'll be connecting using `root` and no password
- To seed your initial admin user, run `php artisan migrate --seed`
- To generate an app key, run `php artisan key:generate`
- In the terminal, run `npm install && npm run dev`
- You can access the front end at http://meetup.test

## Testing
The goal is to create the app using TDD, so any code you write should be tested.
We're always eager to help. If you have questions about anything in this app, reach out.
The tests are set up to use a sqlite :memory: database, so there is no configuration needed.

### To run the test suite
- Open the terminal to the root of the project.
- Run `./vendor/bin/sail test`


[Bozeman Laravel Slack]: https://join.slack.com/t/bozemanlaravel/shared_invite/enQtMjczODQ1Mzg4ODg2LWRjYWFlMzg0YWIzZjAzOTY1YjQyN2RjMmZjNDAxNTNlNmU5MjRiYzVlYWUyOTU5NWY5ODMyNDliNTMyMGU0NWI
