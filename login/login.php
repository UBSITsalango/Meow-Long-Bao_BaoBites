<?php
  include "crud.php";
  $oop = new crud();

  if (isset($_POST['register'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $oop->registration($fname, $lname, $username, $email, $password);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
</head>
<body>
  <form method="post">
    <center>
        <table>
            <tr>
              <th>REGISTRATION</th>
            </tr>
            <tr>
              <td><input type="text" placeholder="First Name:" name="fname" required></td>
            </tr>
            <tr>
              <td><input type="text" placeholder="Last Name:" name="lname" required></td>
            </tr>
            <tr>
              <td><input type="text" placeholder="Username:" name="username" required></td>
            </tr>
            <tr>
              <td><input type="email" placeholder="Email:" name="email" required></td>
            </tr>
            <tr>
              <td><input type="password" placeholder="Password:" name="password" required></td>
            </tr>
            <tr>
              <td><button name="register"> REGISTER</button></td>
            </tr>
        </table>
    </center>
  </form>
</body>
</html>