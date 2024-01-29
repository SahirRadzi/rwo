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

<!-- navbar -->

  <section class="header">
    <nav class="navbar">
      <div class="logo_item">
        <i class="bx bx-menu" id="sidebarOpen"></i>
        <img src="../img/registerwifi-icon.png" alt=""></i>RWO Panel
      </div>

      <!-- <div class="search_bar">
        <input type="text" placeholder="Search" />
      </div> -->

      <div class="navbar_content">
        <i class="bi bi-grid"></i>
        <i class='bx bx-sun' id="darkLight"></i>
        <i class='bx bxs-user' id="user-btn"></i>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE unique_id = ?");
            $select_profile->execute([$unique_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['nama']; ?></p>
         <a href="update_profile.php" class="btn">update profile</a>
         <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
      </div>



    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
      <div class="menu_content">
        <ul class="menu_items">
          <div class="menu_title menu_dahsboard"></div>
          <!-- duplicate or remove this li tag if you want to add or remove navlink with submenu -->
          <!-- start -->

          <!-- Home Menu - start -->
          <li class="item">
            <a href="dashboard.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-home-alt"></i>
              </span>
              <span class="navlink">Home</span>
            </a>
          </li>
          <!-- Home Menu - end -->

           <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
          <!-- start -->
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bx-list-ol'></i>
              </span>
              <span class="navlink">New Orders</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="placed_orders.php" class="nav_link sublink">All List</a>
              <a href="add_list.php" class="nav_link sublink">Add List</a>
              <a href="update_status_new.php" class="nav_link sublink">Update Status (N)</a>
              <a href="update_status_proceed.php" class="nav_link sublink">Update Status (P)</a>
              <a href="update_status_cancel.php" class="nav_link sublink">Update Status (C)</a>
            </ul>
          </li>
          <!-- end -->

           <!-- duplicate this li tag if you want to add or remove  navlink with submenu -->
          <!-- start -->
          <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bx-list-ol'></i>
              </span>
              <span class="navlink">New Demand</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="demand_orders.php" class="nav_link sublink">All Demands</a>
              <a href="add_demands.php" class="nav_link sublink">Add Demands</a>
              <a href="#" class="nav_link sublink">Update Status (N)</a>
              <a href="#" class="nav_link sublink">Update Status (P)</a>
              <a href="#" class="nav_link sublink">Update Status (C)</a>
            </ul>
          </li>
          <!-- end -->

          <!-- Messages Menu - start -->
          <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class='bx bxs-chat'></i>
              </span>
              <span class="navlink">Messages</span>
            </a>
          </li>
          <!-- Messages Menu - end -->

        </ul>

        <ul class="menu_items">
          <div class="menu_title menu_editor"></div>
          <!-- duplicate these li tag if you want to add or remove navlink only -->
          <!-- Start -->
          <li class="item">
            <a href="add_list.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bxs-magic-wand"></i>
              </span>
              <span class="navlink">Add List</span>
            </a>
          </li>
          <!-- End -->

          <li class="item">
            <a href="add_demands.php" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-loader-circle"></i>
              </span>
              <span class="navlink">Add Demands</span>
            </a>
          </li>
          <!-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
              <i class='bx bx-desktop'></i>
              </span>
              <span class="navlink">Display orders</span>
            </a>
          </li> -->
          <!-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-cloud-upload"></i>
              </span>
              <span class="navlink">Upload Ads</span>
            </a>
          </li> -->
        </ul>
        <ul class="menu_items">
          <div class="menu_title menu_setting"></div>
          <!-- <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-flag"></i>
              </span>
              <span class="navlink">Notice board</span>
            </a>
          </li>
          <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-medal"></i>
              </span>
              <span class="navlink">Award</span>
            </a>
          </li> -->
    
             <!-- Products Menu - Start -->
             <li class="item">
            <div href="#" class="nav_link submenu_item">
              <span class="navlink_icon">
                <i class='bx bx-cog'></i>
              </span>
              <span class="navlink">Setting</span>
              <i class="bx bx-chevron-right arrow-left"></i>
            </div>

            <ul class="menu_items submenu">
              <a href="category.php" class="nav_link sublink">Add Category</a>
              <a href="products.php" class="nav_link sublink">Add Products</a>
            </ul>
          </li>
          <!-- Products Menu - end -->

          <li class="item">
            <a href="#" class="nav_link">
              <span class="navlink_icon">
                <i class="bx bx-layer"></i>
              </span>
              <span class="navlink">Features</span>
            </a>
          </li>
        </ul>

        <!-- Sidebar Open / Close -->
        <div class="bottom_content">
          <div class="bottom expand_sidebar">
            <span> Expand</span>
            <i class='bx bx-log-in' ></i>
          </div>
          <div class="bottom collapse_sidebar">
            <span> Collapse</span>
            <i class='bx bx-log-out'></i>
          </div>
        </div>
      </div>

    </nav>

    </section>