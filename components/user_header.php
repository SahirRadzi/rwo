<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- header section starts  -->

<header class="header">

   <nav class="navbar nav-1">
      <section class="flex">
         <a href="index#home" class="logo"><i class="fas fa-wifi"></i>RegisterWifi.Online</a>

         <ul>
            <li><a href="submit_form">submit form<i class="fas fa-paper-plane"></i></a></li>
         </ul>
      </section>
   </nav>

   <nav class="navbar nav-2">
      <section class="flex">
         <div id="menu-btn" class="fas fa-bars"></div>

         <div class="menu">
            <ul>
               <li><a href="#">my form<i class="fas fa-angle-down"></i></a>
                  <ul>
                     <li><a href="dashboard">dashboard</a></li>
                     <li><a href="submit_form">submit form</a></li>
                     <li><a href="my_form">my form</a></li>
                  </ul>
               </li>
               <li><a href="#">help<i class="fas fa-angle-down"></i></a>
                  <ul>
                     <li><a href="index#about">about</a></i></li>
                     <li><a href="index#gallery">gallery</a></i></li>
                     <li><a href="index#coverage">coverage</a></i></li>
                  </ul>
               </li>
            </ul>
         </div>

         <ul>
            <li><a href="#">account <i class="fas fa-angle-down"></i></a>
               <ul>
                  <?php
                  $select_profile = $conn->prepare("SELECT * FROM `user` WHERE unique_id = ?");
                  $select_profile->execute([$unique_id]);
                  if($select_profile->rowCount() > 0 ){
                     $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                  ?>
                   <li><a href="update_profile"><?= $fetch_profile['nama'] ;?></a></li>
                  <?php 
                   }else{
                  ?>        
                  <li><a href="login">login now</a></li>
                  <?php } ?>
                  <?php if($unique_id != ''){ ?>
                  <li><a href="update_profile">update profile</a></li>
                  <li><a href="components/user_logout" onclick="return confirm('logout from this website?');">logout</a>
                  <?php } ?></li>
               </ul>
            </li>
         </ul>
      </section>
   </nav>

</header>

<!-- header section ends -->