<?php
require_once "config.php";

session_start();
$errors = array();
$success = "";

$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $db = getDbConnection();

    // Check if username is empty
    if (empty(trim($_POST['username']))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST['username']);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $username_err = "This username is already taken.";
            } else {
                $username = trim($_POST['username']);
            }
        }
    }

    // Check if email is empty
    if (empty(trim($_POST['email']))) {
        $email_err = "Email cannot be blank";
    } else {
        $sql = "SELECT id FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST['email']);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $email_err = "This email is already registered.";
            } else {
                $email = trim($_POST['email']);
            }
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
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $db->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if ($stmt->execute()) {
                header("location: index.html");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
    }
}
?>