<?php
session_start();
?>
<?php
require 'config.php';
if(!empty($_SESSION['name'])){

    $right_answer=0;
    $wrong_answer=0;
    $unanswered=0;

   $keys=array_keys($_POST);
   $order=join(",",$keys);


   //checks the question table to see if the questions were right
   $response=mysqli_query($con, "select id,answer from questions where id IN($order) ORDER BY FIELD(id,$order)")   or die(mysqli_error($con));

   while($result=mysqli_fetch_array($response, MYSQLI_ASSOC)){
       if($result['answer']==$_POST[$result['id']]){
               $right_answer++;
           }else if($_POST[$result['id']]==5){
               $unanswered++;
           }
           else{
               $wrong_answer++;
           }
   }
   //Updates the score for each user in the database
   $name=$_SESSION['name'];
   mysqli_query($con, "update users set score='$right_answer' where user_name='$name'");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Testa Uzdevums</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/style.css" rel="stylesheet" media="screen">

    </head>
    <body>
        <header>
            <p class="text-center">
                Sveiki <?php
                if(!empty($_SESSION['name'])){
                    echo $_SESSION['name'];
                }?>
            </p>
        </header>
        <div class="container result">

           <div class="row">
                  <div class="col-xs-6 col-sm-3 col-lg-3">
                     <a href="<?php echo 'index.php';?>" class='btn btn-success'>Sākt Jaunu</a>
                     <a href="<?php echo 'logout.php';?>" class='btn btn-success'>Logout</a>

                       <div style="margin-top: 30%">
                        <p>Total no. of right answers : <span class="answer"><?php echo $right_answer;?></span></p>
                        <p>Total no. of wrong answers : <span class="answer"><?php echo $wrong_answer;?></span></p>
                        <p>Total no. of Unanswered Questions : <span class="answer"><?php echo $unanswered;?></span></p>
                       </div>
                   </div>
            </div>
            <div class="row">

            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/jquery.validate.min.js"></script>

    </body>
</html>
<?php }else{

 header('Location: ./index.php');

}?>
