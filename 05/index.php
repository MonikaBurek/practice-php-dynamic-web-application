<?php
require 'Database.php';

$config = require 'config.php';

$db = new Database($config['database']);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $author = $db->query("SELECT * FROM authors WHERE id ={$id}")->fetch();
    echo "<li>" . "Id=" . $author['id'] . " Name: " . $author['name'] . '</li>';
} else {
    $authors = $db->query("SELECT * FROM authors")->fetchAll();

    foreach ($authors as $author) {
        echo "<li>" . "Id=" . $author['id'] . " Name: " . $author['name'] . '</li>';
    }
}
