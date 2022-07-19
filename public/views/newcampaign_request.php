<?php
$newPageUrl = base_url('newcampaign');

if (isset($_POST["t"]) && isset($_POST["u"])) {
	load("db.con", "lib");
	global $conn;
	$title = $_POST["t"];
	$slug = $_POST["s"];
	$message = $_POST["m"];
	$imageUrl = $_POST["i"];
	$webUrl = $_POST["u"];
	$bitlyUrl = $_POST["b"];
	$isAdult = $_POST["ia"];

	$_SESSION["formdata"] = [
		"title" => $title,
		"slug" => $slug,
		"message" => $message,
		"image" => $imageUrl,
		"weburl" => $webUrl,
		"bitly" => $bitlyUrl,
		"isadult" => $isAdult,
	];

	if (!empty($title) && !empty($slug)) {
		if (filter_var($webUrl, FILTER_VALIDATE_URL)) {
			$createTime = date('d-m-Y h:i:s a', time());

			$sql = "INSERT INTO wp_campaigns (title, slug, summery, image_url, page_url, bitly_url, is_adult, create_time) 
					VALUES ('$title', '$slug', '$message', '$imageUrl', '$webUrl', '$bitlyUrl', '$priority', '$createTime')";






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
