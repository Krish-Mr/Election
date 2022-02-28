<html>
  <style>
    #content{
      width: 95%;
      height: 490px;
      background-size:cover;
      background-image:url(https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Flinuxize.com%2Fseries%2Fsetting-up-and-configuring-a-mail-server%2Ffeatured_hu944fda121bec180175cc0781d7259c92_24284_768x0_resize_q75_lanczos.jpg&f=1&nofb=1);
      opacity: 0.7;
      position: relative;
      z-index: 1;
      text-align: center;
      display: block;
    }
    #form{
      width: 400px;
      height: 250px;
      text-align: center;
      padding: 30px 5px;
      opacity:0.9;
      position: absolute;
    /*  z-index: 1;*/
    }
   h3{
      text-decoration:overline darkred wavy ;
      text-align: center;
    }
  </style>

  <body>
    <div id="content">
        <h1>Mail Form</h1>
        <div id="form">
        <form enctype="multipart/form-data" method="POST" action="p_h_p.php"> <!-- action="/m@4l.php -->"
          <label>Your Name <input type="text" name="sender_name" /> </label><br><br>
          <label>To Email <input type="email" name="sender_email" /> </label><br><br>
          <label>Subject <input type="text" name="subject" /> </label><br><br>
          <label>Message <textarea name="message"></textarea> </label><br><br>
          <label>Attachment <input type="file" name="my_file" /></label><br><br>
          <label><input type="submit" name="button"  value="Submit" /></label><br>
        </form>
        </div>
        
          <h3>SEND FOR Authendication</h3>

  </div>
  </body>
</html>



 
    <?php

    if($_SERVER['REQUEST_METHOD']=="POST"){
    }
      $to_email = $_POST['sender_email'];
      $subject = $_POST['subject'];
      $name = $_POST['sender_name'];
      // $headers = "From: gokulkrishnan10455@gmail.com";
      $headers = implode("\r\n", [
        "From: gokulkrishnan10455@gmail.com", 
        "MIME-Version: 1.0",
        "Content-type: text/html; charset=utf-8"
      ]);

      $tmp_name = $_FILES['my_file']['tmp_name']; // get the temporary file name of the file on the server
      $fname    = $_FILES['my_file']['name']; // get the name of the file
      $size    = $_FILES['my_file']['size']; // get size of the file for size validation
      $type    = $_FILES['my_file']['type']; // get type of the file
      $error   = $_FILES['my_file']['error']; // get the error (if any)
        //attachment
    $body ="Content-Type: $type; type=".$type."\r\n";
    $body .="Content-Disposition: attachment; filename=".$fname."\r\n";

    $body .= "Hi,This is test email send by <h2>".$name."</h2>\r\n";
    $body .="<a href='http://localhost:81/Election/home.html'>click</a><br><br><hr>\r\n";


if (mail($to_email, $subject, $body, $headers)) {
  echo "<center>Mail Sended...</center>";
    // echo "Email successfully <h5>sent</h5> to $to_email...<br>";
    // echo "File Name: ".$fname."\n<br>";
    // echo "File Type: ".$type."\n<br>";
    // echo "File location: ".$tmp_name."\n<br>";
    // echo "File Size: ".$size."\n<br>";
    // echo "Error: ".$error."\n<br>";
} else {
    echo "Email sending failed...         <h6>-WRONG-</h6>";
}
?>
