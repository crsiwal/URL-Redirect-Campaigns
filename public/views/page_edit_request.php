<?php
global $conn;
load("db.con", "lib");
$id = isset($_POST["id"]) ? $_POST["id"] : "";
$title = isset($_POST["t"]) ? $_POST["t"] : "";
$webUrl = isset($_POST["u"]) ? $_POST["u"] : "";
$bitlyUrl = isset($_POST["b"]) ? $_POST["b"] : "";
$priority = isset($_POST["p"]) ? $_POST["p"] : "";
$error = false;
$error = (!$error && empty($id)) ? "Invalid page selected" : $error;
$error = (!$error && (empty($title) || strlen($title) < 10)) ? "Title should not be blank or less than 10 characters" : $error;
$error = (!$error && strlen($title) > 250) ? "Title should not be more than 250 characters" : $error;
$error = (!$error && (empty($webUrl) || !filter_var($webUrl, FILTER_VALIDATE_URL))) ? "Page URL should be valid" : $error;
$error = (!$error && strlen($webUrl) > 1024) ? "Page URL should not be more than 1024 characters" : $error;
$error = (!$error && !empty($bitlyUrl) && !filter_var($bitlyUrl, FILTER_VALIDATE_URL)) ? "Bitly URL should be valid" : $error;
$error = (!$error && strlen($bitlyUrl) > 1024) ? "Bitly URL should not be more than 1024 characters" : $error;

if (!$error) {
	$title = $conn->real_escape_string($title);
	$sql = "UPDATE wp_pages SET 
	page_name='$title', 
	page_url='$webUrl', 
	bitly_url='$bitlyUrl', 
	priority='$priority' where id=$id";
	if ($conn->query($sql) === TRUE) {
		$error = false;
		$_SESSION["success"] = "Page edited successfully";
	} else {
		$error = true;
		$_SESSION["error"] = $conn->error;
	}
} else {
	$_SESSION["formdata"] = [
		"id" => $id,
		"title" => $title,
		"weburl" => $webUrl,
		"bitly" => $bitlyUrl,
		"priority" => $priority,
	];
	$_SESSION["error"] = $error;
}

if ($error) {
	$redirectLocation = base_url("editpage?id=$id");
	header("Location: $redirectLocation");
} else {
	$redirectLocation = base_url("page");
	header("Location: $redirectLocation");
}
