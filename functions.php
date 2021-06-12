<?php


		$con=mysqli_connect('localhost','root','','exam') or die("connection failed");

			function connect(){

			$con=mysqli_connect('localhost','root','','exam')or die("connection failed");


			return $con;
		}

		function getData($id){

			$con=connect();

			$query = "SELECT * FROM questions";

			if ($id!='') {
				
				$query.=" WHERE question_id=$id ";
			}

			$runQuery = mysqli_query($con,$query);

			$get = array();
			while($gtData = mysqli_fetch_assoc($runQuery)){

				$get[] = $gtData;
			}

					return $get;
		}

		
?>