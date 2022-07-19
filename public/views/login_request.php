<?php
$valid = false;
if (isset($_POST["u"]) && isset($_POST["p"])) {
	if ($_POST["u"] === "rsiwal" && $_POST["p"] === "rsiwal") {
		$_SESSION["login"] = TRUE;
		header("Location: /newcampaign");
	} else {
		$_SESSION["error"] = "Invalid username and password";
		header("Location: /login");
	}
}
