<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['unique_id'])){
   $unique_id = $_SESSION['unique_id'];
}else{
   $unique_id = '';
   header('location:login');
};

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
     $insert_addList = $conn->prepare("INSERT INTO `orders_list` (unique_id, email, nama, phoneno, phonenoTambahan, nokp, alamatPemasangan, alamatBill, pid, tarikhWaktu, imgBill, imgKpD, imgKpB) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
     $insert_addList->execute([$unique_id, $email, $nama, $phoneno, $phonenoTambahan, $nokp, $alamatPemasangan, $alamatBill, $pid, $tarikhWaktu, $rename_imgBill, $rename_imgKpD, $rename_imgKpB]);
     $message[] = 'your submit form successfull!';
 
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Submit Form | RegisterWifi.Online</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

    <!-- Jquery Signature | Start -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- Jquery Signature | End -->

    <!-- assets signature -->
    <script type="text/javascript" src="asset/js/jquery.signature.min.js"></script>    
    <link rel="stylesheet" type="text/css" href="asset/css/jquery.signature.css">

    <!-- datetimepicker - CSS -->
    <link rel="stylesheet" href="css/datetimepicker/jquery.datetimepicker.min.css" />

    <style>

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

        #signa-c canvas{
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
    </style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="property-form">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Pendaftaran Unifi | Baru</h3>
      <h3>Terma & Syarat</h3>
      <div class="box">
        <p>Saya <span class="bold">BERSETUJU</span> dengan Terma dan Syarat di bawah.</p>

        <p>* Dengan ini saya bersetuju untuk melanggan perkhidmatan dengan langganan 24 bulan.</p>

        <p>* Saya telah membaca, memahami dan bersetuju untuk terikat dengan Terma & Syarat perkhidmatan.</p>

        <p>* Saya bersetuju untuk membayar Upfront Bill Rm100 dalam masa 10 hari setelah pemasangan selesai.</p>

        <p>* Dengan ini saya membenarkan wakil TM untuk meneruskan dan memproses permohonan saya. Sila maklumkan kepada saya sekiranya ada masalah yang berkaitan dengan permintaan saya.</p>

        </br>

        <p><span class="bold">Nota Penting:</span></p>

        <p>* SILA UPLOAD GAMBAR KAD PENGENALAN DEPAN & BELAKANG.</p>

        <p>* SILA UPLOAD GAMBAR ALAMAT SAHAJA PADA BILL API / BILL AIR.</p>

        <p>* SETIAP BILL BULANAN AKAN ADA CAS SST.</p>

        <p>* PEMASANGAN BERGANTUNG KEADAAN RUMAH. <span class="bold">PEMASANGAN STANDARD PERCUMA</span>, NAMUN JIKA CABLE <span class="bold">LEBIH 10 METER</span>. ITU BERGANTUNG PADA BUDI BICARA PIHAK TECHNICIAN.</p>

        </br>
        <h4><span class="bold">Terima Kasih</span></h4>
        <h4><span class="bold">Penjual Sah TM</span></h4>
        <h4><span class="bold">Muhamad Izzuddin</span></h4>
        </br>

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


    <!-- <div class="sign-customer">
    <label>Signature Customer :</label>
    </br>
    <div id="signa-c"></div>
    <textarea id="signature-customer-64" name="sign-c" style="display: none;" required></textarea>
    </br>
    <button class="btn" id="clear-c">
        <i class="fas fa-eraser"> Padam</i>
    </button>

    </div>
    </div> -->

        

      </div>
      <div class="box">
         <p>1. Email <span class="wrong">*</span></p>
         <input type="email" name="email" required placeholder="Isi Email" class="input">
      </div>
      <div class="box">
         <p>2. Nama Penuh <span class="wrong">*</span></p>
         <input type="text" name="nama" required placeholder="Isi Nama Penuh" class="input">
         </div>
      <div class="box">
         <p>3. Nombor Telefon <span class="wrong">*</span></p>
         <input type="number" name="phoneno" maxlength="12" required placeholder="Contoh: 01133165639" class="input">
         </div>
      <div class="box">
         <p>4. Nombor Telefon Tambahan <span class="wrong">*</span></p>
         <input type="number" name="phonenoTambahan" maxlength="12" required placeholder="Contoh: 01133165639" class="input">
         </div>
      <div class="box">
         <p>5. Nombor K/P <span class="wrong">*</span></p>
         <input type="number" name="nokp" maxlength="12" required placeholder="Contoh: 93110408****" class="input">
         </div>
      <div class="box">
         <p>6. Alamat Penuh Pemasangan <span class="wrong">*</span></p>
         <textarea name="alamatPemasangan" class="input" required cols="30" rows="5" placeholder="Isi Alamat Pemasangan"></textarea>
      </div>
      <div class="box">
         <p>7. Alamat S/Menyurat <span class="wrong">*</span></p>
         <textarea name="alamatBill" class="input" required cols="30" rows="5" placeholder="Isi Alamat Pemasangan"></textarea>
      </div>
     

      <div class="box">
    <p>8. Pakej Unifi Terkini 2024</p>

      <select name="pid" required class="input" required>
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

        <div class="box">
         <p>9. Tarikh & Waktu Pemasangan Unifi <span class="wrong">*</span></p>
         <input type="text" name="tarikhWaktu" id="timedatePicker" autocomplete="off" required placeholder="Pilih Tarikh & Waktu" class="input">
         </div>

         <div class="box">
            <p>10. Bill Api / Bill Air (Bahagian Alamat) <span class="wrong">*</span></p>
            <input type="file" name="imgBill" class="input" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         </div>

         <div class="box">
            <p>11. Kad Pengenalan (Bahagian Depan) <span class="wrong">*</span></p>
            <input type="file" name="imgKpD" class="input" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         </div>

         <div class="box">
            <p>12. Kad Pengenalan (Bahagian Belakang) <span class="wrong">*</span></p>
            <input type="file" name="imgKpB" class="input" accept="image/jpg, image/jpeg, image/png, image/webp" required>
         </div>

      <input type="submit" value="Submit Form" class="btn" name="submit">
   </form>

</section>

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

<script src="js/datetimepicker/jquery.js"></script>
<script src="js/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    <script>
      $("#timedatePicker").datetimepicker({
        step: 60,
        minDate: new Date()
      });
    </script>





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>