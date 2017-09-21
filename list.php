<?php

	$username = 'root';
	$password = NULL;

	$todo = new PDO('mysql:host=localhost;dbname=global;charset=utf8', $username, $password);

	$sql_query = 'SELECT id, description, is_done, date_added FROM global.tasks';
	$stm = $todo->prepare($sql_query);
	$stm->execute();

	$extracted = [];

	while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
		$extracted[] = $row;
	}

	$message = $_GET['m'];	

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TODO | List</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
		body {font-size: 11pt;}
	</style>
</head>
<body style="background-color: #d5deed">
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">TODO | List</a>

			</div>
			<div class="navbar-collapse navbar-top collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">СПИСОК ДЕЛ</a></li>
					<!--<li><a href="add.php">ДОБАВИТЬ ДЕЛО</a></li>
					<li><a href="delete.php">УДАЛИТЬ ДЕЛО</a></li>-->
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">

		<h2>Список дел</h2>
		
		<div style="height: 16px">
			<span id="msg"><?=$message?></span>
		</div>
		

		<hr>
		
		<table class="table">
			<tr><th>Описание</th><th>Статус</th><th>Дата публикации</th><th>Отметить как выполненное</th><th>Удалить</th></tr>
			<?php
				$td = '</td><td>';
				foreach ($extracted as $row) {
					if ($row['is_done'] == 1) {
						$row['is_done'] = '<span class="text-success">Выполнено</span>';
					} elseif ($row['is_done'] == 0) {
						$row['is_done'] = '<span class="text-danger">Не выполнено</span>';
					} else {
						$row['is_done'] = '<span class="text-warning">Неизвестно</span>';
					}

					$mark_as_done = '<a href="done.php?id=' . $row['id'] . '"><i class="fa fa-check-circle text-success"></i></a>';
					$delete_btn = '<a href="delete.php?id=' . $row['id'] . '"><i class="fa fa-trash text-danger"></i></a>';

					echo '<tr><td>' . $row['description'] .$td. $row['is_done'] .$td. $row['date_added'] .$td. $mark_as_done .$td. $delete_btn . '</td></tr>';
				}
			?>
		</table>

		<hr>
		<hr>
		
		<h2>Добавить дело</h2>

		<hr>
		
		<div class="col-md-8 col-md-offset-2">
			<form action="add.php" method="post">
				<textarea class="form-control" name="description"></textarea>
				<button type="submit" class="btn btn-success form-control">Добавить</button>
			</form>
		</div>
	</div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		$('#msg').fadeOut(5000);
	</script>
</body>
</html>