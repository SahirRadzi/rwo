<?php

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard | RWO Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <!-- Welcome | start -->

   <div class="box">
      <h3>welcome!</h3>
      <p><?= $fetch_profile['nama']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>

   <!-- Welcome | ends -->

   <!-- Total All List | start -->

   <div class="box">
      <?php
         $select_all_list = $conn->prepare("SELECT * FROM `orders_list`");
         $select_all_list->execute();
            $jumlah_senarai = $select_all_list->rowCount();
      ?>
      <h3><?= $jumlah_senarai; ?></h3>
      <p>all list</p>
      <a href="placed_orders.php" class="btn">see list</a>
   </div>

<!-- Total All List / ends -->

   <!-- Total New List | start -->

   <div class="box">
      <?php
         $jumlah_baru = 0;
         $select_new = $conn->prepare("SELECT * FROM `orders_list` WHERE status =? ");
         $select_new->execute(['Baru']);
            $jumlah_baru = $select_new->rowCount();
      ?>
      <h3><?= $jumlah_baru; ?></h3>
      <p>update status (N)</p>
      <a href="update_status_new.php" class="btn">see list</a>
   </div>

<!-- Total New List / ends -->

   <!-- Total Proses List | start -->

   <div class="box">
      <?php
         $jumlah_proses = 0;
         $select_proses = $conn->prepare("SELECT * FROM `orders_list` WHERE status =? ");
         $select_proses->execute(['Proses']);
            $jumlah_proses = $select_proses->rowCount();
      ?>
      <h3><?= $jumlah_proses; ?></h3>
      <p>update status (P)</p>
      <a href="update_status_proceed.php" class="btn">see list</a>
   </div>

<!-- Total Proses List / ends -->

   <!-- Total Cancel List | start -->

   <div class="box">
      <?php
         $jumlah_batal = 0;
         $select_proses = $conn->prepare("SELECT * FROM `orders_list` WHERE status =? ");
         $select_proses->execute(['Batal']);
            $jumlah_batal = $select_proses->rowCount();
      ?>
      <h3><?= $jumlah_batal; ?></h3>
      <p>update status (C)</p>
      <a href="update_status_cancel.php" class="btn">see list</a>
   </div>

<!-- Total Cancel List / ends -->

<?php
         $select_all_list = $conn->prepare("SELECT * FROM `orders_list`");
         $select_all_list->execute();
            $jumlah_senarai = $select_all_list->rowCount();
      ?>

 <!-- Total All Demands | start -->

 <div class="box">
      <?php
         $select_all_demands = $conn->prepare("SELECT * FROM `demand_list`");
         $select_all_demands->execute();
            $jumlah_senarai_permintaan = $select_all_demands->rowCount();
       
      ?>
      <h3><?= $jumlah_senarai_permintaan; ?></h3>
      <p>all demands</p>
      <a href="demand_orders.php" class="btn">see list</a>
   </div>

<!-- Total All Demands / ends -->

   <!-- Total Demand List | start -->

   <div class="box">
      <?php
         $jumlah_permintaanBaru = 0;
         $select_newDemands = $conn->prepare("SELECT * FROM `demand_list` WHERE status =?");
         $select_newDemands->execute(['Baru']);
            $jumlah_permintaanBaru = $select_newDemands->rowCount();
         
      ?>
      <h3><?= $jumlah_permintaanBaru; ?></h3>
      <p>status demands (N)</p>
      <a href="update_status_demands_new.php" class="btn">see list</a>
   </div>

<!-- Total Demand List / ends -->

 <!-- Total Demand Pendings | start -->

 <div class="box">
      <?php
         $jumlah_permintaanBaru_proses = 0;
         $select_newDemands_proceed = $conn->prepare("SELECT * FROM `demand_list` WHERE status =?");
         $select_newDemands_proceed->execute(['Proses']);
            $jumlah_permintaanBaru_proses = $select_newDemands_proceed->rowCount();
       
      ?>
      <h3><?= $jumlah_permintaanBaru_proses; ?></h3>
      <p>status demands (P)</p>
      <a href="update_status_demands_proceed.php" class="btn">see list</a>
   </div>

<!-- Total Demand Pendings / ends -->

   <!-- Total Demands Cancel List | start -->

   <div class="box">
      <?php
         $jumlah_permintaanBaru_batal = 0;
         $select_newDemands_cancel = $conn->prepare("SELECT * FROM `demand_list` WHERE status =? ");
         $select_newDemands_cancel->execute(['Batal']);
            $jumlah_permintaanBaru_batal = $select_newDemands_cancel->rowCount();
      ?>
      <h3><?= $jumlah_permintaanBaru_batal; ?></h3>
      <p>status demands (C)</p>
      <a href="update_status_demands_cancel.php" class="btn">see list</a>
   </div>

<!-- Total Demands Cancel List / ends -->

   <!-- Number of Admin | starts -->

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>admins</p>
      <a href="admin_accounts.php" class="btn">see admins</a>
   </div>

   <!-- Number of Admin | ends -->

<!-- Message | starts -->
   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
   <h3><?= $numbers_of_messages; ?></h3>
   <p>new messages</p>
   <a href="#" class="btn">see messages</a>
   </div>
         <!-- Message | ends -->

   </div>

  

</section>

<!-- admin dashboard section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>