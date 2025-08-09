<!DOCTYPE html>
<html>
<head>
    <title>Login PKL</title>
</head>
<body>
    <h2>Login PKL</h2>
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    <form method="POST" action="/login">
        @csrf
        <input type="text" name="id_login" placeholder="ID Login" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
