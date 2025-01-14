<?php
require "../managers/UserManager.class.php";
if (isset(
  $_POST["password"],
  $_POST['username'],
  $_POST['email'],
  $_POST['role']
)) {

  $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $newUser = new User(
    $_POST['username'],
    $_POST['email'],
    $hashedPassword,
    $_POST['role']
  );
  $userManager = new UserManager();
  $userManager->saveUser($newUser);
}
header('Location: ../index.php');
