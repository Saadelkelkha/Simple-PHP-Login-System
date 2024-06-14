# Simple-PHP-Login-System

## Description
This project demonstrates a basic login system implemented using PHP, HTML, CSS, and MySQL. It includes a login page, a session management system, and a logout functionality. Here's a detailed breakdown of each component:

### 1. `login.php`:
- **HTML Structure**: Contains a form for users to enter their username and password.
- **CSS Styling**: The form is styled to be centered both vertically and horizontally within the viewport, with a specific background color and input field styling.
- **PHP Backend**:
    - When the form is submitted, a PHP script handles the authentication process.
    - The script starts a session, connects to a MySQL database, and verifies the provided credentials against the `employe` table.
    - If the credentials are correct, the user is redirected to `session.php`. Otherwise, an error state is set.

### 2. `session.php`:
- **Session Management**: Ensures that only authenticated users can access the page.
    - If the user is not authenticated, they are redirected back to the login page (`login.php`).
    - Displays a navigation bar with a sign-out link and a message indicating successful connection.

### 3. `deconnexion.php`:
- **Logout Functionality**: Ends the user's session and redirects them to the login page.
    - The script starts the session and sets the session variable `conn` to false, effectively logging the user out.

### Code:

**`login.php`**:
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        form {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
            justify-content: center;
            background-color: rgb(47, 120, 158);
            color: white;
        }
        input {
            width: 50%;
        }
        button {
            width: 20%;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <label for="user">User</label><br>
        <input id="user" name="user" type="text"><br>
        <label for="pwd">Password</label><br>
        <input id="pwd" name="pwd" type="password"><br><br>
        <button type="submit" name="conn">Connexion</button>
    </form>
    <?php
        if (isset($_POST["conn"])) {
            session_start();
            $user = $_POST["user"];
            $pwd = $_POST['pwd'];

            $conn = new PDO("mysql:host=localhost;dbname=entreprise_voyage", "root", "123");
            $sqlstate = $conn->prepare("SELECT * FROM employe WHERE user = ? AND pwd = ?");
            $sqlstate->execute([$user, $pwd]);
            $data = $sqlstate->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $_SESSION['conn'] = true;
                header('Location: session.php');
            } else {
                $_SESSION['conn'] = false;
                echo "<p style='color: red;'>Invalid username or password</p>";
            }
        }
    ?>
</body>
</html>
```

**`session.php`**:
```php
<?php
session_start();
if (!isset($_SESSION['conn']) || $_SESSION['conn'] == false) {
    header('Location: login.php');
} else {
?>
    <nav style="display: flex; text-decoration: none; flex-direction: row; background-color: black; padding-right: 2%;">
        <ul style="list-style-type: none; display: flex; justify-content: space-between; align-content: center; width: 100%; color: white;">
            <li><a href="deconnexion.php" style="text-decoration: none; color: white;">Sign out</a></li>
        </ul>
    </nav>
    <p>Connected successfully</p>
<?php
}
?>
```

**`deconnexion.php`**:
```php
<?php
session_start();
$_SESSION['conn'] = false;
header('Location: login.php');
?>
```

### Features:
- **User Authentication**: Validates user credentials against a database.
- **Session Management**: Ensures secure access to protected pages.
- **User Feedback**: Provides visual feedback on login failure.
- **Responsive Design**: Utilizes flexible layout styles for a responsive user interface.
- **Logout Functionality**: Allows users to securely end their session.
