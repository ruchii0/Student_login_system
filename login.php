<?php
session_start();
include "./connection.php";

$errorMsg = "";


if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";

    $query = $conn->prepare($sql);

    $query->execute([$email]);

    $user = $query->fetch(PDO::FETCH_ASSOC);



        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit();
        } else {
            $errorMsg = "Invalid Credenitials";
        }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background:linear-gradient(to right,#16a34a,#ec4899);
            /* background: #f4f4f4; */
        }

        
        /* Forms */

        .form-container {
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            background: white;
            padding: 40px;
            width: 350px;

            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-box input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;

            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-box button {
            width: 100%;
            padding: 12px;
            border: none;

            background: #2563eb;
            color: white;

            border-radius: 5px;
            cursor: pointer;
        }

        .form-box p {
            text-align: center;
            margin-top: 15px;
        }

    </style>
</head>

<body>

    <div class="form-container">

        <form class="form-box" method="post">

            <h2>Login</h2>

            <?php
            if ( isset($_POST["login"]) && !empty($errorMsg)) {
                echo "<p style='color:red; margin-bottom:15px;'>$errorMsg</p>";
            }
            ?>

            <input type="email" name="email" placeholder="Enter Email" required>

            <input type="password" name="password" placeholder="Enter Password" required>

            <button type="submit" name="login">Login</button>

            <p>
                Don't have an account?
                <a href="signUp.php">Sign Up</a>
            </p>

        </form>

    </div>

</body>

</html> 