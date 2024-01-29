<?php 

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){
    $nid = $_POST['nid'];
    $nid = filter_var($nid, FILTER_SANITIZE_STRING);
    $code_category = $_POST['code_category'];
    $code_category = filter_var($code_category, FILTER_SANITIZE_STRING);
    $name_category = $_POST['name_category'];
    $name_category = filter_var($name_category, FILTER_SANITIZE_STRING);


    if(!empty($code_category)){
        $select = $conn->prepare("SELECT * FROM `category` WHERE code_category = ?");
        $select->execute([$code_category]);
        if($select->rowCount() > 0){
            $message[] = 'code category already taken!';
        }else{
            $update = $conn->prepare("UPDATE `category` SET code_category = ?,  name_category = ? WHERE id = ?");
            $update->execute([$code_category, $name_category, $nid]);
            $message[] = 'category updated successfully!';
        }
    }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Category | RWO Panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin update category section starts  -->

<section class="form-container">

    

   <?php 
      $update_code = $_GET['update'];
      $show_code = $conn->prepare("SELECT * FROM `category` WHERE id = ?");
      $show_code->execute([$update_code]);
      if($show_code->rowCount() > 0){
        while($fetch_category = $show_code->fetch(PDO::FETCH_ASSOC)){
      ?>
      
      <form action="" method="POST">
      <h3>update category</h3>
      <input type="hidden" name="nid" value="<?= $fetch_category['id'];?>">
      <input type="text" name="code_category" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="<?= $fetch_category['code_category']; ?>">
      <input type="text" name="name_category" maxlength="30" class="box" placeholder="<?= $fetch_category['name_category']; ?>">
      <?php 
            }
        }
      ?>
      <input type="submit" value="update now" name="update" class="btn">
      <a href="category.php" class="option-btn">go back</a>
   </form>
</section>

<!-- admin update category section ends -->









<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>