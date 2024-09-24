
# Automotive Electronics Management System

## Project Overview

This project, **Automotive Electronics**, is designed to manage various aspects of automotive electronics through a user-friendly web interface. The system includes functionalities for managing user accounts, storing automotive electronics data, and facilitating smooth data retrieval and interaction.

## Features

- **Admin Management**: Allows admin users to manage the system's functionality.
- **User Authentication**: Secure login system for administrators using username and password.
- **Database-Driven**: Data is stored in an SQL database for easy access and management.

## Database Structure

The system uses a MySQL database called `electricks` that contains the following important tables:

### `admin`
This table stores the credentials and personal information of administrators. The fields include:
- `user_id`: A unique identifier for each admin user.
- `firstname`: The admin's first name.
- `lastname`: The admin's last name.
- `email`: The admin's email address.
- `username`: The username for login.
- `password`: The hashed password for login.

## Installation

To set up the project locally:

1. Clone the repository:
   ```bash
   git clone https://github.com/Agostinejohn/Automotive-electronics.git
   ```
2. Import the SQL database:
   - Use phpMyAdmin or the command line to import the `electricks.sql` file.
   ```bash
   mysql -u username -p electricks < electricks.sql
   ```

3. Set up the web server and ensure it can connect to the MySQL database.

## Usage

Once installed and running, the system can be accessed via a web browser where admin users can log in to manage the system.


