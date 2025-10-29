<?php

require 'Database.php';

$config = require 'config.php';

$db = new Database($config['database']);

function viewListBooks($books): void
{
    foreach ($books as $book) {
        echo "<li>" . "(Id=" . $book['id'] . ") " . $book['title'] . '</li>';
    }
}

?><h2>Pierwotna lista książek: </h2><?php

$books = $db->select('books');
$numberOfBooks = count($books);

if ($numberOfBooks > 0) {

    viewListBooks($books);

    ?><p>Usuwam ostatnią książkę z listy </p><?php

    $db->delete('books', $numberOfBooks);

    ?><h2>Nowa lista po usunięciu jednego elementu </h2><?php

    $books = $db->select('books');
    viewListBooks($books);
} else {
    ?>
    <h1>Tabela jest pusta.</h1>
    <?php
}
