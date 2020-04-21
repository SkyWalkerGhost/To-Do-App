<?php 

	require_once ('config.php'); // ბაზასთან დაკავშირება
		
	$id = (int)$_GET['id'];
	
	class Delete_Group {

	public $id;
	public $PDO;
		
	public function __construct($id, $PDO) {
		
			$this->deleteID = $id;
			$this->pdo = $PDO;
		}
		
	public function Delete() {
			$sql = 'DELETE FROM `todo` WHERE id = :id';
	    	$statement = $this->pdo->prepare($sql);

			if ($statement->execute([':id' => $this->deleteID])) {

				$msg = ' To Do Delete ';

				header("refresh:0; index.php");

				return $msg;
			}
		}
	}
	
	$delete = new Delete_Group($id,$PDO);
	$deletemsg =  $delete->Delete();
?>


		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<div class="alert alert-success"  style="text-align: center; font-family: cursive;">
			<?php if(isset($deletemsg)) { ?>
				<?php echo $deletemsg; ?>
			<?php } ?>
		</div>

