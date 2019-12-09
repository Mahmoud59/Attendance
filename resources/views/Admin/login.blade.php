<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<form method="post" action="{{ url('admin/login') }}">
	{{ csrf_field() }}
	<input type="email" name="email" placeholder="Email" required>
	<input type="password" name="password" required>
	<input type="submit" name="submit" value="submit">
</form>
</body>
</html>