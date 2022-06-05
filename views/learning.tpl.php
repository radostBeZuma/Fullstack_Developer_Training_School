<!DOCTYPE html>
<html lang="ru">
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
		<link rel="stylesheet" href="../css/sidebar-teacher.css">
		<link rel="stylesheet" href="../css/learning/my-courses.css">
	<!-- //Blocks CSS end -->

	<!-- Block JS -->
		<script src="../js/sidebar-teacher.js"></script>
		<script src="../js/my-courses.js"></script>
	<!-- //Blocks JS end -->
</head>
	<body>
		<? require_once './blocks/sidebar-teacher.php' ?>
		<? require_once './blocks/my-courses.php' ?>
	</body>
</html>