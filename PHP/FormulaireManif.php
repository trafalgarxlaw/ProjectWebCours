<?php
require  'Database.php';
//starting the session
session_start();

//Select Table lieux
$data_lieux = $database->select("lieux", "*");
//select Tables membres
$data_membres = $database->select("membres", "*");
print_r($data_lieux) ;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- jsTree -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <!-- My Css -->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Css/MyStyleTP2.css" />


    <title>Manif</title>
</head>

<body>
    <header>
        <h3>Formulaire Manifestation</h3>
    </header>
    <hr>
    <main>
        <form action="FormulaireManif.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="lieux">Lieux de la manifestation </label> <br>
                <select name="lieux" class="form-control">
                <?php
                 //printing the table lieux
                foreach ($data_lieux as $Array => $innerArray) {
                    foreach ($innerArray as $element => $value) {
                        if($element=="id"){
                            echo '<option value="' . $value . '">';
                        }
                        if($element=="nom"){
                            echo $value . '</option>';
                        }
                    }
                }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="membre">Membre </label> <br>
                <select name="membre" class="form-control">
                <?php
                //printing the table membres
                foreach ($data_membres as $Array => $innerArray) {
                    foreach ($innerArray as $element => $value) {
                        if($element=="id"){
                            echo '<option value="' . $value . '">';
                        }
                        if($element=="prenom"){
                            echo  $value . '</option>';
                        }
                    }
                }
                ?>
                </select>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date de la manifestation </label>
                <input type="date" name="date">
            </div>



            <hr>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>




    </main>

    <footer>

    </footer>


    <?php

    //verify connection
    if (mysqli_connect_errno()) {
        # code...
        echo 'Connection to MySQL failed.' . mysqli_connect_errno();
    } else {
        echo 'Connection established.';
    }

    if (isset($_POST["submit"])) {
        # code...
        echo 'Submitted';

        //Variables
        $lieux_manif=$_POST["lieux"];
        $membre=$_POST["membre"];
        $date_manif = $_POST["date"];


        //insertion
        $id=$_SESSION['manif_id'];
      
        $database->insert("manifestations", [
            "id" => $id,
            "lieux" => $lieux_manif,
            "membre" => $membre,
            "date" => $date_manif
        ]);
        //Changing the id
        $_SESSION['manif_id']=$id+1;

    }
    ?>

</body>

</html>