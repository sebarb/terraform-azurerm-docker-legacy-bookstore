# Online Bookstore — Legacy Application Modernization

A restoration and modernization project based on a legacy PHP/MySQL online bookstore originally deployed in 2004.

The main goal is not to rebuild the bookstore as a modern e-commerce application from scratch, but to use a real legacy application as a workload for learning and demonstrating:

- Docker and Docker Compose
- Containerization
- MySQL administration
- Configuration and secret management
- Microsoft Azure
- Infrastructure as Code with Terraform
- CI/CD

## Current Status

The legacy application has been restored and can now run locally using Docker.

Work completed so far:

- Restored the MySQL database structure
- Recreated sample data
- Updated the application for PHP 8 compatibility
- Migrated database access to PDO
- Added prepared statements
- Replaced legacy password handling with `password_hash()` / `password_verify()`
- Preserved temporary compatibility with legacy MD5 password hashes for migration purposes
- Fixed UTF-8 / `utf8mb4` support
- Separated credentials from source code using environment variables
- Containerized the PHP/Apache application
- Containerized MySQL for local development
- Added MySQL persistence using a Docker volume
- Added automatic database initialization
- Added administrator bootstrap using environment variables
- Refreshed the original user interface while preserving the legacy application's functionality

## Local Architecture

The project currently runs using two Docker containers:

```text
                  Browser
                     │
                     │ HTTP :8080
                     ▼
             ┌─────────────────┐
             │   PHP / Apache  │
             │    Container    │
             └────────┬────────┘
                      │
                      │ MySQL :3306
                      ▼
             ┌─────────────────┐
             │      MySQL      │
             │    Container    │
             └────────┬────────┘
                      │
                      ▼
               Docker Volume
                 mysql_data
```

Docker Compose orchestrates both services.

## Project Structure

```text
.
├── app/
│   ├── administrare/
│   ├── coperti/
│   ├── imagini/
│   ├── stil/
│   │   └── stil.css
│   ├── index.php
│   ├── conectare.php
│   ├── meniu.php
│   ├── page_top.php
│   ├── page_bottom.php
│   ├── carte.php
│   ├── autor.php
│   ├── domeniu.php
│   ├── cautare.php
│   ├── cos.php
│   ├── casa.php
│   ├── statistici.php
│   └── ...
│
├── database/
│   ├── create_database.sql
│   └── insert_data_db.sql
│
├── php/
│   ├── Dockerfile
│   └── create-admin.php
│
├── docker-compose.yml
├── .env.example
├── .gitignore
└── README.md
```

### `app/`

Contains the PHP application itself.

The application includes:

- Book catalog
- Authors and categories
- Search
- Shopping cart
- Sales statistics
- Administration area

### `database/`

Contains the SQL scripts required to initialize MySQL.

`create_database.sql` defines the database schema, while `insert_data_db.sql` inserts sample data.

The scripts are mounted into:

```text
/docker-entrypoint-initdb.d
```

and are automatically executed when a new MySQL data volume is initialized.

The database uses `utf8mb4`.

### `php/`

Contains the files required to build and initialize the PHP/Apache container.

`Dockerfile` defines the application image.

`create-admin.php` is used to bootstrap the administrator account without storing a known administrator password or password