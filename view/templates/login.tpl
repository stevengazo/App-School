<!DOCTYPE html >
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
		crossorigin="anonymous"></script> 

</head>

<body  class="d-flex flex-column justify-content-center align-content-center" style="width:99vmax; height:100vh; margin: 0%; padding: 2px;background: rgb(19,19,203);background: linear-gradient(0deg, rgba(19,19,203,1) 1%, rgba(0,212,255,1) 67%, rgba(245,252,255,1) 99%);">
	<div class="d-flex justify-content-center ">
		<div class="p-5 bg-light rounded w-auto border shadow-lg">
			<div class="d-flex justify-content-center mb-4">
				<img src="images/logo.png"  style="width:11rem;height:6rem;" alt="logo">
			</div>
			<form action="index.php" method="post" class="d-flex flex-column justify-content-around" >
				<input type="hidden" name="action" value="login">	
				<div class="form-floating mb-3">
					<input type="text" name="txtUsuario" class="form-control" id="floatingInput" placeholder="name@example.com">
					<label for="floatingInput">Usuario</label>
				  </div>
				<div class="form-floating mb-3">
					<input type="password" name="txtpass" class="form-control" id="floatingPassword" placeholder="Password" required>
					<label for="floatingPassword">Password</label>
				  </div>					

				<div class="row mb-3 d-flex justify-content-center p-3">		
					<button class="btn btn-sm btn-outline-info">Entrar</button>
				</div>
				<div class="mb-2">
				<label class="text-danger h6">
					{$msg}
				</label>
				</div>
			</form>
		</div>	
	</div>
</body>

</html>