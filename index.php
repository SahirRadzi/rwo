<?php  

include 'components/connect.php';

session_start();

if(isset($_SESSION['unique_id'])){
   $unique_id = $_SESSION['unique_id'];
}else{
   $unique_id = '';
};
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | RegisterWifi.Online</title>

    <!-- css swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
  <?php include 'components/user_header.php'; ?>
    <!-- home section starts  -->

  <div class="home" id="home">
   
    <section class="center">

      <div class="swiper home-slider">

      <div class="swiper-wrapper">

      <div class="box swiper-slide">
          <img src="images/unifi02.jpg" alt="">
          <div class="flex">
          <h3>PAKEJ NGAM 2024 TERKINI</h3>
         <!-- <a href="#availability" class="btn">check availability</a> -->
      </div>
   </div>

   <div class="box swiper-slide">
      <img src="images/unifi01.jpg" alt="">
      <div class="flex">
         <h3>NGAM 2024</h3>
         <!-- <a href="#reservation" class="btn">make a reservation</a> -->
      </div>
   </div>

</div>

<div class="swiper-button-next"></div>
<div class="swiper-button-prev"></div>

</div>
      </section>

      </div>
 

    <!-- home section ends -->

    <!-- services section starts  -->

    <section class="about" id="about">
    <h1 class="heading">about</h1>
      <div class="row">
      <div class="image">
         <img src="images/unifi-izzuddin.jpg" alt="">
      </div>
      <div class="content">
         <h3>Mudah</h3>
         <p>Register Wifi Online Lebih mudah untuk menghantar borang pendaftaran unifi anda di sistem ini. Promosi Unifi 100Mbps hanya RM 89. Daftar Sekarang.</p>
         <a href="#" class="btn">submit form</a>
      </div>
   </div>

   <div class="row revers">
      <div class="image">
         <img src="images/tanpa-had.png" alt="">
      </div>
      <div class="content">
         <h3>Tanpa Had</h3>
         <p>Dimana sahaja...waktu jam berapa pun boleh melakukan "check coverage"</p>
         <a href="#" class="btn">check coverage</a>
      </div>
   </div>

   <div class="row">
      <div class="image">
         <img src="images/lengkap.png" alt="">
      </div>
      <div class="content">
         <h3>Lengkap</h3>
         <p>Sistem ini lengkap dengan status pendaftaran anda</p>
         <a href="#" class="btn">check my form</a>
      </div>
   </div>
    </section>

    <!-- services section ends -->

    <!-- gallery section starts  -->

<section class="gallery" id="gallery">
<h1 class="heading">gallery</h1>

<div class="swiper gallery-slider">
   <div class="swiper-wrapper">
      <img src="images/unifi02.jpg" class="swiper-slide" alt="">
      <img src="images/unifi01.jpg" class="swiper-slide" alt="">
      <img src="images/unifi-home-new-customer.jpg" class="swiper-slide" alt="">
      <img src="images/unifi-netflix-new-customer.jpg" class="swiper-slide" alt="">
      <img src="images/unifi-home.jpg" class="swiper-slide" alt="">
      <img src="images/unifi-netflix.jpg" class="swiper-slide" alt="">
   </div>
   <div class="swiper-pagination"></div>
</div>

</section>

<!-- gallery section ends -->

<!-- contact section starts  -->

<section class="contact" id="coverage">

   <div class="row">
<!-- 
      <form action="" method="post">
         <h3>check coverage</h3>
         <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="number" required maxlength="12" min="0" max="999999999999" placeholder="enter your number" class="box">
         <textarea name="message" class="box" required maxlength="1000" placeholder="enter your full address" cols="30" rows="10"></textarea>
         <input type="submit" value="send checking" name="send" class="btn">
      </form> -->

      <!-- <div class="faq">
         <h3 class="title">frequently asked questions</h3>
         <div class="box">
            <h3>how to cancel?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus sunt aspernatur excepturi eos! Quibusdam, sapiente.</p>
         </div>
         <div class="box">
            <h3>is there any vacancy?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
         </div>
         <div class="box">
            <h3>what are payment methods?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
         </div>
         <div class="box">
            <h3>how to claim coupons codes?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
         </div>
         <div class="box">
            <h3>what are the age requirements?</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa ipsam neque quaerat mollitia ratione? Soluta!</p>
         </div>
      </div> -->

   </div>

</section>

<!-- contact section ends -->

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <?php include 'components/footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <?php include 'components/message.php'; ?>

    <!-- <script>

   let range = document.querySelector("#range");
   range.oninput = () =>{
      document.querySelector('#output').innerHTML = range.value;
   }

</script> -->
  </body>
</html>
