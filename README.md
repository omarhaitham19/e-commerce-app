# E-Commerce App

## Overview
This is an e-commerce web application designed to facilitate online shopping. The application is built to cater to two main user roles: Admins and Customers. Admins have access to a dashboard where they can manage various aspects of the system, such as categories, products, orders, admins, roles, permissions, and customers. Customers can browse products, add them to their cart, and place orders.

## Features

### For Admins:
- **Dashboard**: Admins have access to a centralized dashboard.
- **Category Management**: Add, update, and delete product categories.
- **Product Management**: Add, update, and delete products, and assign them to categories.
- **Order Management**: View all orders and take appropriate actions.
- **Admin Management**: Add other admins and manage their roles and permissions.
- **Customer Management**: Manage customer accounts.

### For Customers:
- **Browse Products**: customers can view available products.
- **Search Functionality**: Search for specific products.
- **Cart Management**: Authenticated customers can effortlessly add products to their cart, review cart contents, and remove items as needed.
- **Order Placement**: Authenticated customers can Place orders for selected items.
- **Account Management**: Authenticated customers can update their password, name, and email.
- **Order History**: Authenticated customers can View past order history.


## Usage

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/omarhaitham19/e-commerce-app.git
   ```

2. Install dependencies:

   ```bash
   composer install
   npm install
   ```

3. Configure your environment variables:

   - Copy the `.env.example` file to `.env` and configure it with your database credentials and other settings.

4. Run migrations:

   ```bash
   php artisan migrate
   ```

5. Run database seeders:

   ```bash
   php artisan db:seed
   ```
6. create symbolic link:

    ```bash
   php artisan storage:link
   ```

7. Compile assets:

   ```bash
   npm run dev
   ```

8. Start the server:

   ```bash
   php artisan serve
   ```

9. Admin credentials:

   ```bash
   email: admin@gmail.com
   password: 12345678
   ```


