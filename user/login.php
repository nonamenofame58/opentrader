<?php
session_start();

include '../inc/functions.php';

if (!empty($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	header('Location: account.php');
}

if (isset($_GET['action'])) {
	if ($_GET['action'] == 'logout') {
		session_unset();
		session_destroy();
	}
}
?>

            <?php

			if (isset($_GET['delete_account']) && $_GET['delete_account'] == 'success') {
				echo "Your account has been deleted.";
			}


			if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
				// vars
				$username = $password = "";

				// Get post parameters
				if (isset($_POST['myusername'])) {
					$username = $_POST['myusername'];
				}

				if (isset($_POST['mypass'])) {
					$password = $_POST['mypass'];
				}

				if (empty($username) || empty($password)) {
					die("Info missing.");
				}

				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;

				// Login with username/email and password
				login();
			}
			?>
