   <!-- PAGE 4 -->
<html>
<head>
   <title>Result</title>
   <hr>
   <center>WELCOME TO RESULT</center>
   <hr>
   <?php $con=mysqli_connect('localhost','root','','election') or die('Result cant SEE');?>
</head>
<style>
#tot{
   height: 50px;
   width: 250px;
   float: right;
   position: relative;
   text-align: center;
   color: blue;
   border: 10px solid darkblue;
   font-size: 30px;
   text-shadow:7px 2px 2px  cyan ;
}
#FinR{
  background-color: black;
  color: white;
}
</style>

<body>
  <div id="tot">
    <?php
    $con=mysqli_connect('localhost','root','','election') or die('Result cant SEE');
    $t1=mysqli_query($con,"SELECT COUNT(poll) from vote");
    $t2=mysqli_fetch_row($t1);
    $t=$t2[0];               //Total Poll
    echo "TOTAL :<b>$t</b>"; 
    ?>
  </div>
<?php
  
  
if($_SERVER['REQUEST_METHOD'] != 'POST')
 echo "<form action='/res.php'  method='post'>
        <label>Choose :</label>
  <select name=poll>
  <optgroup label='POLL'>
    <option value='Red'>Red</option>
    <option value='Orange'>Orange</option>
    <option value='Green'>Green</option>
    <option value='Blue'>Blue</option>
    <option value='Silver'>Silver</option>
    <option value='Brown'>Brown</option>
    <option value='Lime'>Lime</option>
    <option value='Maroon'>Maroon</option>
    <option value='Indigo'>Indigo</option>
    <option value='Gray'>Gray</option>
  </optgroup>
  <optgroup label='NOTA'><option value='Nota'>Nota</option></optgroup>
  </select>
  <input type='submit' value='GO'>
</form> "; 
?>
</body>
  
<?php  //select COUNT(poll) from vote where poll='Green';
  
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
   $pol=$_POST['poll'];
   echo "<br><center><h3>$pol</h3></center>";
   $p1=mysqli_query($con,"select COUNT(poll) from vote where poll='$pol' ");
   $p2=mysqli_fetch_row($p1);
   echo "</br></br><div id='tot'>$pol :$p2[0]</div>";
  }

  //FINAL_RESULT
  $Final_RES=mysqli_query($con,"SELECT MAX(poll) from vote");
  $Final_RES=mysqli_fetch_row($Final_RES);
  echo "Final Result : ",$Final_RES[0];
  
?>


</html>