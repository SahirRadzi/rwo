<?php

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

  $unique_id = $_SESSION['unique_id'];
  $email = $_POST['email'];
  $nama = $_POST['nama'];
  $phoneno = $_POST['phoneno'];
  $phonenoTambahan = $_POST['phonenoTambahan'];
  $nokp = $_POST['nokp'];
  $alamatPemasangan = $_POST['alamatPemasangan'];
  $alamatBill = $_POST['alamatBill'];
  $pid = $_POST['pid'];
  $tarikhWaktu = $_POST['tarikhWaktu'];

  $imgBill = $_FILES['imgBill']['name'];
  $imgBill = filter_var($imgBill, FILTER_SANITIZE_STRING);
  $imgBill_ext = pathinfo($imgBill, PATHINFO_EXTENSION);
  $rename_imgBill = create_unique_id().'.'.$imgBill_ext;
  $imageBill_tmp_name = $_FILES['imgBill']['tmp_name'];
  $imageBill_size = $_FILES['imgBill']['size'];
  $imageBill_folder = '../uploaded_bill/'.$rename_imgBill;

  if(!empty($imgBill)){
    if($imageBill_size > 2000000){
      $message[] = 'Size Gambar Bill terlalu besar!';
    }else{
      move_uploaded_file($imageBill_tmp_name, $imageBill_folder);
    }
  }else{
    $rename_imgBill = '';
  }

  $imgKpD = $_FILES['imgKpD']['name'];
  $imgKpD = filter_var($imgKpD, FILTER_SANITIZE_STRING);
  $imgKpD_ext = pathinfo($imgKpD, PATHINFO_EXTENSION);
  $rename_imgKpD = create_unique_id().'.'.$imgKpD_ext;
  $imageKpD_tmp_name = $_FILES['imgKpD']['tmp_name'];
  $imageKpD_size = $_FILES['imgKpD']['size'];
  $imageKpD_folder = '../uploaded_kpd/'.$rename_imgKpD;

  if(!empty($imgKpD)){
    if($imageKpD_size > 2000000){
      $message[] = 'Front Side of IC size is too large!';
    }else{
      move_uploaded_file($imageKpD_tmp_name, $imageKpD_folder);
    }
  }else{
    $rename_imgKpD = '';
  }


  $imgKpB = $_FILES['imgKpB']['name'];
  $imgKpB = filter_var($imgKpB, FILTER_SANITIZE_STRING);
  $imgKpB_ext = pathinfo($imgKpB, PATHINFO_EXTENSION);
  $rename_imgKpB = create_unique_id().'.'.$imgKpB_ext;
  $imageKpB_tmp_name = $_FILES['imgKpB']['tmp_name'];
  $imageKpB_size = $_FILES['imgKpB']['size'];
  $imageKpB_folder = '../uploaded_kpb/'.$rename_imgKpB;

    if(!empty($imgKpB)){
      if($imageKpB_size > 2000000){
       $message[] = 'Back Side of IC size is too large!';
    }else{
      move_uploaded_file($imageKpB_tmp_name, $imageKpB_folder);
    }
  }else{
      $rename_imgKpB = '';
    }
    $insert_DemandsList = $conn->prepare("INSERT INTO `demand_list` (unique_id, email, nama, phoneno, phonenoTambahan, nokp, alamatPemasangan, alamatBill, pid, tarikhWaktu, imgBill, imgKpD, imgKpB) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $insert_DemandsList->execute([$unique_id, $email, $nama, $phoneno, $phonenoTambahan, $nokp, $alamatPemasangan, $alamatBill, $pid, $tarikhWaktu, $rename_imgBill, $rename_imgKpD, $rename_imgKpB]);
    $message[] = 'new demands list added!';


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Demands | RWO Panel</title>

     <!-- custom css file link  -->
     <link rel="stylesheet" href="../css/admin_style.css">

     <!-- font awesome cdn link  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />


    <!-- Jquery Signature | Start -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Jquery Signature | End -->

    <!-- assets signature -->
    <script type="text/javascript" src="../asset/js/jquery.signature.min.js"></script>    
    <link rel="stylesheet" type="text/css" href="../asset/css/jquery.signature.css">

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
  text-transform: uppercase !important;
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

/* .xdsoft_datetimepicker .xdsoft_calendar table{
  border-collapse:collapse !important;
  width: 50% !important;
} */

/* .sign-seller textarea,
.sign-customer textarea {
  display: none;
  width: 360px;
  height: 300px;
} */

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

<h1 class="heading">add new demands</h1>


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



</br>
</br>
<h4>Terima Kasih</h4>
<h3>Penjual Sah TM</h3>
<h3>Muhamad Izzuddin</h3>

<form action="#" method="POST" class="form" enctype="multipart/form-data">

<!-- <div class="signature-box"> -->
    <!-- <div class="sign-seller">
      <label>Signature Seller :</label>
    </br>
    <div id="signa-s"></div>
    <textarea id="signature-seller-64" name="sign-s" style="display: none;" required></textarea>
    </br>
    <button class="btn btn-outline-warning" id="clear-s">
        <i class="fas fa-eraser"> Padam</i>
    </button>

    </div> -->

<!-- 
    <div class="sign-customer">
    <label>Signature Customer :</label>
    </br>
    <div id="signa-c"></div>
    <textarea id="signature-customer-64" name="sign-c" style="display: none;" required></textarea>
    </br>
    <button class="btn-clear" id="clear-c">
        <i class="fas fa-eraser"> Padam</i>
    </button>

    </div>
</div> -->

  <div class="input-box">
    <label>1. Email <span>*</span></label>
    <input type="email" name="email" placeholder="Isi Email" />
  </div>
  <div class="input-box">
    <label>2. Nama Penuh <span>*</span></label>
    <input type="text" name="nama" placeholder="Isi Nama Penuh" required />
  </div>
  <div class="input-box">
    <label>3. Nombor Telefon <span>*</span></label>
    <div class="select-mobile">
      <input type="number" name="phoneno" placeholder="Contoh: 01133165639" min="0" max="999999999999" maxlength="12" required />
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
      <input type="number" name="nokp" placeholder="Contoh: 931104086159" min="0" max="999999999999" maxlength="12" />
    </div>
  </div>


  <div class="input-box">
    <label>6. Alamat Penuh Pemasangan <span>*</span></label>
    <div class="select-alamat">
      <textarea name="alamatPemasangan" id="" cols="30" rows="5" placeholder="Isi Alamat Pemasangan" required></textarea>
    </div>
  </div>
  <div class="input-box">
    <label>7. Alamat S/Menyurat <span>*</span></label>
    <div class="select-alamat">
      <textarea name="alamatBill" id="" cols="30" rows="5" placeholder="Isi Alamat S/Menyurat" required></textarea>
    </div>
  </div>

  <div class="input-box">
    <label>8. Pakej Unifi Terkini 2024</label>
    </br>

      <select name="pid" class="box" required>
         <option value="" disabled selected>Pilih Pakej Unifi Terkini--</option>

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
    <input type="text" class="box" placeholder="Pilih Tarikh & Waktu" name="tarikhWaktu" id="timedatePicker" autocomplete="off"/>
  </div>

  <div class="input-box">
    <label>10. Bill Api / Bill Air (Bahagian Alamat)<span>*</span></label>
    <input type="file" name="imgBill" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" >
  </div>

  <div class="input-box">
    <label>11. Kad Pengenalan (Bahagian Depan)<span>*</span></label>
    <input type="file" name="imgKpD" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" >
  </div>

  <div class="input-box">
    <label>12. Kad Pengenalan (Bahagian Belakang)<span>*</span></label>
    <input type="file" name="imgKpB" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" >
  </div>

    

    <!-- <div class="modal">
      <input type="checkbox" id="click">
      <label for="click" class="click-me">Click Me</label>
      <div class="content">
        <div class="h-modal">
          <h2>Modal Popup</h2>
          <label for="click" class="fas fa-times"></label>
        </div>
        <label for="click" class="fas fa-check"></label>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, cum!</p>
        <div class="line"></div>
        <label for="click" class="close-btn">Close</label>
      </div>
    </div> -->

    

  <button type="submit" name="submit" class="btn-submit">Submit</button>

</form>

    


</section>

<!-- <script type="text/javascript">
  var sig = $('#signa-s').signature({
      syncField: '#signature-seller-64',
      syncFormat: 'PNG'
  });
  $('#clear-s').click(function(e) {
      e.preventDefault();
      sig.signature('clear');
      $("#signature-seller-64").val('');
  });

</script> -->

<!-- <script type="text/javascript">
  var sign = $('#signa-c').signature({
      syncField: '#signature-customer-64',
      syncFormat: 'PNG'
  });
  $('#clear-c').click(function(e) {
      e.preventDefault();
      sign.signature('clear');
      $("#signature-customer-64").val('');
  });

</script> -->

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