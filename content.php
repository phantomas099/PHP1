<?php
	
	require_once 'dbconfig.php';

	


	if(isset($_POST['btnsave']))
	{
		$en = $_POST['en'];
		$ge = $_POST['ge'];

		
		
		
		if(!isset($errMSG))
		{

			$stmt = $DB_con->prepare('INSERT INTO translate(en, ge) 
			VALUES(:en, :ge)');
			$stmt->bindParam(':en',$en);
			$stmt->bindParam(':ge',$ge);


			
			if($stmt->execute())
			{
				$successMSG = "სიტყვა წარმატებით დაემატა...";
				header("refresh:2; /index.php");
			}
			else
			{
				$errMSG = "დაფიქსირდა შეცდომა სიტყვის დამატებისას...";
			}
		}
	}


	if(isset($_GET['delete_id']))
	{

		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM translate WHERE id =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: /index.php");
	}

?>

<!DOCTYPE html>
<html>
<head> 
<title> LUKA - სიტყვის დამატება </title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include ('template/css.php'); ?>
</head>


<body>



<div class="container" style="margin-top: 20px;">

		<a style="padding: 10px; display: block; margin: 20px;margin-left:0px;    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}" href="/?do=tests">ტესტები</a>


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


<form id="form1" method="post" enctype="multipart/form-data">


		<div class="form-group">
        <input minlength="2" minlength="50" type="text"required autocomplete="off" name="en" class="form-control" id="en" placeholder="English">
        </div>

		<div class="form-group">
        <input minlength="2" minlength="50" type="text"required autocomplete="off" name="ge" class="form-control" id="ge" placeholder="ქართული">
        </div>



             
		   <div class="form-group">
			<button class="btn btn-success" type="submit" name="btnsave" id="submit" value="დამატება"/>დამატება</button> 
             </div>                  

         </form> 





<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">English</th>
      <th scope="col">ქართული</th>
      <th scope="col">წაშლა</th>
    </tr>
  </thead>
  <tbody>

  <?php
	$stmt2 = $DB_con->prepare('SELECT * FROM translate ORDER BY id ASC');
	$stmt2->execute();
	if($stmt2->rowCount() > 0)
		{
		    while($lex=$stmt2->fetch(PDO::FETCH_ASSOC))
		{
		extract($lex);
	?>
    <tr>
      <th scope="row"><?php echo $lex['id']; ?></th>
      <td><?php echo $lex['en']; ?></td>
      <td><?php echo $lex['ge']; ?></td>
      <td><a href="?delete_id=<?php echo $lex['id']; ?>">წაშლა</td>
    </tr>

	<?php
            }
        }
	?>



  </tbody>
</table>


</div><!-- end container -->

<?php include ('template/javascript.php'); ?>
</body>
</html>                        
