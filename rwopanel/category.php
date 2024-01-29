<?php 

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_category'])){
    $code_category = $_POST['code_category'];
    $code_category = filter_var($code_category, FILTER_SANITIZE_STRING);
    $name_category = $_POST['name_category'];
    $name_category = filter_var($name_category, FILTER_SANITIZE_STRING);

    $select_category = $conn->prepare("SELECT * FROM `category` WHERE id = ?");
    $select_category->execute([$name_category]);

    if($select_category->rowCount() > 0){
        $message[] = 'category name already exists!';
    }else{
        $insert_category = $conn->prepare("INSERT INTO `category` (code_category, name_category) VALUES(?,?) ");
        $insert_category->execute([$code_category, $name_category]);

        $message[] = 'new category added!';
    }
}

if(isset($_GET['delete'])){
    $delete_code = $_GET['delete'];
    $delete_category = $conn->prepare("DELETE FROM `category` WHERE id = ?");
    $delete_category->execute([$delete_code]);
    header('location:category.php');
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

     <!-- Boxicons CSS -->
     <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />


   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-products">

   <form action="" method="POST">
      <h3>add category</h3>
      <input type="text" placeholder="enter category code" name="code_category" maxlength="5" class="box" required>
      <input type="text" placeholder="enter category name" name="name_category" maxlength="100" class="box" required>
      <input type="submit" value="add category" name="add_category" class="btn">
   </form>

</section>

<!-- add products section ends -->

<section class="accounts">

    <div class="box-container">

    
   <?php
      $result_category = $conn->prepare("SELECT * FROM `category`");
      $result_category->execute();
      if($result_category->rowCount() > 0){
         while($fetch_category = $result_category->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> code category : <span><?= $fetch_category['code_category']; ?></span> </p>
      <p> name category : <span><?= $fetch_category['name_category']; ?></span> </p>
      <div class="flex-btn">
         <a href="update_category.php?update=<?= $fetch_category['id']; ?>" class="option-btn">update</a>
         <a href="category.php?delete=<?= $fetch_category['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure, to delete <?= $fetch_category['name_category'];?> for this category?');">delete</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no category available</p>';
   }
   ?>


    </div>


</section>






<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>