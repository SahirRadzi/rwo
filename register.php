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

if(isset($_GET['ref'])){
   $refer_code = $_GET['ref'];

   $sql = $conn->prepare("SELECT * FROM `user` WHERE referral_code = ?");
   $sql->execute([$refer_code]);

   if($sql->rowCount() > 0){
      $count_click = $conn->prepare("UPDATE `user` SET click = click+1 WHERE referral_code = ?");
      $count_click->execute([$refer_code]);
   }

}else{
   $refer_code = 0;
}

if(isset($_POST['submit'])){

   $uid = create_uid();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
   $c_pass = sha1($_POST['c_pass']);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

   $select_users = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
   $select_users->execute([$email]);

   if($select_users->rowCount() > 0){
      $warning_msg[] = 'email already taken!';
   }else{
      if($pass != $c_pass){
         $warning_msg[] = 'Password not matched!';
      }else{
         // if($_POST['referralcode'] != '')
         // {
         //    updateReferral();
         // }
         
         $referral_code = strtoupper(bin2hex(random_bytes(4)));
         $referral_point = 0;

         $verification_status = '0';
         $rand_otp = create_verify_code();

         $insert_user = $conn->prepare("INSERT INTO `user`(unique_id, nama, number, email, password, otp, verification_status, referral_code, refer_code) VALUES(?,?,?,?,?,?,?,?,?)");
         $insert_user->execute([$uid, $name, $number, $email, $c_pass, $rand_otp, $verification_status, $referral_code, $refer_code]);

         



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
         $mail->Subject = "RegisterWifi.Online | Verify OTP";
      //Set sender email
         $mail->setFrom(address:'registerwifionline@gmail.com', name:'Admin RegisterWifi.Online');
      //Enable HTML
         $mail->isHTML(true);
      //Attachment
      //	$mail->addAttachment('img/attachment.png');
      //Email body
         $mail->Body = "Please verify your account now.<br><br>Your OTP Number : <b>$rand_otp</b><br>Terima kasih.";
      //Add recipient
         $mail->addAddress("$email");
      //Finally send email
         if ( $mail->send() ) {
            $message[] = "Email Sent Successfully!";
         }else{
            $message[] = "Message could not be sent. Mailer Error ";
         }
         //Closing smtp connection
         $mail->smtpClose();
            
               $check_users = $conn->prepare("SELECT * FROM `user` WHERE email = ? AND password = ? AND otp = ? AND verification_status = ?");
               $check_users->execute([$email, $pass, $rand_otp, $verification_status]);
               $row = $check_users->fetch(PDO::FETCH_ASSOC);
   
               if($check_users->rowCount() > 0 ){
   
                  if($verification_status == "verified"){
   
                     $_SESSION['unique_id'] = $row['unique_id'];
                     $_SESSION['email'] = $row['email'];
                     $_SESSION['otp'] = $row['otp'];
   
                     header('location:index');
                     
                  }elseif($verification_status == "0"){
                     
                     $_SESSION['unique_id'] = $row['unique_id'];
                     $_SESSION['email'] = $row['email'];
                     $_SESSION['otp'] = $row['otp'];
                     header('location:verify');
               }
            }
         }
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register | RegisterWifi.Online</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- register section starts  -->

<section class="form-container">

   <form action="" method="post">

    
      <h3>create an account!</h3>
      <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <input type="number" name="number" required min="0" max="999999999999" maxlength="12" placeholder="enter your number" class="box">
      <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
      <input type="password" name="c_pass" required maxlength="20" placeholder="confirm your password" class="box">
      <!-- <input type="text" name="refer_code" maxlength="6" placeholder="referral code" class="box" id="refer_code"> -->
      <p>already have an account? <a href="login.php">login now</a></p>
      <input type="submit" value="register now" name="submit" class="btn">
   </form>
    
</section>

<!-- register section ends -->












<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>