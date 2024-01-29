<?php

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_status'])){

   $id = $_POST['id'];
   $status = $_POST['status'];
   $update_status = $conn->prepare("UPDATE `orders_list` SET status = ? WHERE id = ?");
   $update_status->execute([$status, $id]);
   $message[] = 'order status updated!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Status New | RWO Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_placed.css">

   <style>
    .view-btn{
        background-color: var(--solidBlack) !important;
    }
    .view-btn:hover{
        background-color: var(--black) !important;
    }
    .delete-btn, .view-btn, .box-queue, .box-queue-number{
        font-weight: normal !important;
    }

    p{
        font-weight: normal !important;
    } 
    
    span {
        font-weight: normal !important;
    }

    a.btn{
      font-weight: normal !important;
    }
   
    
   </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- total waiting section starts  -->

<section class="placed-orders">

      <?php
         $jumlah_baru = 0;
         $select_new = $conn->prepare("SELECT * FROM `orders_list` WHERE status =? ");
         $select_new->execute(['Baru']);
            $jumlah_baru = $select_new->rowCount();
      ?>

   <h1 class="heading">update status new | <?= $jumlah_baru;?></h1>
         <form action="" method="POST" class="search-form">
            <input type="text" name="search_box" placeholder="search uid / ic " maxlength="100" required>
            <button type="submit" class="fas fa-search" name="search_btn"></button>
         </form>

<div class="box-container">  
         
   <?php

   if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
   $search_box = $_POST['search_box'];
   $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
   $select_listings = $conn->prepare("SELECT orders_list.id, orders_list.unique_id, orders_list.tarikh, orders_list.nama, orders_list.email, orders_list.phoneno, orders_list.nokp, orders_list.alamatPemasangan, orders_list.alamatBill, products.s_name, products.price, orders_list.tarikhWaktu, orders_list.signa_c, orders_list.imgBill, orders_list.imgKpD, orders_list.imgKpB, orders_list.status FROM orders_list INNER JOIN products ON orders_list.pid = products.id WHERE status = 'Baru' AND unique_id LIKE '%{$search_box}%' AND nokp LIKE '%{$search_box}%'");
   $select_listings->execute();
   }else

   $select_listings = $conn->prepare("SELECT orders_list.id, orders_list.unique_id, orders_list.tarikh, orders_list.nama, orders_list.email, orders_list.phoneno, orders_list.nokp, orders_list.alamatPemasangan, orders_list.alamatBill, products.s_name, products.price, orders_list.tarikhWaktu, orders_list.signa_c, orders_list.imgBill, orders_list.imgKpD, orders_list.imgKpB, orders_list.status FROM orders_list INNER JOIN products ON orders_list.pid = products.id WHERE status = 'Baru'");
   $select_listings->execute();
   if($select_listings->rowCount() > 0){
      while($fetch_orders = $select_listings->fetch(PDO::FETCH_ASSOC)){
   ?>

   <div class="box">

   <div class="box-queue-number">unifi</div>
      <div class="box-queue">
         <?= $fetch_orders['s_name']; ?>
      </div>

      <p><b>#<span><?= $fetch_orders['id'];?></p>
      <p> Uid : <span><?= $fetch_orders['unique_id'] ;?></span></p>
      <p> Tarikh Pemohon : <span><?= date("d-m-Y",strtotime($fetch_orders['tarikh'])) ;?></span></p>
      <p> Tarikh Pemasangan : <span><?php if($fetch_orders['tarikhWaktu'] != ''){echo date("d-m-Y H:i",strtotime($fetch_orders['tarikhWaktu']));} else{echo'Tiada Data';};?></span></p>
      <p> Nama Pemohon : <span><?= $fetch_orders['nama'] ;?></span></p>
      <p> Email : <span><?= $fetch_orders['email'] ;?></span></p>
      <p> Phone No : <span><?= $fetch_orders['phoneno'] ;?></span></p>
      <p> No K/P : <span><?= $fetch_orders['nokp'] ;?></span></p>
      <p> Alamat Pemasangan : <span><?= $fetch_orders['alamatPemasangan'] ;?></span></p>
      <p> Alamat S/Menyurat : <span><?= $fetch_orders['alamatBill'] ;?></span></p>
      <p> Img Bill : <span><?php if($fetch_orders['imgBill'] == ''){echo'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>';} else{echo'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>';};?></span></p>
      <p> Img K/P D : <span><?php if($fetch_orders['imgKpD'] == ''){echo'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>';} else{echo'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>';} ;?></span></p>
      <p> Img K/P B : <span><?php if($fetch_orders['imgKpB'] == ''){echo'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path></svg>';} else{echo'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z"></path></svg>';} ;?></span></p>
      <form action="" method="POST">
      <p> Status: <span><?= $fetch_orders['status']; ?></span></p>

         <input type="hidden" name="id" value="<?= $fetch_orders['id']; ?>">
         <select name="status" class="drop-down" required>
            <option value="" selected disabled><?= $fetch_orders['status']; ?></option>
            <option value="Baru">Baru</option>
            <option value="Batal">Batal</option>
            <option value="Proses">Proses</option>
         </select>
         <div class="flex-btn">
            <input type="submit" value="update status" class="btn" name="update_status">
            <a href="update_list.php?update=<?=$fetch_orders['id'];?>" class="btn">update all</a>
           
         </div>
         <a href="view_details.php?view=<?= $fetch_orders['id'];?>" class="view-btn">Views</a>
      </form>
   </div>

   <?php
         }
      }elseif(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         echo '<p class="empty">no results found!</p>';
   }else{
      echo '<p class="empty">no new list yet!</p>';
   }
   ?>
   </div>

</section>

<!-- total waiting section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>