<?php 

	
	ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
    ini_set ('log_errors', 0);
    ini_set ('display_startup_errors', 0);
    ini_set ('error_reporting', E_ALL);
    // Report simple running errors
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    // Report all errors except E_NOTICE
    error_reporting(E_ALL & ~E_NOTICE);


	require_once "config.php";

	$Connect = new Database_Connection();
    $PDO = $Connect->getConnect();

	require_once "addtodo.php"; 

	$todoApp = new ToDoApp($PDO);
	$todoApp->CheckToDo();
	$todoApp->createToDo();
	$query = $todoApp->getToDo();

	
?>

<!DOCTYPE html>
<html>
<head>
	<title> To Do App </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<style type="text/css">
		
		
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        	font-family: cursive;
        }

        :-ms-input-placeholder { /* Internet Explorer 10-11 */
        }

        ::-ms-input-placeholder { /* Microsoft Edge */
        }

	</style>

</head>
<body>

		<div class="container" style="font-family: cursive;">


				<div class="alert alert-info text-center" role="alert">
  					To Do APP PHP and SQL
				</div>

				<?php if($todoApp->message) : ?>
					<div class="alert alert-danger text-center" role="alert" >
  						<i class="fa fa-warning"></i> <?=$todoApp->message;?>
					</div>
				<?php endif;?>	


				<?php if($todoApp->success_message) : ?>
					<div class="alert alert-success text-center" role="alert" >
  						<i class="fa fa-check"></i> <?=$todoApp->success_message;?>
					</div>
				<?php endif;?>


				<?=$todoApp->count_message;?>

					<form action="#" method="POST">
					  <div class="row">

					    <div class="col-md-10">
					      <input type="text" name="todoName" class="form-control" placeholder="შეიყვანეთ სახელი">
					    </div>

					    <div class="col-md-2 mb-3">
					      	<button type="submit" class="btn btn-warning"> დამატება </button>
					    </div>

					  </div>
					</form>

				<table class="table table-dark" >

				  <thead>

				    <tr>
				      <th scope="col"> N </th>
				      <th scope="col"> სახელი </th>
				      <th scope="col"> წაშლა </th>
				    </tr>

				  </thead>

				  <tbody>

				<?php foreach($query as $todo) : ?>
				    <tr>
				      <th scope="row"> <?=$todo['id'];?> </th>

			      	<?php if(mb_strlen($todo['todoName']) > 150 ) : ?>
				      	<td> <span style=""> <?=mb_substr($todo['todoName'],0,30).'...';?> </span> </td>
				    <?php else : ?>
				      		<td> <span style=""> <?=$todo['todoName'];?> </span> </td>
				    <?php endif;?>

				      <td> <a href="delete.php?action=delete-to-do&id=<?=$todo['id'];?>" style="color: red;"> X </a> </td>
				    </tr>
				<?php endforeach;?>
			
				  </tbody>

				</table>



		</div>

</body>
</html>