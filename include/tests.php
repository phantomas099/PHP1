<?php
	
	require_once 'dbconfig.php';

		$stmt1 = $DB_con->prepare('SELECT * FROM translate WHERE id = 1');

	    $stmt1->execute();
		$test=$stmt1->fetch(PDO::FETCH_ASSOC);

		if(isset($_POST['btnsave']))
	{
		$answer1 = $_POST['answer1'];
		$answer2 = $_POST['answer2'];
		$true = $test['en'];

		
		
		
		if(!isset($errMSG))
		{

			if($answer2 == $true )
			{

				$successMSG = "პასუხი სწორია";
						
			}
	
			else
			{
				$errMSG = "პასუხი არასწორია";
			}

			
		
		}
	}

?>

<!DOCTYPE html>
<html>
<head> 
<title> LUKA - ტესტები</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include ('template/css.php'); ?>
</head>


<body>



<div class="container" style="margin-top: 20px;">



  <?php
	$stmt2 = $DB_con->prepare('SELECT * FROM translate ORDER BY RAND() LIMIT 5');
	$stmt2->execute();
	if($stmt2->rowCount() > 0)
		{
		    while($lex=$stmt2->fetch(PDO::FETCH_ASSOC))
		{
		extract($lex);
	?>

	<style>
		.lex {overflow: hidden; margin: 10px; padding: 10px;background:#6495ED;border-radius:5px;color:#fff;width: 100%;}
		h2 {overflow: hidden; width: 100%;color:#6495ED;margin:10px;padding:10px 0px 10px 0px;margin-top: 50px;border-bottom: 1px dashed #000;text-align: center;}
	</style>
   
     
     <div class="lex">
      <?php echo $lex['en']; ?>
	</div>

	<?php
            }
        }
	?>

<h2>ტესტები</h2>


	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?> 

	<style>
		.test {overflow:hidden;background: #fff;border: 1px solid #6495ED;margin: 10px;padding: 10px;width: 100%;}
		.test h3 { padding:0px; margin:0px 0px 15px 0px; }
	</style>

     <div class="test">
      <h3>რას ნიშნავს <?php echo $test['en']; ?> ?</h3>
	

<form id="form1" method="post" enctype="multipart/form-data">


		<div class="form-group">
        <input type="radio" name="answer1" value="dog" id="answer1">
        ძაღლი
        </div>

		<div class="form-group">
        <input type="radio" name="answer2" value="cat" id="answer2">
		კატა
        </div>



             
		   <div class="form-group">
			<button class="btn btn-success" type="submit" name="btnsave" id="submit" value="პასუხი"/>პასუხი</button> 
             </div>                  

         </form> 

</div><!-- end test -->

</div><!-- end container -->

<?php include ('template/javascript.php'); ?>
</body>
</html>                        
