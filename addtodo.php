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




	class ToDoApp {

		// todo name
		public $todoName;
		public $table; // this is to do table 

		// message
		public $message;
		public $success_message;

		//db conect
		private $PDO;


		public function __construct($PDO) {

			$this->db_connect 	= $PDO;
		}


		public function CheckToDo() {

			if($_SERVER['REQUEST_METHOD'] === 'POST' ) {

				if(isset($_POST['todoName'])) {

						$this->todoName = trim(strip_tags(htmlentities(filter_var($_POST['todoName'],FILTER_SANITIZE_STRIPPED))));

					if(empty($this->todoName)) {

							$this->message = " შეყვანეთ სახელი ";

						return $this->message;
					}


					if(mb_strlen($this->todoName) > 150 ) {

							$this->message = " სიმბოლოების რაოდენობა აჭარბებს დაშვებულ სიმბოლოთა რაოდენობას [150] ";

						return $this->message;
					}
				}
			}
		}


		public function createToDo() {

			try {

				if(mb_strlen($this->todoName) !=0 && mb_strlen($this->todoName) < 150) {


					$sql = "INSERT INTO `todo`(`todoName`) VALUES (:todoName)";
					$stmt = $this->db_connect->prepare($sql);

					$stmt->bindParam(":todoName", $this->todoName, PDO::PARAM_STR);

				if($stmt->execute()) {

					$this->success_message = " New To Do Successfully Added ";
						header("refresh: 1; index.php");

				} else {

					$this->message = " Failed to load ";

				}

			}

			} catch(PDOException $e) {
                    die(" Connection Failed : " . $e->getMessage() . '<br> <b> in File: </b>' . $e->getFile() . ' <br> <b> in Line: </b> ' . $e->getLine());
                    return false;
            }
		}


		public function getToDo() {

			$sql = "SELECT * FROM `todo` ORDER BY `id` DESC LIMIT 50 ";
			$stmt = $this->db_connect->query($sql);
			$rows = $stmt -> rowCount();

			if($rows > 0 ) {

				while($todo_rows = $stmt -> fetch(PDO::FETCH_BOTH)) :

						$todoArr[] = $todo_rows;

				endwhile;

				return $todoArr;

			} else {

					$this->count_message = " ჩანაწერები არ არის ";

				return $this->count_message;
			}
		}



	}


?>