<?php 

/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/
 
//Include required PHPMailer files
require 'phpmailer/includes/PHPMailer.php';
require 'phpmailer/includes/SMTP.php';
require 'phpmailer/includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'components/connect.php';

session_start();

if(isset($_SESSION['unique_id'])){
   $unique_id = $_SESSION['unique_id'];
}else{
   $unique_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING); 

   $select_users = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
   $select_users->execute([$email]);
   $row = $select_users->fetch(PDO::FETCH_ASSOC);

   if($select_users->rowCount() > 0){
    $random_pass = create_forgot_pass();
    $email_sha1 = sha1($random_pass);
    $update_forgot_pass = $conn->prepare("UPDATE `user` SET password = ? WHERE email = ?");
    $update_forgot_pass->execute([$email_sha1, $email]);


  //Create instance of PHPMailer
	$mail = new PHPMailer();
   //Set mailer to use smtp
      $mail->isSMTP();
   //Define smtp host
      $mail->Host = "smtp.gmail.com";
   //Enable smtp authentication
      $mail->SMTPAuth = true;
   //Set smtp encryption type (ssl/tls)
      $mail->SMTPSecure = "tls";
   //Port to connect smtp
      $mail->Port = "587";
   //Set gmail username
      $mail->Username = "registerwifionline@gmail.com";
   //Set gmail password
      $mail->Password = "pnrljctfgzdpqver";
   //Email subject
      $mail->Subject = "RegisterWifi.Online | Reset Password";
   //Set sender email
      $mail->setFrom(address:'registerwifionline@gmail.com', name:'Admin RegisterWifi.Online');
   //Enable HTML
      $mail->isHTML(true);
   //Attachment
   //	$mail->addAttachment('img/attachment.png');
   //Email body
      $mail->Body = "<h3>New Password : $random_pass</h3>\n<h3>Thank you.</h3>";
   //Add recipient
      $mail->addAddress("$email");
   //Finally send email
      if ( $mail->send() ) {
        $success_msg[] = "Email Sent Successfully!";
      }else{
        $warning_msg[] = "Message could not be sent. Mailer Error ";
      }
      //Closing smtp connection
      $mail->smtpClose();
     
   }else{
    $warning_msg[] = "Email not valid!";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password | RegisterWifi.Online</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- Forgot Password section starts  -->

<section class="form-container">

   <form action="" method="post">
      <h3>Forgot Password</h3>
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <input type="submit" value="submit" name="submit" class="btn">
   </form>

</section>

<!-- Forgot Password section ends -->










<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>