<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | SyifaPkl</title>
    <link rel="stylesheet" href="{{ asset('storage/assets/css/style.css') }}">
</head>
<body>
    <div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>SMK-IT AS-Syifa Boarding School</b></h4>
					<p>
						Selamat datang di sistem informasi PKL SMK-IT AS-Syifa Boarding School. Silakan masuk dengan ID dan Password Anda untuk melanjutkan.
					</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin login-header -->
				<div class="login-header">
					<div class="brand">
					</span><b>LOGIN</b>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in-alt"></i>
					</div>
				</div>
				<!-- end login-header -->
				<!-- begin login-content -->
				<div class="login-content">
					<form action="/login" method="POST" class="margin-bottom-0">
                        @csrf
						<div class="form-group m-b-15">
							<input type="text" name="id_login" class="form-control form-control-lg" placeholder="Masukan ID" required />
						</div>
						<div class="form-group m-b-15">
							<input type="password" name="password" class="form-control form-control-lg" placeholder="Masukan Password" required />
						</div>
						<div class="login-buttons">
							<button type="submit" name="login" class="btn btn-primary btn-block btn-lg">Login</button>
						</div>
						<div class="text-inverse" style="color: #000000; font-weight: 600;">
							Forgot your ID / Password? <a href=""></a>
						</div>
						<hr />
						<p class="text-grey-darker" style="color: rgb(0, 0, 0);">
							&copy; 2025
						</p>
					</form>
				</div>
				<!-- end login-content -->
			</div>
			<!-- end right-container -->
		</div>
		<!-- end login -->
	</div>
	<!-- end page container -->
</body>
</html>



{{-- <h2>Login PKL</h2>
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
    <form method="POST" action="/login">
        @csrf
        <input type="text" name="login_id" placeholder="ID Login" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form> --}}
