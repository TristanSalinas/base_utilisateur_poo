<?php
require "./managers/UserManager.class.php";
$userManager = new UserManager();
$userManager->loadUsers();

/** @var User[] */
$usersList = $userManager->getUsers();
