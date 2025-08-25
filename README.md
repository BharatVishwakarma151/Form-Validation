# PHP Form Validation Project

This project demonstrates a simple PHP-based form validation system with MySQL database integration. It allows users to submit their username, email, phone number, and place, and validates the input both on the server side and (optionally) on the client side.

## Features

- **Server-side validation** for:
  - Username (3–20 characters)
  - Email (valid format, uniqueness)
  - Phone number (10 digits, uniqueness)
  - Place (3–30 characters)
  - All fields required
- **Duplicate checking** for email, username, and phone number in the database
- **Error messages** displayed for invalid or duplicate entries
- **Data insertion** into a MySQL table (`crud`) upon successful validation
- **Basic styling** via `style.css`
- **JavaScript** for clearing error messages on input focus (with minor corrections needed)

## Folder Structure

```
Form_Validation/
├── index.php
├── includes/
│   └── connect.php
├── style.css
```

## Setup Instructions

1. **Clone or download** this repository to your local machine.
2. **Set up your MySQL database**:
   - Create a database (e.g., `form_validation`).
   - Create a table named `crud` with columns: `id`, `username`, `email`, `phone`, `address`.
   - Example SQL:
     ```sql
     CREATE TABLE crud (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL,
       email VARCHAR(100) NOT NULL,
       phone VARCHAR(15) NOT NULL,
       address VARCHAR(100) NOT NULL
     );
     ```
3. **Configure database connection** in `includes/connect.php`:
   ```php
   <?php
   $con = mysqli_connect('localhost', 'root', '', 'form_validation');
   if (!$con) {
       die('Connection failed: ' . mysqli_connect_error());
   }
   ?>
   ```
4. **Start your local server** (e.g., XAMPP, WAMP) and navigate to the project folder in your browser.

## Usage

- Fill out the form fields and submit.
- If validation fails, error messages will be shown.
- On success, your data is inserted into the database and a success alert is shown.

## Notes

- The project uses **server-side validation** for security.
- **Prepared statements** are recommended for production to prevent SQL injection.
- The JavaScript for clearing error messages needs minor corrections (e.g., `addEventListener` typo).

## License

This project is for educational purposes.
