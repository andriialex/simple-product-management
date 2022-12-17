# Backend

This is the backend for the product administration application. It provides a set of API endpoints for managing products in the database.

## API Endpoints

- `GET /products/all`: retrieve a list of all products
- `GET /products/{id}`: retrieve a specific product by its ID
- `POST /products/add`: add a new product to the database
- `PUT /products/update/{id}`: update an existing product with the given ID
- `DELETE /products/delete/{id}`: delete an existing product with the given ID

## Technologies

- Backend: SlimPHP
- Database: MySQL

## Setup

To set up the backend on your local machine:

1. Navigate to the `backend` folder
2. Run `composer install` to install the necessary dependencies
3. Create a MySQL database and configure the connection settings in the `src/settings.php` file
4. Run the SQL scripts in the `database` folder to set up the necessary tables and sample data
5. Start the backend server with `php -S localhost:8000 -t public`
