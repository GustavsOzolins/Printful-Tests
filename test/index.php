<?php
session_start();
?>
<?php
require 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Testa Uzdevums</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/style.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<header>
      <div class="text-right">
              <a href="<?php echo 'logout.php';?>" class='btn btn-success'>Logout</a>
			<p class="text-center">
				Sveiki <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
			</p>
    </div>
		</header>
		<div class="container">
			<div class="row">

				<div class="col-xs-10 col-sm-5 col-lg-5">
					<div class="intro">
						<p class="text-center">
							Ievadiet Vārdu
						</p>
						<?php if(empty($_SESSION['name'])){?>
						<form class="form-signin" method="post" id='signin' name="signin" action="questions.php">
							<div class="form-group">
								<input type="text" id='name' name='name' class="form-control" placeholder="Enter your Name"/>
								<span class="help-block"></span>
							</div>
							<div class="form-group">
							    <select class="form-control" name="category" id="category">
							        <option value="">Kategorija</option>
                                  <option value="1">Sports</option>
                                  <option value="2">Matemātika</option>
                                  <option value="3">Ģeogrāfija</option>
                                  <option value="4">Informātika</option>
                                </select>
                                <span class="help-block"></span>
							</div>

							<br>
							<button class="btn btn-success btn-block" type="submit">
								Sākt
							</button>
						</form>

						<?php }else{?>
						    <form class="form-signin" method="post" id='signin' name="signin" action="questions.php">
                            <div class="form-group">
                                <select class="form-control" name="category" id="category">
                                    <option value="">Kategorija</option>
                                    <option value="1">Sports</option>
                                    <option value="2">Matemātika</option>
                                    <option value="3">Ģeogrāfija</option>
                                    <option value="4">Informātika</option>
                                </select>
                                <span class="help-block"></span>
                            </div>

                            <br>
                            <button class="btn btn-success btn-block" type="submit">
                                Sākt
                            </button>
                        </form>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/jquery.validate.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<!-- Checks to see if the name is valid. If it hasnt been used before -->
		<script>
			$(document).ready(function() {
				$("#signin").validate({
					submitHandler : function() {
					    console.log(form.valid());
						if (form.valid()) {
						    alert("sf");
							return true;
						} else {
							return false;
						}

					},
					rules : {
						name : {
							required : true,
							minlength : 3,
							remote : {
								url : "check_name.php",
								type : "post",
								data : {
									username : function() {
										return $("#name").val();
									}
								}
							}
						},
						category:{
						    required : true
						}
					},
					messages : {
						name : {
							required : "Lūdzu ievadiet vārdu",
							remote : "Šis vārds jau ir izmantots"
						},
						category:{
                            required : "Lūdzu izvēlaties kategoriju"
                        }
					},
					errorPlacement : function(error, element) {
						$(element).closest('.form-group').find('.help-block').html(error.html());
					},
					highlight : function(element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
				});
			});
		</script>

	</body>
</html>
