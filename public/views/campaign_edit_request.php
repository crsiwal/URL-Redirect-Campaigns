<?php
global $conn;
load("db.con", "lib");
$id = isset($_POST["id"]) ? $_POST["id"] : "";
$title = isset($_POST["t"]) ? $_POST["t"] : "";
$slug = isset($_POST["s"]) ? $_POST["s"] : "";
$description = isset($_POST["d"]) ? $_POST["d"] : "";
$autoSelectImage = (isset($_POST["ias"]) && $_POST["ias"] == "on") ? true : false;
$imageUrl = (!$autoSelectImage && isset($_POST["i"])) ? $_POST["i"] : "";
$autoSelectTargetURL = (isset($_POST["uas"]) && $_POST["uas"] == "on") ? true : false;
$webUrl = (!$autoSelectTargetURL && isset($_POST["u"])) ? $_POST["u"] : "";
$bitlyUrl = (!$autoSelectTargetURL && isset($_POST["b"])) ? $_POST["b"] : "";
$isAdult = (isset($_POST["ia"]) && $_POST["ia"] == "on") ? true : false;
$error = false;
$error = (!$error && empty($id)) ? "Invalid campaign selected" : $error;
$error = (!$error && (empty($title) || strlen($title) < 10)) ? "Title should not be blank or less than 10 characters" : $error;
$error = (!$error && strlen($title) > 250) ? "Title should not be more than 250 characters" : $error;
$error = (!$error && (empty($slug) || strlen($slug) < 1)) ? "Slug should not be blank" : $error;
$error = (!$error && strlen($slug) > 250) ? "Slug should not be more than 250 characters" : $error;
$error = (!$error && (empty($description) || strlen($description) < 20)) ? "Description should not be blank or less than 20 characters" : $error;
$error = (!$error && strlen($description) > 512) ? "Description should not be more than 512 characters" : $error;
$error = (!$error && !$autoSelectImage && (empty($imageUrl) || !filter_var($imageUrl, FILTER_VALIDATE_URL))) ? "Image URL should be valid" : $error;
$error = (!$error && !$autoSelectImage && strlen($imageUrl) > 256) ? "Image URL length should not be more than 256 characters" : $error;
$error = (!$error && !$autoSelectTargetURL && (empty($webUrl) || !filter_var($webUrl, FILTER_VALIDATE_URL))) ? "Target URL should be valid" : $error;
$error = (!$error && !$autoSelectTargetURL && strlen($webUrl) > 256) ? "Target URL length should not be more than 256 characters" : $error;

if (!$error) {
	$result = $conn->query("SELECT id FROM wp_campaigns WHERE id <> $id AND slug='$slug';");
	if ($result && $result->num_rows > 0) {
		$error = "This slug campaign is already exist";
	}
}

if (!$error) {
	if ($autoSelectImage) {
		$result = $conn->query("SELECT image_url FROM wp_images WHERE is_adult=$isAdult LIMIT 1;");
		if ($result && $result->num_rows >= 0) {
			$row = $result->fetch_row();
			$imageUrl = reset($row);
		}
	} else {
		$imageUrl = $conn->real_escape_string($imageUrl);
		$result = $conn->query("SELECT image_url FROM wp_images WHERE image_url='$imageUrl';");
		if ($result && $result->num_rows == 0) {
			$conn->query("INSERT INTO wp_images (image_url, is_adult) VALUES ('$imageUrl', $isAdult);");
		}
	}
	$title = $conn->real_escape_string($title);
	$description = $conn->real_escape_string($description);
	$sql = "UPDATE wp_campaigns SET 
	title='$title', 
	slug='$slug', 
	summery='$description', 
	image_url='$imageUrl',
	page_url='$webUrl', 
	bitly_url='$bitlyUrl',
	is_adult ='$isAdult' where id=$id";
	if ($conn->query($sql) === TRUE) {
		$error = false;
		$_SESSION["success"] = "Campaign edited successfully";
	} else {
		$error = true;
		$_SESSION["error"] = $conn->error;
	}
} else {
	$_SESSION["formdata"] = [
		"id" => $id,
		"title" => $title,
		"slug" => $slug,
		"description" => $description,
		"autoselectimage" => $autoSelectImage,
		"image" => $imageUrl,
		"autoselecttargeturl" => $autoSelectTargetURL,
		"weburl" => $webUrl,
		"bitly" => $bitlyUrl,
		"isadult" => $isAdult,
	];
	$_SESSION["error"] = $error;
}


if ($error) {
	$redirectLocation = base_url("editcampaign?id=$id");
	header("Location: $redirectLocation");
} else {
	$redirectLocation = base_url("campaign");
	header("Location: $redirectLocation");
}
