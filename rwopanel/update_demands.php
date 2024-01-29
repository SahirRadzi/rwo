<?php

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
};

if(isset($_GET['update'])){
  $update_id = $_GET['update'];
}else{
  $update_id = '';
  header('location:dashboard.php');
};


if(isset($_POST['update_demands'])){

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $nama = $_POST['nama'];
  $nama = filter_var($nama, FILTER_SANITIZE_STRING);

  $phoneno = $_POST['phoneno'];
  $phoneno = filter_var($phoneno, FILTER_SANITIZE_STRING);
  $phonenoTambahan = $_POST['phonenoTambahan'];
  $phonenoTambahan = filter_var($phonenoTambahan, FILTER_SANITIZE_STRING);
  $nokp = $_POST['nokp'];
  $nokp = filter_var($nokp, FILTER_SANITIZE_STRING);
  $alamatPemasangan = $_POST['alamatPemasangan'];
  $alamatPemasangan = filter_var($alamatPemasangan, FILTER_SANITIZE_STRING);
  $alamatBill = $_POST['alamatBill'];
  $alamatBill = filter_var($alamatBill, FILTER_SANITIZE_STRING);
  $pid = $_POST['pid'];
  $pid = filter_var($pid, FILTER_SANITIZE_STRING);
  $tarikhWaktu = $_POST['tarikhWaktu'];
  $tarikhWaktu = filter_var($tarikhWaktu, FILTER_SANITIZE_STRING);
  $catatan = $_POST['catatan'];
  $catatan = filter_var($catatan, FILTER_SANITIZE_STRING);


  $old_imgBill = $_POST['old_imgBill'];
  $old_imgBill = filter_var($old_imgBill, FILTER_SANITIZE_STRING);
  $imgBill = $_FILES['imgBill']['name'];
  $imgBill = filter_var($imgBill, FILTER_SANITIZE_STRING);
  $imgBill_ext = pathinfo($imgBill, PATHINFO_EXTENSION);
  $rename_imgBill = create_unique_id().'.'.$imgBill_ext;
  $imgBill_tmp_name = $_FILES['imgBill']['tmp_name'];
  $imgBill_size = $_FILES['imgBill']['size'];
  $imgBill_folder = '../uploaded_bill/'.$rename_imgBill;

  if(!empty($imgBill)){
    if($imgBill_size > 2000000){
       $message[] = 'Photo of billing size is to large!';
    }else{
       $update_imgBill = $conn->prepare("UPDATE `demand_list` SET imgBill = ? WHERE id = ?");
       $update_imgBill->execute([$rename_imgBill, $update_id]);
       move_uploaded_file($imgBill_tmp_name, $imgBill_folder);
       if($old_imgBill != ''){
          unlink('../uploaded_bill/'.$old_imgBill);
       }
    }
 }
  $old_imgKpD = $_POST['old_imgKpD'];
  $old_imgKpD = filter_var($old_imgKpD, FILTER_SANITIZE_STRING);
  $imgKpD = $_FILES['imgKpD']['name'];
  $imgKpD = filter_var($imgKpD, FILTER_SANITIZE_STRING);
  $imgKpD_ext = pathinfo($imgKpD, PATHINFO_EXTENSION);
  $rename_imgKpD = create_unique_id().'.'.$imgKpD_ext;
  $imgKpD_tmp_name = $_FILES['imgKpD']['tmp_name'];
  $imgKpD_size = $_FILES['imgKpD']['size'];
  $imgKpD_folder = '../uploaded_kpd/'.$rename_imgKpD;

  if(!empty($imgKpD)){
    if($imgKpD_size > 2000000){
       $message[] = 'Front Side of IC size is too large!';
    }else{
       $update_imgKpD = $conn->prepare("UPDATE `demand_list` SET imgKpD = ? WHERE id = ?");
       $update_imgKpD->execute([$rename_imgKpD, $update_id]);
       move_uploaded_file($imgKpD_tmp_name, $imgKpD_folder);
       if($old_imgKpD != ''){
          unlink('../uploaded_kpd/'.$old_imgKpD);
       }
    }
 }
  $old_imgKpB = $_POST['old_imgKpB'];
  $old_imgKpB = filter_var($old_imgKpB, FILTER_SANITIZE_STRING);
  $imgKpB = $_FILES['imgKpB']['name'];
  $imgKpB = filter_var($imgKpB, FILTER_SANITIZE_STRING);
  $imgKpB_ext = pathinfo($imgKpB, PATHINFO_EXTENSION);
  $rename_imgKpB = create_unique_id().'.'.$imgKpB_ext;
  $imgKpB_tmp_name = $_FILES['imgKpB']['tmp_name'];
  $imgKpB_size = $_FILES['imgKpB']['size'];
  $imgKpB_folder = '../uploaded_kpb/'.$rename_imgKpB;

  if(!empty($imgKpB)){
    if($imgKpB_size > 2000000){
       $message[] = 'Front Side of IC size is too large!';
    }else{
       $update_imgKpB = $conn->prepare("UPDATE `demand_list` SET imgKpDB = ? WHERE id = ?");
       $update_imgKpB->execute([$rename_imgKpB, $update_id]);
       move_uploaded_file($imgKpB_tmp_name, $imgKpB_folder);
       if($old_imgKpB != ''){
          unlink('../uploaded_kpb/'.$old_imgKpB);
       }
    }
 }

    $update_listing = $conn->prepare("UPDATE `demand_list` SET email = ?, nama = ?, phoneno = ?, phonenoTambahan = ?, nokp = ?, alamatPemasangan = ?, alamatBill = ?, pid = ?, tarikhWaktu = ?, catatan = ? WHERE id = ? ");
    $update_listing->execute([$email, $nama, $phoneno, $phonenoTambahan, $nokp, $alamatPemasangan, $alamatBill, $pid, $tarikhWaktu, $catatan, $update_id]);

    $message[] = 'listing updated successfully!';

}

if(isset($_POST['delete_imgBill'])){

  $old_imgBill = $_POST['old_imgBill'];
  $old_imgBill = filter_var($old_imgBill, FILTER_SANITIZE_STRING);
  $update_imgBill = $conn->prepare("UPDATE `demand_list` SET imgBill = ? WHERE id = ?");
  $update_imgBill->execute(['', $update_id]);
  if($old_imgBill != ''){
     unlink('../uploaded_bill/'.$old_imgBill);
     $message[] = 'Photo of billing deleted!';
  }

}

if(isset($_POST['delete_imgKpD'])){

  $old_imgKpD = $_POST['old_imgKpD'];
  $old_imgKpD = filter_var($old_imgKpD, FILTER_SANITIZE_STRING);
  $update_imgKpD = $conn->prepare("UPDATE `demand_list` SET imgKpD = ? WHERE id = ?");
  $update_imgKpD->execute(['', $update_id]);
  if($old_imgKpD != ''){
     unlink('../uploaded_kpd/'.$old_imgKpD);
     $message[] = 'Front Side of IC size is too large!';
  }

}

if(isset($_POST['delete_imgKpB'])){

  $old_imgKpB = $_POST['old_imgKpB'];
  $old_imgKpB = filter_var($old_imgKpB, FILTER_SANITIZE_STRING);
  $update_imgKpB = $conn->prepare("UPDATE `demand_list` SET imgKpB = ? WHERE id = ?");
  $update_imgKpB->execute(['', $update_id]);
  if($old_imgKpB != ''){
     unlink('../uploaded_kpb/'.$old_imgKpB);
     $message[] = 'Front Side of IC size is too large!';
  }

}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Demands | RWO Panel</title>

     <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">
    
    <!-- Jquery Signature | Start -->
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <!-- Jquery Signature | End -->

    <!-- assets signature -->
    <!-- <script type="text/javascript" src="../asset/js/jquery.signature.min.js"></script>    
    <link rel="stylesheet" type="text/css" href="../asset/css/jquery.signature.css"> -->

     <!-- datetimepicker - CSS -->
     <link rel="stylesheet" href="../css/datetimepicker/jquery.datetimepicker.min.css" />


    <style>

  p{
    margin-top: 15px !important;
    font-size: 1.5rem !important;
    color: var(--black) !important;
  }

  h3{
    font-size: 1.5rem !important;
    color: var(--black) !important;
  }

  h4{
    margin-top: 15px !important;
    font-size: 1.5rem !important;
    color: var(--black) !important;
  }

   header{
    font-size: 2rem !important;
    color: var(--black) !important;
    font-weight: 600 !important;
    text-align: center !important;
   }

   .form{
    margin-top: 30px !important;
   }

   .input-box{
    width: 100% !important;
    margin-top: 20px !important;
   }

   .input-box label{
    color: var(--black) !important;
    font-size: 1.8rem !important;
   }

   .input-box span{
    color: red !important;
   }

   .form :where(.input-box input, .input-box select, .select-box) {
  position: relative;
  height: 50px;
  width: 100%;
  font-size: 1.8rem;
  color: #707070;
  margin-top: 8px;
  outline: none;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 0 15px;
  background-color: #fff;
}

.select-box select {
  color: #707070;
  background-color: #fff;
  font-size: 1.8rem !important;
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
}

.select-mobile {
  display: flex;
  column-gap: 10px;
}
.select-mobile select {
  margin-top: 8px;
  color: #707070;
  background-color: #fff;
  font-size: 1.8rem !important;
  height: 50px;
  width: 40%;
  outline: none;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.select-residen select,
.select-alamat textarea {
  margin-top: 8px;
  color: #707070;
  background-color: #fff;
  font-size: 1.8rem !important;
  height: 100%;
  width: 40%;
  outline: none;
  border: 1px solid #ddd;
  border-radius: 5px;
  width: 100%;
}

.select-residen select {
  height: 50px;
}

.form .gender-box {
  margin-top: 20px;
}

.gender-box h3 {
  color: var(--black) !important;
  font-size: 1.8rem !important;
  font-weight: 400;
}

.form .column {
  display: flex;
  column-gap: 15px;
}

.form :where(.gender-option, .gender) {
  display: flex;
  align-items: center;
  column-gap: 50px;
}

.form .gender {
  column-gap: 5px;
  cursor: pointer;
}
.gender input {
  accent-color: #ff6624;
}

.gender label {
  color: var(--black) !important;
}

.form :where(.gender input, .gender label) {
  cursor: pointer;
  font-size: 1.8rem !important;
}

.form button {
  margin-top: 20px;
  height: 50px;
  width: 100%;
  border: none;
  border-radius: 5px;
  font-size: 1.8rem !important;
  font-weight: 400;
  color: #fff;
  transition: all 0.2s ease;
  background-color: rgb(255, 125, 69);
  cursor: pointer;
}
.form .spinner {
  margin-top: 20px;
}

.form button:hover {
  background-color: rgb(255, 77, 0);
}

.img-box{
  padding: 10px;
  width: 390px;
  height: 310px;
  border: 5px solid #fff;
  overflow: hidden;
  transition: 1s ease-out;
}

.img-box img{
    object-fit: contain;
    width: 350px;
    height: 210px;
    cursor: zoom-in;
}
.img-box:hover{
  transform: scale(1.2);
}

.img-box .del-btn{
  margin-bottom: 20px;
  display: block;
  width: 350px;
  cursor: pointer;
  text-transform: capitalize;
  background-color: #E74C3C ;
  color: white;
}

.img-box .del-btn:hover{
  background-color: #943126;
}

.img-box-sign img{
  background-color: var(--black) !important;
}

.signature-box {
  margin-top: 20px;
  display: flex;
  flex-wrap: wrap;
  width: 100%;
}

.kbw-signature{
  width: 360px;
  height: 300px;
}

#signa-s canvas{
  width: 100% !important;
  height: auto !important;
}

.sign-seller, .sign-customer{
  padding: 10px 10px;
}

.sign-seller label,
.sign-customer label{
  font-size: 1.5rem !important;
  color: var(--black);
}

/* Responsive Mobile Friendly */

@media screen and (max-width: 500px) {
  .form .column {
    flex-wrap: wrap;
  }
}


    </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="placed-orders">

<h1 class="heading">update demand list</h1>


<header>Pendaftaran Unifi  | Baru
</br>
Baca & Fahamkan Terma & Syarat:
</header>

<p>Saya <b>BERSETUJU</b> dengan Terma dan Syarat di bawah.
</p>

<p>* Dengan ini saya bersetuju untuk melanggan perkhidmatan dengan langganan 24 bulan.
</p>

<p>* Saya telah membaca, memahami dan bersetuju untuk terikat dengan Terma & Syarat perkhidmatan.
</p>

<p>* Saya bersetuju untuk membayar Upfront Bill Rm100 dalam masa 10 hari setelah pemasangan selesai.
</p>

<p>* Dengan ini saya membenarkan wakil TM untuk meneruskan dan memproses permohonan saya. Sila maklumkan kepada saya sekiranya ada masalah yang berkaitan dengan permintaan saya.</p>

<h4>Nota Penting:</h4>

<p>* SILA UPLOAD GAMBAR KAD PENGENALAN DEPAN & BELAKANG.</p>

<p>* SILA UPLOAD GAMBAR ALAMAT SAHAJA PADA BILL API / BILL AIR.</p>

<p>* SETIAP BILL BULANAN AKAN ADA CAS SST.</p>

<p>* PEMASANGAN BERGANTUNG KEADAAN RUMAH. <b>PEMASANGAN STANDARD PERCUMA</b>, NAMUN JIKA CABLE <b>LEBIH 10 METER</b>. ITU BERGANTUNG PADA BUDI BICARA PIHAK TECHNICIAN.</p>

<h4>Terima Kasih</h4>
<h3>Penjual Sah TM</h3>
<h3>Muhamad Izzuddin</h3>

<?php 
    $update_id = $_GET['update'];
    $show_update_list = $conn->prepare("SELECT * FROM `demand_list` WHERE id = ?");
    $show_update_list->execute([$update_id]);
    if($show_update_list->rowCount() > 0 ){
        while($fetch_updates = $show_update_list->fetch(PDO::FETCH_ASSOC)){

?>

<form action="" method="POST" class="form" enctype="multipart/form-data">
  <div class="input-box">
    <input type="hidden" name="update_id" value="<?= $fetch_updates['id'];?>">
  </div>
  <div class="input-box">
    <input type="hidden" name="old_imgBill" value="<?= $fetch_updates['imgBill'];?>">
  </div>
  <div class="input-box">
    <input type="hidden" name="old_imgKpD" value="<?= $fetch_updates['imgKpD'];?>">
  </div>
  <div class="input-box">
    <input type="hidden" name="old_imgKpB" value="<?= $fetch_updates['imgKpB'];?>">
  </div>

<!-- <div class="signature-box">
    <div class="sign-customer">
    <label>Signature Customer :</label>
    </br>
    <div class="input-box">
    <div class="img-box-sign">
    <?php if(!empty($fetch_updates['signa_c'])){ ;?>
        <img src="../uploaded_sign_c/<?= $fetch_updates['signa_c'];?> ">
    <?php } ?>
    </div>
    </div>
    
    </div>
</div> -->


  <div class="input-box">
    <label>1. Email <span>*</span></label>
    <input type="email" name="email" placeholder="Isi Email" value="<?= $fetch_updates['email'];?>" required />
  </div>
  <div class="input-box">
    <label>2. Nama Penuh <span>*</span></label>
    <input type="text" name="nama" placeholder="Isi Nama Penuh" value="<?= $fetch_updates['nama'];?>" required />
  </div>
  <div class="input-box">
    <label>3. Nombor Telefon <span>*</span></label>
    <div class="select-mobile">
      <input type="number" name="phoneno" placeholder="Contoh: 01133165639" min="0" max="9999999999" maxlength="10" value="<?= $fetch_updates['phoneno'];?>" required />
    </div>
  </div>
  <div class="input-box">
    <label>4. Nombor Telefon Tambahan</label>
    <div class="select-mobile">
      <input type="number" name="phonenoTambahan" placeholder="Contoh: 01133165639" min="0" max="999999999999" maxlength="12"/>
    </div>
  </div>
  <div class="input-box">
    <label>5. Nombor K/P <span>*</span></label>
    <div class="select-mobile">
      <input type="number" name="nokp" placeholder="Contoh: 931104086159" maxlength="12" value="<?= $fetch_updates['nokp'];?>" required />
    </div>
  </div>


  <div class="input-box">
    <label>6. Alamat Penuh Pemasangan <span>*</span></label>
    <div class="select-alamat">
      <textarea name="alamatPemasangan" maxlength="1000" cols="30" rows="5" placeholder="Isi Alamat Pemasangan" required><?= $fetch_updates['alamatPemasangan'];?></textarea>
    </div>
  </div>
  <div class="input-box">
    <label>7. Alamat S/Menyurat <span>*</span></label>
    <div class="select-alamat">
      <textarea name="alamatBill" maxlength="1000" cols="30" rows="5" placeholder="Isi Alamat S/Menyurat" required><?= $fetch_updates['alamatBill'];?></textarea>
    </div>
  </div>

  <div class="input-box">
    <label>8. Pakej Unifi Terkini 2024</label>
    </br>

        <?php 
          $update_id = $_GET['update'];
          $grab = $conn->prepare("SELECT demand_list.pid, products.name FROM demand_list INNER JOIN products ON demand_list.pid = products.id WHERE demand_list.id = ?");
          $grab->execute([$update_id]);
          if($grab->rowCount() > 0){
            while($fetch_grab = $grab->fetch(PDO::FETCH_ASSOC)){
        ?>
      <select name="pid" class="box" required>
         <option value="<?= $fetch_grab['pid'];?>" disabled selected><?= $fetch_grab['name'];?></option>
         <?php 
            }
          }
         ?>

         <?php 
               
               $select_product = $conn->prepare("SELECT * FROM `products`");
               $select_product->execute();
                  while($result_product = $select_product->fetch(PDO::FETCH_ASSOC)){
      
         ?>

<option value="<?= $result_product['id'];?>"><?= $result_product['name'];?></option>

         <?php  
            }  
      ?>
      </select>
     
  </div>



  <div class="input-box">
    <label>9. Tarikh & Waktu Pemasangan Unifi <span>*</span></label>
    <input type="text" class="box" value="<?= $fetch_updates['tarikhWaktu'];?>" autocomplete="off" placeholder="Pilih Tarikh & Waktu" name="tarikhWaktu" id="timedatePicker" required/>
  </div>

  <div class="input-box">
    <div class="img-box">
    <?php if(!empty($fetch_updates['imgBill'])){ ;?>
        <img src="../uploaded_bill/<?= $fetch_updates['imgBill'];?> ">
        <input type="submit" value="delete" name="delete_imgBill" class="del-btn" onclick="return confirm('Anda pasti untuk padam gambar Bill Api / Bill Air ?');">
    <?php } ?>
    </div>
    <label>10. Bill Api / Bill Air (Bahagian Alamat)<span>*</span></label>
    <input type="file" name="imgBill" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
  </div>

  <div class="input-box">
  <div class="img-box">
      <?php if(!empty($fetch_updates['imgKpD'])){ ;?>
        <img src="../uploaded_kpd/<?= $fetch_updates['imgKpD'];?> ">
        <input type="submit" value="delete" name="delete_imgKpD" class="del-btn" onclick="return confirm('Anda pasti untuk padam gambar Kad Pengenalan (Bahagian Depan) ?');">
    <?php } ?>
    </div>
    <label>11. Kad Pengenalan (Bahagian Depan)<span>*</span></label>
    <input type="file" name="imgKpD" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
  </div>

  <div class="input-box">
  <div class="img-box">
    <?php if(!empty($fetch_updates['imgKpB'])){ ;?>
        <img src="../uploaded_kpb/<?= $fetch_updates['imgKpB'];?> ">
        <input type="submit" value="delete" name="delete_imgKpB" class="del-btn" onclick="return confirm('Anda pasti untuk padam gambar Kad Pengenalan (Bahagian Belakang) ?');">
    <?php } ?>
    </div>
    <label>12. Kad Pengenalan (Bahagian Belakang)<span>*</span></label>
    <input type="file" name="imgKpB" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
  </div>

  <div class="input-box">
    <label>13. Catatan <span>*</span></label>
    <div class="select-alamat">
      <textarea name="catatan" maxlength="500" cols="30" rows="5" placeholder="Tambah Catatan"><?= $fetch_updates['catatan'];?></textarea>
    </div>
  </div>

    

  <button type="submit" name="update_demands" class="btn-submit">Update</button>

</form>

<?php 
        }
    }

?>

    


</section>

<script src="../js/datetimepicker/jquery.js"></script>
<script src="../js/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    <script>
      $("#timedatePicker").datetimepicker({
        step: 60,
        minDate: new Date()
      });
    </script>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>



</body>
</html>