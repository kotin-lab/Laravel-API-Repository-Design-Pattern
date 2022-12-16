# Laravel API with Repository Design Pattern

API CRUD using Repository Design Pattern. JSON response with API Resources and validation with Form Request Validation. Laravel Passport for user Authentication/Authorization. Articles has relationship with categories and users.

Laravel documentations ...

- [API Resources](https://laravel.com/docs/9.x/eloquent-resources)
- [Form Request Validation](https://laravel.com/docs/9.x/validation#form-request-validation)

&nbsp;

## Installation


1. Clone this repository in your local machine.
```BASH
# Clone the project
git clone https://github.com/kotin-lab/Laravel-API-Repository-Design-Pattern.git

# And then go to project folder
cd Laravel-API-Repository-Design-Pattern
```

2. Compoer install dependencies.
```BASH
# Run composer command in the project folder
composer install
```

3. Run database migrations.
```BASH
# Migrate tables
php artisan migrate

# Run seeders
php artisan db:seed
```

4. Run passport:install
```BASH
# passport:install
php artisan passport:install
```

5. Start the server.
```BASH
# Start server
php artisan serve
```

&nbsp;

## Test APIs with Postman

1. First of all, login user with below email and password. Send request and get Token.
```JSON
{
    "email": "johndoe@example.com",
    "password": "johndoe@example.com"
}
```

1. Set Postman Headers required for subsequence requests.
```
Accept: application/json
Content-Type: application/json
Authorization: Bearer <TOKEN_VALUE_HERE>
```

For more examples, see below API documentation link.
- [API examples](https://documenter.getpostman.com/view/17276678/2s8YsryZnr)