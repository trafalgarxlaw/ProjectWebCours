<?php
//starting the session
session_start();
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


    <title>Membres</title>
</head>

<body>
    <header>
        <h3>Formulaire Membres</h3>
    </header>
    <hr>
    <main>
        <form action="FormulaireMembres.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="prenom">prenom </label>
                <input class="form-control" name="prenom" type="text" required maxlength="25" placeholder="Entrez votre prenom">
            </div>

            <div class="form-group">
                <label for="nom">nom </label>
                <input class="form-control" name="nom" type="text" required maxlength="25" placeholder="Entrez votre nom">
            </div>

            <div class="form-group">
                <label for="bday">Date de naissance </label>
                <input type="date" name="bday">
            </div>

            <div class="form-group">
                <label for="myFile">Photo </label> <br>
                <input type="file" name="myFile" accept="image/*"><br><br>
            </div>

            <div class="form-group">
                <label for="fonction">Fonction </label> <br>
                <select name="fonction" class="form-control">
                    <option>CADRE</option>
                    <option>DELEGUE</option>
                    <option>MEMBRE</option>
                </select>
            </div>
            <hr>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>




    </main>

    <footer>

    </footer>


    <?php
    require  'Database.php';

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

        $First_name = $_POST["prenom"];
        $Last_name = $_POST["nom"];
        $Birth_Day = $_POST["bday"];
        $Fonction = $_POST["fonction"];

        //Stores the filename as it was on the client computer.
        $imagename = $_FILES["myFile"]["name"];
        //Stores the filetype e.g image/jpeg
        $imagetype = $_FILES["myFile"]["type"];
        //Stores any error codes from the upload.
        $imageerror = $_FILES["myFile"]["error"];
        //Stores the tempname as it is given by the host when uploaded.
        $imagetemp = $_FILES["myFile"]["tmp_name"];
        //The path you wish to upload the image to
        $imagePath = "../UploadedImages/";
        // The image Directory
        $imageDirectory = $imagePath . $imagename;


        if (is_uploaded_file($imagetemp)) {
            if (move_uploaded_file($imagetemp, $imagePath . $imagename)) {
                echo "Sussecfully uploaded your image in " . $imageDirectory;
            } else {
                echo "Failed to move your image.";
            }
        } else {
            echo "Failed to upload your image.";
        }

        $id=$_SESSION['membres_id'];
      
        $database->insert("membres", [
            "id" => $id,
            "prenom" => $Last_name,
            "nom" => $First_name,
            "datenaissance" => $Birth_Day,
            "photo" => $imageDirectory,
            "fonction" => $Fonction
        ]);
        //Changing the id
        $_SESSION['membres_id']=$id+1;

    }
    ?>

</body>

</html>