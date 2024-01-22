<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Form | RegisterWifi.Online</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="my-listings">

   <h1 class="heading">my forms</h1>

   <div class="box-container">

  
   <form accept="" method="POST" class="box">
      <input type="hidden" name="property_id" value="">
      <div class="thumb">
         <p><i class="far fa-image"></i><span>2</span></p> 
         <img src="" alt="">
      </div>
      <div class="price"><b>RM <span>RM 89 </span></b></div>
      <h3 class="name">BBSAP</h3>
      <p class="location"><i class="fas fa-map-marker-alt"></i><span>ALAMAT PENUH</span></p>
      <div class="flex-btn">
         <a href="update_property?get_id=<?= $property_id; ?>" class="btn">update</a>
      </div>
     
   </form>
   

   </div>

</section>








<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

</body>
</html>