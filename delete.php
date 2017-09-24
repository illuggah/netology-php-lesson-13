<?php

	$username = 'root';
	$password = NULL;

	$todo = new PDO('mysql:host=localhost;dbname=global;charset=utf8', $username, $password);

	$sql_query = 'DELETE FROM tasks WHERE id = ?';
	$stm = $todo->prepare($sql_query);
	$stm->execute([$_GET['id']]);

	header("Location: list.php?m=Дело удалено");