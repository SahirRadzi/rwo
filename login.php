<?php 

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
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
   $verification_status = "";

   $select_user = $conn->prepare("SELECT * FROM `user` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['unique_id'] = $row['unique_id'];
      $_SESSION['verification_status'] = $row['verification_status'];

      if($_SESSION['verification_status'] == "verified"){
         $_SESSION['unique_id'] = $row['unique_id'];
         header('location:index');
         
      }elseif($_SESSION['verification_status'] == "0"){
         $_SESSION['unique_id'] = $row['unique_id'];
         $_SESSION['email'] = $row['email'];
         $_SESSION['otp'] = $row['otp'];
         header('location:verify');
      }
   }else{
      $warning_msg[] = 'incorrect username or password!';
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login | RegisterWifi.Online</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <!-- RECAPCHA -->
   <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- login section starts  -->

<section class="form-container">

   <form action="" method="post">
      <h3>welcome back!</h3>
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <input type="password" name="pass" required maxlength="20" placeholder="enter your password" class="box">
      <!-- <div class="g-recaptcha" data-sitekey="6LdPUwspAAAAABPokUYN_brLXb6Ps4qWt5lRhBAl"></div> -->
      <p>forgot password ? click <a href="forgot_pass.php">here</a></p>
      <p>don't have an account? <a href="register">register new</a></p>
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- login section ends -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>