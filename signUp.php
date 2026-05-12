<?php

include "./connection.php";
$nameBlankmsg = "";
$emailBlankmsg = "";
$passBlankmsg = "";
$successMsg = "";

if (isset($_POST["signUp"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($name)) {
        $nameBlankmsg = "Name is required";
    }

    if (empty($email)) {
        $emailBlankmsg = "Email is mandatory for sign up!";
    }

    if (empty($password)) {
        $passBlankmsg = "Give Password";
    }

    if (empty($nameBlankmsg) && empty($emailBlankmsg) && empty($passBlankmsg)) {

        $password = password_hash("$password", PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        $query = $conn->prepare($sql);

        $query->execute([$name, $email, $password]);

        $successMsg = "User Sign Up Successfully ✅";
    }

    header("Location: login.php");
    exit();
}
?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sign Up</title>
     <style>
         * {
             margin: 0;
             padding: 0;
             box-sizing: border-box;
             font-family: Arial, Helvetica, sans-serif;
         }

         body {
             background:linear-gradient(to right,#16a34a,#ec4899);
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

     </style
     </style>
 </head>

<body>
    <div class="form-container">
        
        <form class="form-box" action="signUp.php" method="POST">
            <h2>Sign up Here</h2>
            <div style="color: green;"><?php echo $successMsg; ?></div>
            <div class="error"><?php echo $nameBlankmsg; ?></div>
            <input type="text" name="name" placeholder="Enter your name">
            <br><br>
            <div class="error"><?php echo $emailBlankmsg; ?></div>
            <input type="email" name="email" placeholder="Enter your valid Email">
            <br><br>
            <div class="error"><?php echo $passBlankmsg; ?></div>
            <input type="password" name="password" placeholder="Enter password">
            <br><br>
            <button name="signUp">Sign In</button>

            <p>
                Already have an account
                <a href="login.php">Go for login</a>
            </p>
        </form>

        
    </div>
</body>

</html>