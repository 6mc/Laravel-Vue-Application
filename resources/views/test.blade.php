<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST" action="/addorder">
	{{ csrf_field() }}
	<input type="text" name="id">
	<input type="text" name="user">
	<input type="text" name="product">
	<input type="text" name="quantity">
	<input type="submit" name="">
</form>
</body>
</html>