<?php
$newPageUrl = base_url('newpage');

if (isset($_POST["t"]) && isset($_POST["u"])) {
	load("db.con", "lib");
	global $conn;
	$title = $_POST["t"];
	$webUrl = $_POST["u"];
	$bitlyUrl = $_POST["b"];
	$priority = $_POST["p"];
	$_SESSION["formdata"] = [
		"title" => $title,
		"weburl" => $webUrl,
		"bitly" => $bitlyUrl,
		"priority" => $priority
	];

	if (!empty($title) && !empty($webUrl)) {
		if (filter_var($webUrl, FILTER_VALIDATE_URL)) {

			$sql = "INSERT INTO wp_pages (page_name, page_url, bitly_url, priority) VALUES ('$title', '$webUrl', '$bitlyUrl', '$priority')";
			$result = $conn->query("select id from wp_pages where page_url='$webUrl'");

			if ($result && $result->num_rows == 0) {
				if ($conn->query($sql) === TRUE) {
					$valid = true;
					$_SESSION["success"] = "Webpage added successfully";
				} else {
					$_SESSION["error"] = $conn->error;
				}
			} else {
				$_SESSION["error"] = "This URL is already exist";
			}
		} else {
			$_SESSION["error"] = "Please input a valid web page url.";
		}
	} else {
		$_SESSION["error"] = "Title and Webpage url should not be blank";
	}
}
header("Location: $newPageUrl");
