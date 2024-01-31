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
         <input type="number" name="phoneno" maxlength="12" required placeholder="Contoh: 01133165639" class="input">
         </div>
      <div class="box">
         <p>5. Nombor K/P <span class="wrong">*</span></p>
         <input type="number" name="phonenoTambahan" maxlength="12" required placeholder="Contoh: 93110408****" class="input">
         </div>
      <div class="box">
         <p>6. Alamat Penuh Pemasangan <span class="wrong">*</span></p>
         <textarea name="alamatPemasangan" class="input" required cols="30" rows="5" placeholder="Isi Alamat Pemasangan"></textarea>
      </div>
      <div class="box">
         <p>7. Alamat S/Menyurat <span class="wrong">*</span></p>
         <textarea name="alamatPemasangan" class="input" required cols="30" rows="5" placeholder="Isi Alamat Pemasangan"></textarea>
      </div>
        <div class="box">
         <p>8. Pilih Pakej Unifi Terkini 2024 <span class="wrong">*</span></p>
         <div class="gender">
            <input type="radio" value="U89" id="U89" name="pakej">
            <label for="U89">Pakej 100Mbps RM 89 Bulanan</label>
         </div>
         <div class="gender">
            <input type="radio" value="U139" id="U139" name="pakej">
            <label for="U139">Pakej 300Mbps RM 139 Bulanan</label>
         </div>
         <div class="gender">
            <input type="radio" value="U159" id="U159" name="pakej">
            <label for="U159">Pakej 500Mbps RM 159 Bulanan</label>
         </div>
         <div class="gender">
            <input type="radio" value="U289" id="U289" name="pakej">
            <label for="U289">Pakej 1Gbps RM 289 Bulanan</label>
         </div>
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

      <input type="submit" value="Submit Form" class="btn" name="post">
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