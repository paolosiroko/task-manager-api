# Task Management API Documentation

## Overview
This API allows users to perform basic CRUD (Create, Read, Update, Delete) operations on tasks. It includes filters for task status and due date, as well as search functionality. The API is built using Lumen and uses PostgreSQL for data storage.

## Features:
- Create a task
- Retrieve all tasks (with optional filters and search)
- Retrieve a specific task by ID
- Update a task
- Delete a task

## Endpoints:

### 1. Create a Task
- **Endpoint:** `POST /api/tasks`

- **Request Body (JSON):**
    ```json
    {
        "title": "Complete API",
        "description": "Build the task management API",
        "due_date": "2024-12-31"
    }
    ```

### 2. Get All Tasks
- **Endpoint:** `GET /api/tasks`
- **Optional Query Parameters:**
  - `status` (pending, completed)
  - `due_date` (YYYY-MM-DD format)
  - `search` (search by part of the task title)

- **Example Request:**
    ```bash
    GET /api/tasks?status=pending&due_date=2024-12-31&search=API
    ```

### 3. Get a Specific Task
- **Endpoint:** `GET /api/tasks/{id}`

- **Example Request:**
    ```bash
    GET /api/tasks/1
    ```

### 4. Update a Task
- **Endpoint:** `PUT /api/tasks/{id}`

- **Request Body (JSON):**
    ```json
    {
        "title": "Update API Documentation",
        "description": "Add task filtering and search documentation",
        "status": "completed",
        "due_date": "2024-12-31"
    }
    ```

### 5. Delete a Task
- **Endpoint:** `DELETE /api/tasks/{id}`

- **Example Request:**
    ```bash
    DELETE /api/tasks/1
    ```

## Setting Up the API from GitHub

### 1. Clone the Repository
First, clone the repository from GitHub:
```bash
git clone https://github.com/paolosiroko/task-manager-api.git
cd task-management-api



## 2. Install Dependencies

Install all the necessary dependencies using Composer:

composer install
### 3. Set Up Environment Variables
Create a .env file by copying the .env.example:

cp .env.example .env
Then, configure the database connection for PostgreSQL in the .env file:

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=task_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password

### 4. Run Migrations
Run the migrations to create the necessary tables in the PostgreSQL database:


php artisan migrate
###  5. Run the API Server
Start the Lumen API server:

php -S localhost:8800 -t public
### Your API will now be accessible at http://localhost:8800/api.
