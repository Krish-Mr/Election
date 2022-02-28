             <!-- PAGE 2 -->
<html>
<title>Validate</title>
  <style>
    #top{
      width:97%;
      height:60px;
      border:5px solid darkblue;
      position:absolute;
      background-color:lightgray; 
    }
    #center{
      color:black;
      font:bold small-caps 50px  Verdana;
      position:relative;
    
    }
    #err{
      color:#ea2528;
    }
    .suc{
      color:#45d326;
    }
  </style>
  <div id="top"></div>
  <center id="center">Welcome To Voting</center>
</html>


 <?php

   echo "</br></br>";
 //  if(isset($_POST['name']) and isset($_POST['adno']) and isset($_POST['voteid']) and isset($_POST['phno']) and isset($_POST['wardno']) and isset($_POST['area']) and isset($_POST['footno']) ) and die("haha");
/*$servername="localhost"
;T  $username="$un";
  $password="$pw";
  $db_name="$db";     */   //election .register

$con=mysqli_connect("localhost","root","","election") or die("<b><center>connection  failed :(</center></b><br>");

/*           get last id from the DB
    $res=mysqli_query($con,"select no from register order by no DESC");
    $row=mysqli_fetch_array($res);
    echo $row['no'];
*/

/*                    feetch all the Data from the DB
$sql=mysqli_query($con,"select * from election.register where name='goku' AND area='karur'") or die("<h4>query failled :</h4> <br>".mysqli_error($sql).PHP_EOL);
if($sql)
   echo "<br> QUERY exec successfully" ;
while($row=mysqli_fetch_array($sql))
  {
  echo "<br>TABLE DATA: <br>" ;
  echo  $row['no']."<br>" ;
  echo $row['name']."<br>" ;
  echo $row['adno']."<br>" ;
  echo $row['voteid']."<br>" ;
  echo $row['area']."<br>" ;
  }                */
if($con and $_SERVER['REQUEST_METHOD']=='POST'  or die("Security Policy You Are Not Allowed")){
  // echo "<br><br><hr>Server establish successfully<br>"; 
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
    $checkUserValidD=0;
   // echo "<hl>REQUEST METHODE POST :</hl><br>";
   //                 VALIDATION
   if(preg_match("/^[A-Z]{3,}|( )|[A-Z]+( )[A-Z]{1}$/",htmlspecialchars($_POST['name']))) 
     if(preg_match("/^[0-9]{4}( )[0-9]{4}( )[0-9]{4}$/",htmlspecialchars($_POST['adno']))) 
       if(preg_match("/^[A-Za-z]{3}[0-9]{7}$/",htmlspecialchars($_POST['voteid']))) 
         if(preg_match("/^[0-9]{10}$/",htmlspecialchars($_POST['phno'])))
           if(preg_match("/^[0-9]+/",htmlspecialchars($_POST['wardno']))) 
             if(htmlspecialchars($_POST['area']))
               if(preg_match("/^[0-9]{3}$/", htmlspecialchars($_POST['footno'])))
               {
                echo "<ins class='suc'>User Details are Correct</ins><br>" ;
                $name  =strtoupper($_POST['name']);
                $adno  =$_POST['adno'];
                $voteid=$_POST['voteid'];
                $phno  =$_POST['phno'];
                $wardno=$_POST['wardno'];
                $area  =$_POST['area'];
                $footno=$_POST['footno'];
                $checkUserValidD=1;
               } 
               else echo "<ins id='err'>Consituency Number Incorrect</ins>";
             else echo "<ins id='err'>Consituency Incorrect</ins>";
           else echo "<ins id='err'>Ward NO Incorrect</ins>";
         else echo "<ins id='err'>Mobile Number Incorrect</ins>";
       else echo "<ins id='err'>VoterId Incorrect</ins>"; 
     else echo "<ins id='err'>Aadar NO Incorrect</ins>";
   else echo "<ins id='err'>Name Incorrect</ins>";
   
  } 
  if($checkUserValidD){
  session_start();
  $_SESSION['aadno']=$adno;        //session created 
      
         // THIS DB----------------------------------------
   $q1=mysqli_query($con,"select no from register order by no DESC"); //find last no
   $q2=mysqli_fetch_array($q1);
   $x=$q2['no'];
  if(!mysqli_query($con,"select adno,voteid from election.register where adno=$adno AND voteid=$voteid"))
  {
     mysqli_query($con,"insert into election.register (no,name,adno,voteid,phno,wardno,area,footno) values ($x+1,'$name','$adno','$voteid',$phno,$wardno,'$area',$footno)");
     
  }
  if(mysqli_query($con,"select adno,voteid from election.register where adno='$adno' AND voteid='$voteid'"))
  {
    // echo "Goto Voting to Click vote button below </br>";
  }
  echo "<hr></hr>"; //horizontal line;
  

           //   VALIDATION OUTPUT
echo "
<html>
 <title>vote</title>
<head>
 <style>
  #user{
    color:darkred;
    font:20px;
  }
   td{
    width:7%;
    height:30px;
    font-size:20px;
    padding:4px;
    border-spacing:20px;
    padding:1px 10px;
    border:2px solid red;
    background-color:lightyellow;
    border-collapse:separate;
  } 
  th{

    color:orange;

  }
 </style>
</head>
 <body>
   <center id='user'>User Validation</center></br>
   <table style='width:88%'>
      <tr>
        <th>NAME</th>
        <th>AADHAR NO</th>
        <th>VOTE ID</th>
        <th>MOBILE NO</th>
      </tr>
      <tr>
        <td>".$name."</td>
        <td>".$adno."</td>
        <td>".$voteid."</td>
        <td>".$phno."</td>
      </tr>
         <tr>
          <th rowspan=''></th>
         </tr>
      <tr>
        <th>WARD NO</th>
        <th>CONSITUENCY</th>
        <th>CONSIT NO</th>
      </tr>
      <tr>
        <td>".$wardno."</td>
        <td>".$area."</td>
        <td>".$footno."</td>
      </tr>
   </table></br></br>
  <center> <button><a href='vote.php'>VOTE</a></button> </center>


 </body>
 <script>
  
 </script>

</html> " ; }
    



//this is PHP Scripts Build-IN
/*
 $_SERVER['PHP_SELF'] && "<br>";
$_SERVER['GATEWAY_INTERFACE'] && "<br>" ;
$_SERVER['SERVER_ADDR'] && "<br>" ;
$_SERVER['SERVER_NAME'] && "<br>"  ;
$_SERVER['SERVER_SOFTWARE'] && "<br>" ;
$_SERVER['SERVER_PROTOCOL'] && "<br>" ;
$_SERVER['REQUEST_METHOD'] && "<br>" ;
$_SERVER['REQUEST_TIME'] && "<br>" ;
$_SERVER['QUERY_STRING'] && "<br>" ; 
$_SERVER['HTTP_ACCEPT']  && "<br>" ;
$_SERVER['HTTP_ACCEPT_CHARSET']  && "<br>" ;
$_SERVER['HTTP_HOST'] && "<br>" ;
$_SERVER['HTTP_REFERER']  && "<br>" ;
$_SERVER['HTTPS'] && "<br>" ;
$_SERVER['REMOTE_ADDR'] && "<br>"  ;
$_SERVER['REMOTE_HOST'] && "<br>" ;
$_SERVER['REMOTE_PORT'] && "<br>" ;
$_SERVER['SCRIPT_FILENAME'] && "<br>" ;
$_SERVER['SERVER_ADMIN'] && "<br>" ;
$_SERVER['SERVER_PORT'] && "<br>" ;
$_SERVER['SERVER_SIGNATURE'] && "<br>" ;
$_SERVER['PATH_TRANSLATED'] && "<br>" ;
 $_SERVER['SCRIPT_NAME'] && "<br>"	;
 $_SERVER['SCRIPT_URI']	&& "<br>" ;
*/
}

 ?>