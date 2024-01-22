<?php

include '../components/connect.php';

session_start();

$unique_id = $_SESSION['unique_id'];

if(!isset($unique_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All List | RWO Panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">


    <!-- Data Tables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">



    <style>
        .navbar{
            position: fixed !important;
            top: 0 !important;
            width: 100% !important;
            left: 0 !important;
            background-color: var(--white-color) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 15px 30px !important;
            z-index: 1000 !important;
            box-shadow: 0 0 2px var(--grey-color-light) !important;
        }

        .heading{
            text-align: center !important;
            margin-bottom: 2rem !important;
            text-transform: capitalize !important;
            color: var(--black) !important;
            font-size: 3rem !important;
        }

        h1.heading{
            font-weight: bold !important;
        }


        table{
            font-size: 1.5rem !important;
        }

        .pagination{
            --bs-pagination-font-size : 1.5rem !important;
        
        }

        .dataTables_info{
            font-size: 1.5rem !important;
            color: var(--black) !important;
        }

        label, select , input{
            font-size: 1.5rem !important;
            color: var(--grey-color-light) !important;

        }

        .delete-btn,
        .option-btn{
            
            text-decoration: none !important;
            display: block !important;
        }

        .btn{
            display: block;
            margin-top: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            width: 100%;
            font-size: 1.8rem;
            color: var(--white) !important;
            padding: 1.2rem;
            text-transform: capitalize;
            text-align: center;
            background-color: var(--orange) !important;
        }

        .btn:hover{
            background-color: var(--black) !important;
        }
    </style>

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="placed-orders">

<h1 class="heading">all list</h1>

</br>
</br>
<div class="col-md">

    <table id="example" class="table table-striped nowrap" style="width:100%">

    <!-- <thead>
            <tr class="table-primary">
                <th>#</th>
                <th width="10%">Email</th>
                <th width="50%">Nama</th>
                <th width="10%">Phone No</th>
                <th width="10%">No K/P</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>

        </tbody> -->

     </table>

</div>

    <div class="row-md">
       <a href="add_list.php" class="btn btn-primary btn-lg">Add List</a>
        <!-- <button type="button" class="btn btn-success btn-lg">Import Excell</button> -->
    </div>


    <div class="col-3"></div>


</section>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "ajax":{
                "url":"data_list.php",
                "dataSrc":""
            },
            "columns":[
                {"title":"ID","data":"id"},
                {"title":"USER ID","data":"user_id"},
                {"title":"TARIKH","data":"tarikh"},
                {"title":"NAMA","data":"nama"},
                {"title":"EMAIL","data":"email"},
                {"title":"PHONE NO","data":"phoneno"}

            ],

        });
    });

</script> -->


<!-- Data Tables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
<script src="../js/admin_table_script.js"></script>
    
</body>
</html>