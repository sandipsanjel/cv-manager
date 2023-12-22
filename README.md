# CV-Manager

CV Manager app where users can log in and upload a CV for a certain job and HR/Admin can review change status and send mail Haired/Interview/Shortlisted or Rejected accordingly.

## Installation

To install CVManager, follow these steps:

1. Clone the repository:
git clone https://github.com/sandipsanjel/cv-manager.git


2. Install the dependencies:
  ```ruby
cd cv-manager
composer install
```

3. Copy the .env.example file to .env and configure your environment variables:
```ruby
cp .env.example .env
```

4. Generate an application key:
```ruby
php artisan key:generate
```

5. Run the database migrations:
```ruby
php artisan migrate
```

6. Start the development server:
```ruby
php artisan serve
```

## Contributing

If you would like to contribute to CVManager, please open a pull request with your changes.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
