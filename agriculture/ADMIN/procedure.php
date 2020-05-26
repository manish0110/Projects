<?php
  session_start();
  error_reporting('E_ALL');
  include 'db_connection.php';
  if ($_SESSION['username'] == "") {
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  table{
	  background-color:white;
  }
  .form-control{
	margin-bottom:5px;
  }
  .navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus, .navbar-inverse .navbar-nav>.active>a:hover {
    color: #fff;
	background-color: #016549;
  }
  </style>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" style="margin-bottom:0px;background-color: #0a8c68;border-color: #016549;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#" style="color:#fff;">Agriculture</a>
			</div>
		</div>
	</nav>
	<div class="container-fluid" style="padding:0px;margin-top:51px;">
  		<div class="col-md-2" style="padding:0px;">
  			<!--div class="col-md-12" style="padding:10px 15px; border-bottom: 1px solid #ccc;"><a href="index.php">CROP</a></div>
			<div class="col-md-12" style="padding:10px 15px; border-bottom: 1px solid #ccc;"><a href="plough.php">PLOUGHING METHOD</a></div>
			<div class="col-md-12" style="padding:10px 15px; border-bottom: 1px solid #ccc;"><a href="fertilizer.php">FERTILIZER</a></div>
			<div class="col-md-12" style="padding:10px 15px; border-bottom: 1px solid #ccc;"><a href="pesticide.php">PESTICIDE</a></div>
			<div class="col-md-12" style="padding:10px 15px; border-bottom: 1px solid #ccc;"><a href="cropplough.php">CROP PLOUGH</a></div>
			<div class="col-md-12" style="padding:10px 15px; border-bottom: 1px solid #ccc;"><a href="fertilizer.php">CROP FERTILIZER</a></div>
			<div class="col-md-12" style="padding:10px 15px; border-bottom: 1px solid #ccc;"><a href="pesticide.php">CROP PESTICIDE</a></div-->
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">CROP</a></li>
				<li><a href="plough.php">PLOUGHING METHOD</a></li>
				<li><a href="fertilizer.php">FERTILIZER</a></li>
				<li><a href="pesticide.php">PESTICIDE</a></li>
				<li><a href="cropplough.php">CROP PLOUGH</a></li>
				<li><a href="cropfertilizer.php">CROP FERTILIZER</a></li>
				<li><a href="croppesticide.php">CROP PESTICIDE</a></li>
                <li><a href="procedure.php">Procedure Call</a></li>
			</ul>
		</div>
		<div class="col-md-10" style="padding:20px 20px; border-left: 1px solid #ccc;">
			<div class="col-md-12">
				<p> PESTICIDE PROCEDURE CALL
					
				</p>
				<div class="table-responsive">
				<?php 
                    define('DB_HOST','localhost');
                    define('DB_USER','root');
                    define('DB_PASS','');
                    define('DB_NAME','agriculture');
                    try{
                    $dbh=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER,DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                    }
                    catch(PDOException $e){
                        exit("Error: ". $e->getMessage());
                    }
                    
                    $sqlpro="CALL Get_details()";
                    $q=$dbh->prepare($sqlpro);
                    $q->setFetchMode(PDO::FETCH_ASSOC);
                    $q->execute();
                    while($val=$q->fetch()){
                        print "<pre>";
                        print_r($val);
                    }
                    
                    ?>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			//TODO Update User Status
			$('#addpesticides').click(function(){
				var name = $("#pestname").val();
				var disease = $("#disease").val();
				$.ajax({
					type : 'POST',
					url  : 'operation.php',
					data : {'functionname':'addpest', 'name': name, 'disease': disease},
				}).done(function(data) {
					if(data == 1){
						//TODO Alert here to show success message
						window.location.href = 'pesticide.php';
					}
				}).fail(function(error) {
					console.log(error);
				});
				return false;
			});

			$('.deletebtn').click(function(){
				var id = $(this).data("id");
				var table = $(this).data("table");
				var column = $(this).data("column");
				$.ajax({
					type : 'POST',
					url  : 'operation.php',
					data : {'functionname':'delete', 'id': id, 'table': table, 'column': column},
				}).done(function(data) {
					if(data == 1){
						//TODO Alert here to show success message
						window.location.href = 'pesticide.php';
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
