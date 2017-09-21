<?php

	$username = 'root';
	$password = NULL;

	$todo = new PDO('mysql:host=localhost;dbname=global;charset=utf8', $username, $password);

	$sql_query = 'INSERT INTO global.tasks (description, is_done, date_added) VALUES (?, 0, now())';
	$stm = $todo->prepare($sql_query);
	$stm->execute([$_POST['description']]);

	header("Location: list.php?m=Дело успешно добавлено");