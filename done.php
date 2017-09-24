<?php

	$username = 'root';
	$password = NULL;

	$todo = new PDO('mysql:host=localhost;dbname=global;charset=utf8', $username, $password);

	$sql_query = 'UPDATE tasks SET is_done = 1 WHERE id = ?';
	$stm = $todo->prepare($sql_query);
	$stm->execute([$_GET['id']]);

	header("Location: list.php?m=Дело успешно выполнено");