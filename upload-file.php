<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Upload File</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/fontawesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
	<link rel="stylesheet" href="assets/css/solid.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel = "icon" type ="image/png" href="assets/image/1.png">

</head>
<body>
	<!-- Preloader Start
	<div class="preloader-wrapper">
		<div class="preloader">
			<img src="assets/image/1.png">
			<h2>please wait...</h2>
		</div>
	</div>
	Preloader End-->





	<!-- Box Section Start -->
	<div class="container-fluid">
		<div class="container main-wrapper">
			<div class="row">
				<div class="col-md-12 inner-div">
					<img class="main-logo"  src="assets/image/1.png" alt="">
					<p class="bubt-title"><strong>Bangladesh University of Business & Technology</strong></p>
					<div class="row menubox">

						<div class="form">
							<div class="row">
								<div class="col-md-6 col-border"><button type="button" class="btn btn-primary p-btn" onclick="location.href='profile.php'">HOME</button></div>
								<div class="col-md-6"><button type="button" class="btn btn-primary p-btn" onclick="location.href='index.php'" style="width: 150px !important;">LOGOUT</button></div>
							</div>
							<!--<form action="user_module/fileLogic.php" method="post">
								<div class="form-group">
									<input type="file" multiple name="myFile" id="uploadFile">
									<img src="assets/image/upload.png">
									<p>Drag your files here or click in this area.</p>
								</div>
                                <button class="btn btn-default asfileUpload" type="submit" name="save">Upload</button>
							</form>-->



						</div>
                        <form action="user_module/upload_file_progress.php" method="post" enctype="multipart/form-data" >
                            <h3>Upload File</h3>
                            <input type="file" name="myFile"> <br>
                            <button type="submit" name="save">upload</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>



	<!-- Box Section End -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.js"></script>
	<script src="assets/js/solid.js"></script>
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script>
		$(document).ready(function(){
			$('form input').change(function () {
				$('form p').text(this.files.length + " file(s) selected");
			});
		});
	</script>
	
</body>
</html>