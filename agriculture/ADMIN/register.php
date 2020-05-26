<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(bg.jpg);">
	<div class="page-container">
		<div class="page-content" style="width:400px;margin:100px auto;">
			<div class="content-wrapper">
				<div class="panel panel-body login-form">
					<div class="text-center">
						<h5 class="content-group">Register<br><small class="display-block">Enter your details below</small></h5>
					</div>
					<small class="error_div text-danger"></small>
					<div class="form-group has-feedback has-feedback-left">
						<input type="text" class="form-control" placeholder="Username" id="username" required="required">
						<div class="form-control-feedback">
							<i class="icon-user text-muted"></i>
						</div>
					</div>
					<div class="form-group has-feedback has-feedback-left">
						<input type="text" class="form-control" placeholder="Email" id="email" required="required">
						<d<div class="form-group has-feedback has-feedback-left">
						<input type="password" class="form-control" placeholder="Confirm Password" id="cPassword" required="required">
						<div class="form-control-feedback">
							<i class="icon-lock2 text-muted"></i>
						</div>
					</div>
iv class="form-control-feedback">
							<i class="icon-user text-muted"></i>
						</div>
					</div>
					<div class="form-group has-feedback has-feedback-left">
						<input type="password" class="form-control" placeholder="Password" id="password" required="required">
						<div class="form-control-feedback">
							<i class="icon-user text-muted"></i>
						</div>
					</div>
					
					<div class="form-group">
						<input class="btn btn-success btn-block" type="button" id="submit" value="Register"  />
					</div>
					<h6>Already a member? <a href="login.php">Login</a></h6>
				</div>
			</div>
		</div>
	</div>
  	
	<script>
		$(document).ready(function(){			
			//TODO Update User Status
			$('#submit').click(function(){
				var username = $("#username").val();
				var email = $("#email").val();
				var password = $("#password").val();
				var cPassword = $("#cPassword").val();
				if(username == ""){
					$(".error_div").text("Username cannot be empty");
					return false;
				}
				if(email == ""){
					$(".error_div").text("Email cannot be empty");
					return false;
				}
				if(password == "" || cPassword == ""){
					$(".error_div").text("Password cannot be empty");
					return false;
				}
				if(password != cPassword){
					$(".error_div").text("Passwords do not match");
					return false;
				}

				$.ajax({
					type : 'POST', 
					url  : 'operation.php', 
					data : {'functionname':'register', 'name': username, 'password': password, 'email': email}, 
				}).done(function(data) {
					var response = JSON.parse(data);
					if(response.code == 1){
						window.location.href = 'login.php';
					} else {
						$(".error_div").text(response.message);
					}
				}).fail(function(error) {
					console.log(error); 
				});
				return false;
			});			
		});
	</script>
</body>
</html>