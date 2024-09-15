# Investment Portfolio

## Overview

The **Investment Portfolio** project is a web application that allows users to manage their investment portfolios. The application includes features for user authentication, authorization, profile editing, and portfolio management. Built using PHP, jQuery, and MySQL, this project provides a secure and interactive interface for users to handle their investments.

## Features

- **Authentication**: Secure login and registration process.
- **Authorization**: Role-based access control.
- **Profile Editing**: Users can update their personal information.
- **Portfolio Management**: Users can add, edit, and remove investment assets.

## Technology Stack

- **Frontend**: jQuery, HTML, CSS
- **Backend**: PHP
- **Database**: MySQL

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher

## Configure Database

Copy config.example.php to config.php and update the database configuration.

```php
<?php
// db.php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'yourpassword');
define('DB_DATABASE', 'investment_portfolio');
?>
```

### Additional Explanation:

- **Database Setup**: Added steps to create a database and import schema from file `db/investment.sql`.
