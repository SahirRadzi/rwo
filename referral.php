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
   <title>Referral Setting | RegisterWifi.Online</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
/* start: Table */
.table-wrapper {
  height: auto;
  overflow: auto;
  position: relative;
}
table {
  border-collapse: collapse;
  width: 100%;
  min-width: 400px;
}
thead {
  background-color: #222;
  color: #fff;
  position: sticky;
  top: 0;
}
td,
th {
  padding: 8px 16px;
  text-align: left;
}
th {
  text-transform: uppercase;
}
td {
  font-weight: 600;
  background-color: #fff;
  border-bottom: 1px solid #ddd;
}
tr:hover td {
  background-color: #f9f9f9;
}

@media screen and (max-width: 576px) {
  table{
    min-width: 200px;
  }
}
/* end: Table */

   </style>

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="form-container">

    <?php
         $select_referral = $conn->prepare("SELECT * FROM `user` WHERE unique_id = ? LIMIT 1");
         $select_referral->execute([$unique_id]);
         $fetch_referral = $select_referral->fetch(PDO::FETCH_ASSOC);
          $myreferral = $fetch_referral['referral_code'];
         
    ?>
    

   <form action="" method="post">
      <h3>Referral Setting!</h3>
      <label> Your Referral Code :</label>
        <input type="text" name="referralcode" maxlength="50" placeholder="<?=$fetch_referral['referral_code'];?>" class="box" readonly>
      <label> Your Referral Points :</label>
        <input type="email" name="email" maxlength="50" placeholder="<?=$fetch_referral['referral_point'];?>" class="box" readonly>
      <label> Your Referral Url :</label>
        <input type="text" name="number" min="0" max="9999999999" maxlength="11" id="myInput" value="http://127.0.0.1:8080/registerwifi/register?ref=<?= $fetch_referral['referral_code'];?>" class="box">
      <input type="submit" value="copy" name="submit" onclick="copy('myInput')" class="btn">
   </form>
</section>

<section class="form-container" style="padding-top: 0;">
  <form action="">
    <?php
    $total_prsonRefer = 0; 
    $count_personRefer = $conn->prepare("SELECT * FROM `user` WHERE refer_code = ?");
    $count_personRefer->execute([$myreferral]);
      $total_prsonRefer = $count_personRefer->rowCount();
    
    ?>
    <h3><?= $total_prsonRefer;?> Person Refer You!</h3>
    <table id="myTable" class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>H/p</th>
      </tr>
    </thead>
    <tbody>
      <?php 

      $no = 1;
      $select_personRefer = $conn->prepare("SELECT * FROM `user` WHERE refer_code = ?");
      $select_personRefer->execute([$myreferral]);
      if($select_personRefer->rowCount() > 0){
          $referral_list = $select_personRefer->fetch(PDO::FETCH_ASSOC)

      ?>
      <tr>
        <td><?=$no;?></td>
        <td><?=$referral_list['nama'];?></td>
        <td><?=$referral_list['number'];?></td>

        <?php 
              $no++;
              }
            else{
              ?>
              <tr>
                    <td colspan="3" style="text-align: center;">No Record Found</td>
              </tr>
              <?php
            } 
          
         ?>
      </tr>
    </tbody>

    </table>
   </form>

</section>


    <script>
        let copy = (textId) => {
            //Selects the text in the <input> element
            document.getElementById(textId).select();
            //Copies the selected text to clipboard
            document.execCommand("copy");
        };

    </script>








<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>
</body>
</html>