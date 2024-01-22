<?php

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

    $unique_id = $_SESSION['unique_id'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $phoneno = $_POST['phoneno'];
    $phonenoTambahan = $_POST['phonenoTambahan'];
    $nokp = $_POST['nokp'];
    $alamatPemasangan = $_POST['alamatPemasangan'];
    $alamatBill = $_POST['alamatBill'];
    $pakej = $_POST['pakej'];
    $tarikhWaktu = $_POST['tarikhWaktu'];

    $imgBill = $_FILES['imgBill']['name'];
    $imgBill = filter_var($imgBill, FILTER_SANITIZE_STRING);
    $imgBill_ext = pathinfo($imgBill, PATHINFO_EXTENSION);
    $rename_imgBill = create_unique_id().'.'.$imgBill_ext;
    $imageBill_tmp_name = $_FILES['imgBill']['tmp_name'];
    $imageBill_size = $_FILES['imgBill']['size'];
    $imageBill_folder = '../uploaded_bill/'.$rename_imgBill;
  
    if(!empty($imgBill)){
      if($imageBill_size > 2000000){
        $message[] = 'Size Gambar Bill terlalu besar!';
      }else{
        move_uploaded_file($imageBill_tmp_name, $imageBill_folder);
      }
    }else{
      $rename_imgBill = '';
    }
  
    $imgKpD = $_FILES['imgKpD']['name'];
    $imgKpD = filter_var($imgKpD, FILTER_SANITIZE_STRING);
    $imgKpD_ext = pathinfo($imgKpD, PATHINFO_EXTENSION);
    $rename_imgKpD = create_unique_id().'.'.$imgKpD_ext;
    $imageKpD_tmp_name = $_FILES['imgKpD']['tmp_name'];
    $imageKpD_size = $_FILES['imgKpD']['size'];
    $imageKpD_folder = '../uploaded_kpd/'.$rename_imgKpD;
  
    if(!empty($imgKpD)){
      if($imageKpD_size > 2000000){
        $message[] = 'Front Side of IC size is too large!';
      }else{
        move_uploaded_file($imageKpD_tmp_name, $imageKpD_folder);
      }
    }else{
      $rename_imgKpD = '';
    }
  
  
    $imgKpB = $_FILES['imgKpB']['name'];
    $imgKpB = filter_var($imgKpB, FILTER_SANITIZE_STRING);
    $imgKpB_ext = pathinfo($imgKpB, PATHINFO_EXTENSION);
    $rename_imgKpB = create_unique_id().'.'.$imgKpB_ext;
    $imageKpB_tmp_name = $_FILES['imgKpB']['tmp_name'];
    $imageKpB_size = $_FILES['imgKpB']['size'];
    $imageKpB_folder = '../uploaded_kpb/'.$rename_imgKpB;
  
      if(!empty($imgKpB)){
        if($imageKpB_size > 2000000){
         $message[] = 'Back Side of IC size is too large!';
      }else{
        move_uploaded_file($imageKpB_tmp_name, $imageKpB_folder);
      }
    }else{
        $rename_imgKpB = '';
      }

      $folderPath_c = "../uploaded_sign_c/";
      $image_parts_c = explode(";base64,", $_POST['sign-c']);
      $image_type_aux_c = explode("image/", $image_parts_c[0]);
    
      $image_type_c = $image_type_aux_c[1];
    
      $image_base64_c = base64_decode($image_parts_c[1]);
      $file_c = $folderPath_c . $nokp ."-". create_unique_id() . '.' . $image_type_c;
    
        file_put_contents($file_c, $image_base64_c);
        $insert_stmt = $conn->prepare("INSERT INTO orders_list
                                        (unique_id, email, nama, phoneno, phonenoTambahan, nokp, alamatPemasangan, alamatBill, pakej, tarikhWaktu, imgBill, imgKpD, imgKpB, signa_c)
                                         VALUES (:unique_id, :email, :nama, :phoneno, :phonenoTambahan, :nokp, :alamatPemasangan, :alamatBill, :pakej, :tarikhWaktu, :imgBill, :imgKpD, :imgKpB, :signa_c)");

        $insert_stmt->bindParam(':unique_id', $unique_id, PDO::PARAM_STR);
        $insert_stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $insert_stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
        $insert_stmt->bindParam(':phoneno', $phoneno, PDO::PARAM_STR);
        $insert_stmt->bindParam(':phonenoTambahan', $phonenoTambahan, PDO::PARAM_STR);
        $insert_stmt->bindParam(':nokp', $nokp, PDO::PARAM_STR);
        $insert_stmt->bindParam(':alamatPemasangan', $alamatPemasangan, PDO::PARAM_STR);
        $insert_stmt->bindParam(':alamatBill', $alamatBill, PDO::PARAM_STR);
        $insert_stmt->bindParam(':pakej', $pakej, PDO::PARAM_STR);
        $insert_stmt->bindParam(':tarikhWaktu', $tarikhWaktu, PDO::PARAM_STR);
        $insert_stmt->bindParam(':imgBill', $rename_imgBill, PDO::PARAM_STR);
        $insert_stmt->bindParam(':imgKpD', $rename_imgKpD, PDO::PARAM_STR);
        $insert_stmt->bindParam(':imgKpB', $rename_imgKpB, PDO::PARAM_STR);
        $insert_stmt->bindParam(':signa_c', $file_c, PDO::PARAM_STR);

        $result = $insert_stmt->execute();
        header('location:dashboard.php');
        $message[] = 'new add list added!';
  
   }

?>