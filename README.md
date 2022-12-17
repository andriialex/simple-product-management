# Product Administration App

Welcome to the Product Administration app! This app allows users to manage a list of products using an easy-to-use admin page. Users can add new products, edit existing ones, and delete products that are no longer needed. All products are displayed in the main page for easy viewing.

This app is built using Vue.js in the frontend and a RESTful API built with SlimPHP and a MySQL database in the backend.

## Getting Started

To get started with this app, you will need to do the following:

1. Clone this repository to your local machine: `git clone https://github.com/[YOUR_USERNAME]/product-administration.git`
2. Navigate to the root directory of the project: `cd product-administration`
3. Install all required dependencies: `npm install`
4. Start the development server: `npm run serve`

This will start the development server and open the app in your default browser. You can now use the admin page to add, edit, and delete products.

## Setting Up the Backend

To set up the backend of this app, you will need to do the following:

1. Install and set up a MySQL database on your server.
2. Import the `database.sql` file located in the `backend` directory to your MySQL database. This will create the necessary tables and sample data.
3. Edit the `.env` file located in the `backend` directory and update the database credentials to match your MySQL database setup.
4. Navigate to the `backend` directory: `cd backend`
5. Install all required dependencies: `composer install`
6. Start the backend server: `php -S localhost:8000`

This will start the backend server and allow the frontend to connect to the database and perform CRUD operations on the products.
