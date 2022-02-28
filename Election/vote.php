<!-- PAGE 3 -->
<html>

 <style> 
   table{
  	padding:30px;
   	height:10%;
   	width: 100%;
   }

   div{

   	border:3px inset chocolate;
    text-align: center;
    line-height:80px;
    lighting-color:yellow;

   }
   td{
   	height:20%;
   }

 </style>
 
 <head>
  <title>VOTE</title>
  <?php 
   $con=mysqli_connect("localhost","root","","election") or die("vote Closed");
   session_start();
   echo "<h4>Your Identity : ".$_SESSION['aadno']."</h4>";    
   $aadno=$_SESSION['aadno'];
  ?>
 	<center><h1>VOTE</h1></center>
 </head>
  <body>
  	<form method="POST" action="vote.php" > 
  		<table>
  		  <tr>
  		  	 <td><div> <input type="radio"  id="red"     name="vote" value="Red">Red</div></br></td>
  		  	 <td><div> <input type="radio"  id="orange"  name="vote" value="Orange">Orange</div></br></td>
  		  	 <td><div> <input type="radio"  id="green"   name="vote" value="Green">Green</div></br></td>
  		  	 <td><div> <input type="radio"  id="blue"    name="vote" value="Blue">Blue</div></br></td>
  		  	 <td><div> <input type="radio"  id="silver"  name="vote" value="Silver">Silver</div></br></td> 
  		  </tr>	

  		  <tr>
  		  	<td> <div><input type="radio" id="brown"  name="vote" value="Brown">Brown</div></br></td>
  		  	<td> <div><input type="radio" id="lime"   name="vote" value="Lime">Lime</div></br></td>
  		  	<td> <div><input type="radio" id="maroon" name="vote" value="Maroon">Maroon</div></br></td>
  		  	<td> <div><input type="radio" id="indigo" name="vote" value="Indigo">Indigo</div></br></td>
  		  	<td> <div><input type="radio" id="gray"   name="vote" value="Gray">Gray</div></br></td>
  		  </tr>
  		 
  		</table>
        <?php

        if($_SERVER['REQUEST_METHOD'] != 'POST'){
          echo "<h3></h3>";
            $x1=mysqli_query($con,"select sno from vote order by sno DESC");
            $x2=mysqli_fetch_array($x1);
            $x=$x2['sno'];                               //SHOW LAST SNO
            //echo "no  :".$x;    //total no in the DB
            // if($x != "")
            // {     
            //   echo "<br>-------------------------------------------------------------------";
            //   $q1=mysqli_query($con,"SELECT aano from vote where aano='$aadno'");
            //   $q2=mysqli_fetch_row($q1);
            //   if ($q2['aano'] =='\0') 
            //    echo $_SERVER['QUERY_STRING'];
            //   mysqli_query($con,"insert into election.vote(sno,aano) values($x+1,'$aadno')");
            //   echo "<br>Alredy in DB<br>";
            //  }     
            // else
            //   mysqli_query($con,"insert into election.vote(sno,aano) values(1,'$aadno')");  //its is the 1st DATA
           
          



           if($x == "")                                  //its is the 1st DATA
             mysqli_query($con,"insert into election.vote(sno,aano) values(1,'$aadno')");
           else{
            if(mysqli_query($con,"SELECT aano from vote where aano='\0'"))
              mysqli_query($con,"insert into election.vote(sno,aano) values($x+1,'$aadno')");
            else
             echo "<br>Alredy in DB<br>"; }
         
        
          if(mysqli_query($con,"SELECT aano from vote where aano='$aadno'")) // alredy eited but not vote
          {
          
            $n1=mysqli_query($con,"SELECT sno from vote where aano='$aadno' ") ;
            $n2=mysqli_fetch_row($n1) or die(mysqli_error($con));
            $n=$n2[0];
           // echo "<br>its a aadno ---> sno :".$n." | aadno : ".$aadno;
            $GLOBALS['n'] = $n;
          }
        }
       ?>
  	    <center><input type="submit" value="Submit"></center>

  	</form>
  </body>
  

</html>
<?php
//if()      check sno == aadno in DB 

 // $max=mysqli_query($con,"select MAX(sno) from vote") or die(mysqli_error($con));
 // $max1=mysqli_fetch_row($max);
 // $sno=$max1[0];


                  //check poll is empty or not to the coresspondent aadno
   $p1=mysqli_query($con,"SELECT poll FROM vote WHERE aano='$aadno' ");
   $p2=mysqli_fetch_row($p1);
   $P=$p2['0'];
   echo "you're vote to \"".$P."\""; 
   if(!$P){
     echo "<h4>REDY TO VOTE</h4>";
                    //POST
     $no1=mysqli_query($con,"SELECT sno from vote where aano='$aadno'");
     $no2=mysqli_fetch_row($no1);
     $no=$no2[0];
     echo "<br>".$no."<br>";
     if($_SERVER['REQUEST_METHOD']=='POST' or die("Give me Your Votes...")) 
     { 
      echo "<br><h3>POST...</h3>";
      $name1=$_POST['vote'] or die("<h3>Your are Not Voting</h3>");
      echo $name1;                                                                                    
      mysqli_query($con,"update vote SET poll='$name1' where sno='$no' ");
     }
   }
   else{
     echo "<h5>You're alredy voted can't change</h5>";
     echo "</br></br>See Result :  <button onclick='res()'>Result</button>";
   }


 session_abort();

?>

<script>
  function res() {
    window.location.replace("res.php");
  }
</script>