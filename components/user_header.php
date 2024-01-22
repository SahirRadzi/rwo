<!-- header section starts  -->

<header class="header">

   <nav class="navbar nav-1">
      <section class="flex">
         <a href="index.php#home" class="logo"><i class="fas fa-wifi"></i>RegisterWifi.Online</a>

         <ul>
            <li><a href="#">submit form<i class="fas fa-paper-plane"></i></a></li>
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
                     <li><a href="dashboard.php">dashboard</a></li>
                     <li><a href="#">submit form</a></li>
                     <li><a href="#">my form</a></li>
                  </ul>
               </li>
               <li><a href="#">help<i class="fas fa-angle-down"></i></a>
                  <ul>
                     <li><a href="index.php#about">about</a></i></li>
                     <li><a href="index.php#gallery">gallery</a></i></li>
                     <li><a href="index.php#coverage">coverage</a></i></li>
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
                   <li><a href="update_profile.php"><?= $fetch_profile['nama'] ;?></a></li>
                  <?php 
                   }else{
                  ?>        
                  <li><a href="login.php">login now</a></li>
                  <?php } ?>
                  <?php if($unique_id != ''){ ?>
                  <li><a href="update_profile.php">update profile</a></li>
                  <li><a href="components/user_logout.php" onclick="return confirm('logout from this website?');">logout</a>
                  <?php } ?></li>
               </ul>
            </li>
         </ul>
      </section>
   </nav>

</header>

<!-- header section ends -->