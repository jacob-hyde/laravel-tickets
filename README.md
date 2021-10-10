# Laravel Tickets
Add ticketing to your Laravel API with Laravel Tickets. While there are other ticketing packages for Laravel, such as TicketIt, they all lack simplicity and ability to right into your API.

## Perquisites
Have Laravel UI with Auth installed.

    composer require laravel/ui
    php artisan ui bootstrap --auth
    npm install && npm run dev

Note, you do not need to use bootstrap.

## Installation
1. `composer require jacobhyde/tickets`
2. `php artisan vendor:publish --tag=tickets`

## Configuration
You will find configuration variables in config/tickets.php

```
return  [
	'user'  =>  \App\Models\User::class,
	'from_address'  =>  '',
	'from_name'  =>  '',
	'routes'  =>  [
		'api'  =>  [
		'prefix'  =>  'api/v1',
		'middleware'  =>  [],
		],
	'web'  =>  [
		'domain'  =>  'support.example.com',
		'prefix'  =>  '',
		'middleware'  =>  ['auth:web'],
		],
	],
	'created'  =>  [
		'email'  =>  null,
		'user_guard'  =>  'api',
	],
];
```