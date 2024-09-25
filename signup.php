<?php
require_once "config.php";

session_start();
$errors = array();
$success = "";

$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    


    // Check if username is empty
    if (empty(trim($_POST['username']))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST['username']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "Something went wrong.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Check if email is empty
    if (empty(trim($_POST['email']))) {
        $email_err = "Email cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST['email']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already registered.";
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo "Something went wrong.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // Check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank.";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password must have at least 5 characters.";
    } else {
        $password = trim($_POST['password']);
    }

    // Check for confirm password field
    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = "Password and Confirm password do not match.";
        }
    }

    // If there were no errors, insert into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.html");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>