<?php 
require 'vendor/autoload.php';

function my_log_file( $msg, $name = '' )
{
    // Print the name of the calling function if $name is left empty
    $trace=debug_backtrace();
    $name = ( '' == $name ) ? $trace[1]['function'] : $name;

    $error_dir = 'D:/php_error.log';
    $msg = print_r( $msg, true );
    $log = $name . "  |  " . $msg . "\n";
    error_log( $log, 3, $error_dir );
}

$app = new \Slim\Slim();

$dsn = "mysql:host=localhost;dbname=booklibrary";
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

$app->post('/books', function() use ($app, $dbh) {
	$data = json_decode($app->request->getBody(), true);
	$stmt = $dbh->prepare('INSERT INTO book (title,author,releaseDate) VALUES (:title,:author,:releaseDate)');
	$res = $stmt->execute([
		':title' => $data['title'],
		':author' => $data['author'],
		':releaseDate' => $data['releaseDate'],
	]);
	$str = $res ? json_encode(['id' => $dbh->lastInsertId()]) : 'Error';
	$app->response->write($str);
});

$app->delete('/books/:id', function($id) use ($app, $dbh) {
	$stmt = $dbh->prepare('DELETE FROM book WHERE id = :id');
	$res = $stmt->execute([':id' => $id]);
	$str = $res ? 'Success!' : 'Error';
	$app->response->write($str);
});

$app->run();