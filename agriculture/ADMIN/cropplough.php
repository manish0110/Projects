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
			</ul>
		</div>
		<div class="col-md-10" style="padding:20px 20px; border-left: 1px solid #ccc;">
			<div class="col-md-12">
				<p> CROP PLOUGH
					<button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addcrop">
						<span class="glyphicon glyphicon-plus"></span> ADD
					</button>
				</p>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Crop</th>
								<th>Plough</th>
								<th>Tool</th>
								<th>Action</th>
							</tr>
						</thead>
						</tbody>
						<?php
							$query = "SELECT * from crop, plough, crop_plough WHERE crop_plough.crop_id=crop.crop_id and crop_plough.plough_id=plough.plough_id";
							$result = mysqli_query($conn, $query);
							$count = $result->num_rows;
							if ($count > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()){
								?>
								<tr>
									<td><?php echo $row["id"]?></td>
									<td><?php echo $row["name"]?></td>
									<td><?php echo $row["plough_name"]?></td>
									<td><?php echo $row["tool_name"]?></td>
									<td>
										<a href="javascript:void(0);" class="deletebtn" data-column="id" data-table="crop_plough" data-id="<?php echo $row["id"]?>">
											<span class="glyphicon glyphicon-trash text-danger"></span>
										</a>
									</td>
								</tr>
								<?php
								}
							} else {
								echo "<tr><td colspan='3'> No result found</td></tr>";
							}
							//$conn->close();
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="addcrop" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Crop Plough</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label col-lg-2">Crop</label>
	                    <div class="col-lg-10">
	                    	<select name="crop" id="crop" class="form-control" >
	                    		<option value="">--------Select Crop--------</option>
		                        <?php
		                        $query = "SELECT * from crop";
								$result = mysqli_query($conn, $query);
								// output data of each row
								while($row = $result->fetch_assoc()){ ?>
		                        <option value="<?php echo $row['crop_id'];?>" data-catId="<?php echo $row['crop_id'];?>"><?php echo $row["name"];?></option>
								<?php }?>
		                    </select>
	                    </div>
	                    <label class="control-label col-lg-2">Plough & Tool</label>
	                    <div class="col-lg-10">
	                    	<select name="plough" id="plough" class="form-control" >
	                    		<option value="">--------Select Plough & Tool--------</option>
		                        <?php
		                        $query = "SELECT * from plough";
								$result = mysqli_query($conn, $query);
								// output data of each row
								while($row = $result->fetch_assoc()){ ?>
		                        <option value="<?php echo $row['plough_id'];?>" data-catId="<?php echo $row['plough_id'];?>"><?php echo $row["plough_name"];?> & <?php echo $row["tool_name"];?></option>
								<?php }?>
		                    </select>
	                    </div>
	                </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" id="addcrops">Add</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			//TODO Update User Status
			$('#addcrops').click(function(){
				var val1 = $("#crop").val();
				var val2 = $("#plough").val();
				$.ajax({
					type : 'POST',
					url  : 'operation.php',
					data : {'functionname':'add_combo', 'id1':'crop_id', 'id2':'plough_id', 'val1':val1, 'val2':val2, 'table':'crop_plough'},
				}).done(function(data) {
					if(data == 1){
						//TODO Alert here to show success message
						window.location.href = 'cropplough.php';
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
						window.location.href = 'cropplough.php';
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
