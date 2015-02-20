<?php 
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$dsn = "mysql:host=localhost;dbname=booklibrary;charset=$charset";
try {
    $dbh = new PDO($dsn, 'root', '');
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

$app->get('/', function() use ($app) {
	$app->response->write('RESt api');
});

$app->get('/books', function() use ($app, $dbh) {
	$stmt = $dbh->prepare('SELECT * FROM book');
	$stmt->execute();
    $app->response->write(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
});

$app->get('/books/:id', function($id) use ($app, $dbh) {
	$stmt = $dbh->prepare('SELECT * FROM book WHERE id = :id');
	$stmt->execute([':id' => $id]);
    $app->response->write(json_encode($stmt->fetchAll(PDO::FETCH_ASSOC)));
});

$app->run();