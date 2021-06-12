<?php
error_reporting(0);
$con = mysqli_connect('localhost','root','','exam') or die("connection failed");
require('functions.php');
$option;
$msg = '';
function op(){
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$value = "";
		$name = $_POST['option'];

		// optional
		// echo "You chose the following color(s): <br>";
		$result="";
		foreach ($name as $value){
		//echo $value.", ";
			$result .= $value;

		}
		echo $result;
		//print "<script>alert('".$value."')</script>";
	

	}
}
if ($_GET['id']==5) {
	header('location:ans.php');
	die(); 
}

	


if (isset($_POST['submit'])) {
	global $radio;
	$radio = $_POST['option'];
	$fid = $_POST['current_val'];
	if (empty($_POST['option'])) {
		$msg = 'Please Select One Answer';
		header('Location:disply.php');
	}else{
		
		$inertAns = mysqli_query($con,"INSERT INTO `answer`(`question_id`, `answer`) VALUES ('$fid','".$_POST['option']."')");
		$fid = $_POST['current_val']+1;
		$url="disply.php?id=".$fid;
		header('Location:./'.$url);
		

	}
	
}

if(isset($_GET['id'])){
	 $curentQuestionNumber=$_GET['id'];
}else{

		 $curentQuestionNumber=1;
}
// echo "current qestion ".$curentQuestionNumber;
?>



<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
	
	<script type="text/javascript">
		//var timeRemain = 2*60;
		var currentQuestionNumber=<?php echo $curentQuestionNumber; ?>;
	</script>
	<center>
	<div style="margin-top: 50px;" id="timeOutt">
		
	</div>
	</center>
	<div class="container" style="margin-top: 200px">

		<div class="row">
		<div class="col-md-8" style="border:1px solid black">


			<?php
			$con  =mysqli_connect('localhost','root','','exam');
					
				
					if (empty($_GET['id'])) {
						$id = '1';
					}
					else{
						$id = $_GET['id'];
					}

					$getQuestion = getData($id);
					foreach($getQuestion as $question){

			?>
			<form method="post" action="disply.php" id="form">
				<label>Sr No.</labe><label><?php echo $question['question']?></label><br>
				<input type="radio" name="option" value="<?php echo $question['option_one']?>"> <?php echo $question['option_one']?> <br>
			
				<input type="radio" name="option" value="<?php echo $question['option_two']?>"> <?php echo $question['option_two']?><br>
				<input type="radio" name="option" value="<?php echo $question['option_three']?>"> <?php echo $question['option_three']?><br>
				<input type="radio" name="option" value="<?php echo $question['opton_four']?>"> <?php echo $question['opton_four']?><br>
				<input type="hidden" value="<?php echo empty($_GET['id'])?'1':$_GET['id']; ?>" name="current_val" > 
				<button type="submit" name="submit" onclick="timeOut()">Next Question</button>
				<?php
					if($id==4){
						
					?>
					<div id= header>
						<style type='text/css'>
						#header {
						height: 48px;
						width: 588px;
						margin: 2em auto;   
						}
						#btnhome:active{
							top : 25px;
							position: relative;
						}
						</style>
						<button class="btn btn-primary"  name="submit" >submit</button>
						
						</div>
					<?php

						}?>

			</form>
				<p class="text text-danger"><?php echo $msg?></p>
			<?php
					}	
			?>

		</div>
		<div>
			<div class="col-md-4" style=" height: 155px;">
				<center>
				<button><a href="?id=1">1</a></button>&nbsp;&nbsp;&nbsp;
				<button><a href="?id=2">2</a></button>&nbsp;&nbsp;&nbsp;
				<button><a href="?id=3">3</a></button>&nbsp;&nbsp;&nbsp;
				<button><a href="?id=4">4</a></button>&nbsp;&nbsp;&nbsp;
				<t></t>
				</center>
			</div>
			
		</div>
		</div>
	</div>

	
<script type="text/javascript">
	var timeRemain=600;
	function timeOut(){
		var min = Math.floor(timeRemain/60);
		var sec = timeRemain%60;

		if (timeRemain<=0) {
			clearTimeout(To);
			switch(currentQuestionNumber){
				
				case 4 :
							window.location.href='ans.php';
							break;
				default : 
							window.location.href='disply.php?id='+(currentQuestionNumber+1);
							break;
			}

			
		}
		else{
			document.getElementById("timeOutt").innerHTML=min+":"+sec;
		}
		<?php if(empty($_GET['id']) || $_GET['id']==1){?>
		timeRemain--;<?php 
		}?>
	}
	var To = setInterval(function(){timeOut()},1000);

</script>
</body>
</html>