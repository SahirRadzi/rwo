<?php 

include 'components/connect.php';

session_start();

if(isset($_SESSION['unique_id'])){
    $unique_id = $_SESSION['unique_id'];
}else{
    $unique_id = '';
    header('location:index');
};

 if(isset($_POST['verify'])){

    $opt1 = $_POST['otp1'];
    $opt2 = $_POST['otp2'];
    $opt3 = $_POST['otp3'];
    $opt4 = $_POST['otp4'];
    $session_otp = $_SESSION['otp'];
    $otp = $opt1.$opt2.$opt3.$opt4;
    
    
    if(!empty($otp)){
        if($otp == $session_otp){
            $sql = $conn->prepare("SELECT * FROM `user` WHERE unique_id = ? AND otp = ?");
            $sql->execute([$unique_id, $otp]);
            if($sql->rowCount() > 0){ // if user id and session otp match
                $null_otp = 0;  //so send the otp value 0 it's mean verified user 
                $verified = "verified";
                $sql2 = $conn->prepare("UPDATE `user` SET verification_status = ? , otp = ? WHERE unique_id = ?");
                $sql2->execute([$verified, $null_otp, $unique_id]);
                if($sql2){
                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                    if($row){
                        $_SESSION['unique_id'] = $row['unique_id'];
                        $_SESSION['verification_status'] = $row['verification_status'];
                
                        $success_msg[] = "success!";
                        header('location:index');
                    }
                }
            }
    
        }
        else{
            $warning_msg[] = "wrong Otp!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify | RegisterWifi.Online</title>

       <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/verify.css">
        <link rel="stylesheet" href="css/style.css">
</head>
<body>

   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->



        
<section class="form-container">

<form action="" method="post" autocomplete="off">
   <h3>verify your account</h3>
   <p>We emailed you the four digit OTP code. Enter the code below to confirm your email address.</p>
       <?php 
            $check_v = $conn->prepare("SELECT * FROM `user` WHERE unique_id = ?");
            $check_v->execute([$unique_id]);
            $row = $check_v->fetch(PDO::FETCH_ASSOC);
        ?>
   <p><span style="color:black"><?php if($row['verification_status'] == 'verified') {echo 'Thank you, successfull verified';} else {echo 'Please verified your account now';};?></span></p>
   <div class="fields-input">
        <input type="number" name="otp1" class="otp_field" placeholder="0" min="0" max="9" required onpaste="false">
        <input type="number" name="otp2" class="otp_field" placeholder="0" min="0" max="9" required onpaste="false">
        <input type="number" name="otp3" class="otp_field" placeholder="0" min="0" max="9" required onpaste="false">
        <input type="number" name="otp4" class="otp_field" placeholder="0" min="0" max="9" required onpaste="false">
    </div>
   <input type="submit" value="verify now" name="verify" class="btn <?php if($row['verification_status'] == 'verified') {echo 'disabled';};?>">
</form>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<?php include 'components/message.php'; ?>

<!-- custom js file -->
<script src="js/verify.js"></script>

</body>
</html>
