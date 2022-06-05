<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>
		<?= $pageData['title']?>
	</title>

	<link type="image/png" sizes="16x16" rel="icon" href="../upload/images/favicon.png">
	<link rel="stylesheet" href="../css/component.css">

	<!-- Blocks CSS -->
		<link rel="stylesheet" href="../css/cabinet/side-bar.css">
		<link rel="stylesheet" href="../css/homework/homework.css">
	<!-- //Blocks CSS end -->

	<!-- Block JS -->

		<script src="../js/side-bar.js"></script>
		<script src="../js/homework.js"></script>
	<!-- //Blocks JS end -->
</head>
	<body>
		<? include_once './blocks/sidebar.php'?>
		<? include_once './blocks/homework.php'?>
	</body>
</html>