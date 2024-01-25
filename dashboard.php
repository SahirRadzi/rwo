<?php  

include 'components/connect.php';

session_start();

if(isset($_SESSION['unique_id'])){
   $unique_id = $_SESSION['unique_id'];
}else{
   $unique_id = '';
   header('location:login');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard | RegisterWifi.Online</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `user` WHERE unique_id = ? LIMIT 1");
         $select_profile->execute([$unique_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
     
      <h3>welcome!</h3>
      <p><?= $fetch_profile['nama']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
      </div>

      <div class="box">
         <h3>Coming Soon</h3>
         <p>your referral points</p>
         <a href="#" class="btn">view referral points</a>
      </div>

      <div class="box">
      
      <h3>Coming Soon</h3>
      <p>your claim points</p>
      <a href="#" class="btn">view claim points</a>
      </div>

      <div class="box">
     
      <h3>Coming Soon</h3>
      <p>your request claim</p>
      <a href="#" class="btn">view request claim</a>
      </div>

      <div class="box">
      
      <h3>Coming Soon</h3>
      <p>your complete claim</p>
      <a href="#" class="btn">view complete claim</a>
      </div>

      <div class="box">
      <h3>referral Setting</h3>
      <?php
         $select_referral = $conn->prepare("SELECT * FROM `user` WHERE unique_id = ? LIMIT 1");
         $select_referral->execute([$unique_id]);
         $fetch_referral = $select_referral->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_referral['referral_code'];?></p>
      <a href="referral" class="btn">view referral setting</a>
      </div>

   </div>

</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>