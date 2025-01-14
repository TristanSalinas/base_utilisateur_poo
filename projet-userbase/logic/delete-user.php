<?php
require "../managers/UserManager.class.php";
if (isset(
  $_GET["id"],
)) {
  $userManager = new UserManager();
  $userManager->deleteUser($_GET["id"]);
}
header('Location: ../index.php');
