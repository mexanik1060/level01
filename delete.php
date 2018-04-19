<?php

require 'database/QueryBuilder.php';

$db = new QueryBuilder;

$id = $_GET['id'];

//$db->deleteTask($id);
$db->delete("tasks", $id);

header('Location: /');

