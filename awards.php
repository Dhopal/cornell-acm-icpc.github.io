<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Cornell ACM ICPC</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link rel="stylesheet" type="text/css" href="style/awards.css" />
	<link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Noticia+Text' rel='stylesheet' type='text/css'>
</head>
<body>
	<?php include("header.html"); ?>

	<?php
		$group = "v6MkQyGqda";
		$contest = "100247";
		$method = "contest.standings";
		$count = "5";

		$key = "fc31ad31931b6eac766fee64d80074f1cd0256ea";
		$secret = "d9a388cb8beeafdec0b45a11d81ec87f57d25781";
		$time = time() / 1000;
		$random = 0;

		for ($x=1; $x<=6;$x++) {
			$random = $random + ($x * rand(0,9));
		}

		$random = strval($random);

		$apiSig = $random .  "/" . $method . "?" . "apiKey=" . $key . "&contestId=" . $contest . "&count=" . $count . "&time=" . $time . "#" . $secret;

		$hash = hash("sha512", $apiSig);

		$apiSig = $random . $apiSig;

		$request = "http://codeforces.com/api/" . $method . "?" . "contestId=" . $contest . "&count=" . $count . "&apiKey=" . $key . "&time=" . $time . "&apiSig=" . $apiSig;

		$xml = file_get_contents($request);
	?>
	<div id="content">
		<h1>Awards</h1>
		<p>As part of our training, our members practice on CodeForce.  Below you can see their performance</p>
	</div>
</body>