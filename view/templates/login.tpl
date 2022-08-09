<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Login</title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  </head>
<body>
	<div class="w-100 h-100 d-flex flex-column justify-content-around align-items-center">

		<div class="row text-center login-page">
			<div class="col-md-12 login-form">
				<form action="index.php" method="post">
          <input type="hidden" name="action" value="login">

					<div class="row">
						<div class="col-md-12 login-form-header">
							<p class="login-form-font-header">Login<p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 login-from-row">
							<input type="text" name="txtUsuario" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 login-from-row">
							<input type="password" name="txtpass" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 login-from-row">
							<button class="btn btn-info">Entrar</button>

						</div>

					</div>
				</form>


			</div>
		</div>

	</div>

</body>
</html>
