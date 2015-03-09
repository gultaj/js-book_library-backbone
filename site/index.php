<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/screen.css" />
</head>
<body>
	<div id="books">
		<form id="addBook" action="#">
			<div>
				<label for="cover">CoverImage: </label><input id="cover" type="file" />
				<label for="title">Title: </label><input id="title" type="text" />
				<label for="author">Author: </label><input id="author" type="text" />
				<label for="releaseDate">Release date: </label><input id="releaseDate" type="date" />
				<label for="tags">Keywords: </label><input id="tags" type="text" />
				<button id="add">Add</button>
			</div>
		</form>
		<div id="book-list"></div>
	</div>
	<script id="bookTemplate" type="text/template">
		<img src="<%= cover %>"/>
		<ul>
			<li><%= title %></li>
			<li><%= author %></li>
			<li><%= releaseDate %></li>
			<li><%= tags %></li>
		</ul>
		<button class="delete">Delete</button>
	</script>
	<script type="text/javascript" src="js/vendor/jquery.min.js"></script>
	<script type="text/javascript" src="js/vendor/underscore-min.js"></script>
	<script type="text/javascript" src="js/vendor/backbone-min.js"></script>
	<script type="text/javascript" src="js/models/book.js"></script>
	<script type="text/javascript" src="js/collections/library.js"></script>
	<script type="text/javascript" src="js/views/book-view.js"></script>
	<script type="text/javascript" src="js/views/library-view.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
</body>
</html>