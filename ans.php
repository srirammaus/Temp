
<?
include 'disply.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Your Answers</h2>
  
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Question ID</th>
        <th>Answer</th>
        <th>Calculation</th>
       
      </tr>
    </thead>
    <tbody>
      <?php
        $con = mysqli_connect('localhost','root','','exam');
        $getResults = mysqli_query($con,"SELECT * FROM answer as a join questions as q WHERE a.question_id=q.question_id");
        $j=array();
        while ($row = mysqli_fetch_array($getResults)) {
          $q_id=$row['question_id'];
          $resAnswer = $row['answer'];
          $answer = $row['Fanswer'];
      ?>
      <tr>
        <td><?php echo $q_id?></td>
        
        <td>
          
         <?php 

              if ($resAnswer!=$answer) {
                
                echo "<p class='text-danger'>$resAnswer</td>";
                $flag=-1;
              }
              
              else{
                
                echo "<p class='text-success'>$resAnswer</td>";
                $flag=1;

              }

         ?> 

        </td>
        <td><?php 
              
              if($flag==1)
              {
                array_push($j,1);
                echo "correct";
              }
              elseif ($flag==-1) 
              {
                echo "wrong";
              }
              
              
                ?>
        </td>        
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
  <table class="table table-bordered">
    <td>
      <?php 
        $cop=array_sum($j);
        echo  "<br> $cop-Out of Total marks </br>" ;
        #$getc=mysqli_query($con,"SELECT count(*) as fan from answer") ;
        #$data=mysqli_fetch_assoc($getc);
        #if($data == $resAnswer){
        #$c=print_r($data);
        #$getcr=mysqli_query($con,"SELECT count(Fanswer) as fa from questions") ;
        #$dat=mysqli_fetch_assoc($getcr);
        #$cr=print_r($dat);
        #echo gettype($answer);
        #if($c==$cr){
          #echo "$c / $cr \n";

        #}else{
         # echo "No";
        #}
        
        #echo $c
        #for($x=1;$x<=4;$x++){
        
        #$x=1;
        #$x<=4;
        #$x++;/*
        /*for($x=1;$x<5;$x++){
          $query= mysqli_query($con,"SELECT * FROM answer WHERE question_id =$x");
          if(mysqli_num_rows($query)==1){
            $ris=mysqli_fetch_assoc($query);
            $ans=$ris['answer'];
          }  
          $querry= mysqli_query($con,"SELECT * FROM questions WHERE question_id =$x");
          if(mysqli_num_rows($querry)==1){
            $ri=mysqli_fetch_assoc($querry);
            $i=0;
            if($ri['Fanswer']==$ans){
              
              $count=0;
              $zip=0;
              $zip+=1;
              #$zip+1;
              
              echo "<br>$zip </br>" ;
              ++$i;
              #$count<100000000;
              #$counter=count($count)+1;
              #$cc=settype($counter,"string");
              #echo ("<br>$counter / 4 -Total marks you have scored </br>");
            }else{
              echo "<br> Wrong <br>";
            }echo "<br>$j</br>";
          
          }else{
            echo "";
          }
        }
        
        #$query= mysqli_query($con,"SELECT * FROM answer WHERE question_id='1' ;");
        #if($querry ==$query){
         # echo "1";

        #}else{
         # echo "0";
        #}
        */
        ?>        
    </td>

  </table>
</div>

</body>
</html>
