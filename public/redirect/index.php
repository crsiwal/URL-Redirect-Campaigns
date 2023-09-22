<?php
global $request, $conn;
load("db.con", "lib");
$request =  $conn->real_escape_string($request);
$query = "SELECT title, summery, image_url, page_url, bitly_url FROM wp_campaigns WHERE slug='$request'";
$result = $conn->query($query);
$content = [
	"title" => "Redirect your link",
	"description" => "Redirect your link",
	"image" => "",
	"link" => "https://link.gchat.in/",
];

if ($result) {
	$campaign = $result->fetch_array(MYSQLI_ASSOC);
	if (is_array($campaign) && count($campaign) > 0) {
		$content["title"] = $campaign["title"];
		$content["description"] = $campaign["summery"];
		$content["image"] = $campaign["image_url"];
		if (!empty($campaign["bitly_url"])) {
			$content["link"] = $campaign["bitly_url"];
		} elseif (!empty($campaign["page_url"])) {
			$content["link"] = $campaign["page_url"];
		} else {
			$page_result = $conn->query("SELECT page_url, bitly_url FROM wp_pages ORDER BY Priority DESC, RAND() LIMIT 1;");
			$page = $page_result->fetch_array(MYSQLI_ASSOC);
			if (is_array($page)) {
				if (!empty($page["bitly_url"])) {
					$content["link"] = $page["bitly_url"];
				} else {
					$content["link"] = $page["page_url"];
				}
			}
		}
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
	<meta name="robots" content="noodp,noydir" />
	<title><?= $content['title']; ?></title>
	<meta name="description" content="<?= $content['description']; ?>">
	<meta name="og:title" content="<?= $content['title']; ?>" />
	<meta name="og:description" content="<?= $content['description']; ?>" />
	<meta name="og:url" content="<?= $content['link']; ?>" />
	<meta name="og:image" content="<?= $content['image']; ?>" />
	<link rel="shortcut icon" href="https://link.gchat.in/favicon.ico" type="image/x-icon">
	<link rel="icon" href="https://link.gchat.in/favicon.ico" type="image/x-icon">
	<script>
		setTimeout(function() {
			window.location.href = '<?= $content['link']; ?>';
		}, 2000);
	</script>
</head>

<body style="width: 100%; max-width: 500px; margin:auto;">
	<h2 style="font-size: 20px; line-height: 1.5em;"><?= $content['title']; ?></h2>
	<p style="font-size: 14px; line-height: 1.5em;"><?= $content['description']; ?></p>
	<img style="width:100%" src="<?= $content['image']; ?>" />
</body>

</html>