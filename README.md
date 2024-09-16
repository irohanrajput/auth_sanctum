<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Student Management API

This API allows you to manage student records in a MySQL database. It supports CRUD (Create, Read, Update, Delete) operations.

## Base URL

The base URL for the API is:
https://localhost:8000/



## Endpoints

### 1. **Create Student**

- **URL**: `/create`
- **Method**: `POST`
- **Description**: Creates a new student record.
- **Request Body** (JSON):
    ```json
    {
        "name": "Student Name",
        "registration_id": 12345
    }
    ```
- **Success Response**:
    - **Code**: 201
    - **Content**:
    ```json
    {
        "message": "Student created successfully."
    }
    ```
- **Error Responses**:
    - **Code**: 400
    - **Content**:
    ```json
    {
        "message": "Incomplete data."
    }
    ```
    - **Code**: 503
    - **Content**:
    ```json
    {
        "message": "Unable to create student."
    }
    ```

### 2. **Read All Students**

- **URL**: `/read`
- **Method**: `GET`
- **Description**: Retrieves all student records.
- **Success Response**:
    - **Code**: 200
    - **Content**:
    ```json
    [
        {
            "id": 1,
            "name": "Student Name",
            "registration_id": 12345
        },
        {
            "id": 2,
            "name": "Another Student",
            "registration_id": 67890
        }
    ]
    ```
- **Error Response**:
    - **Code**: 404
    - **Content**:
    ```json
    {
        "message": "No students found."
    }
    ```

### 3. **Read Single Student**

- **URL**: `/read_one`
- **Method**: `GET`
- **Description**: Retrieves a single student record by ID or registration number.
- **Request Parameters**:
    - `id`: The ID of the student to retrieve (optional).
    - `registration_id`: The registration number of the student to retrieve (optional).
- **Success Response**:
    - **Code**: 200
    - **Content**:
    ```json
    {
        "id": 1,
        "name": "Student Name",
        "registration_id": 12345
    }
    ```
- **Error Responses**:
    - **Code**: 400
    - **Content**:
    ```json
    {
        "message": "ID or registration number required."
    }
    ```
    - **Code**: 404
    - **Content**:
    ```json
    {
        "message": "Student not found."
    }
    ```

### 4. **Update Student**

- **URL**: `/update`
- **Method**: `PUT`
- **Description**: Updates an existing student record.
- **Request Body** (JSON):
    ```json
    {
        "id": 1,
        "name": "Updated Name",
        "registration_id": 54321
    }
    ```
- **Success Response**:
    - **Code**: 200
    - **Content**:
    ```json
    {
        "message": "Student updated successfully."
    }
    ```
- **Error Responses**:
    - **Code**: 400
    - **Content**:
    ```json
    {
        "message": "Incomplete data."
    }
    ```
    - **Code**: 503
    - **Content**:
    ```json
    {
        "message": "Unable to update student."
    }
    ```

### 5. **Delete Student**

- **URL**: `/delete`
- **Method**: `DELETE`
- **Description**: Deletes a student record by ID.
- **Request Body** (JSON):
    ```json
    {
        "id": 1
    }
    ```
- **Success Response**:
    - **Code**: 200
    - **Content**:
    ```json
    {
        "message": "Student deleted successfully."
    }
    ```
- **Error Responses**:
    - **Code**: 400
    - **Content**:
    ```json
    {
        "message": "Student ID required."
    }
    ```
    - **Code**: 503
    - **Content**:
    ```json
    {
        "message": "Unable to delete student."
    }
    ```

## Error Codes

- **400 Bad Request**: The request was invalid or missing required data.
- **404 Not Found**: The requested resource could not be found.
- **503 Service Unavailable**: The server could not fulfill the request due to a temporary issue.

## Notes

- Ensure that the `config/Database.php` file is correctly configured with your database credentials.
- Make sure that the `ResponseHelper.php` file is included in all endpoints for consistent response formatting.
