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


    <title>Lieux</title>
</head>

<body>
    <header>
        <h3>Formulaire Lieux</h3>
    </header>
    <hr>
    <main>
        <form action="FormulaireLieux.php" method="post">
            <div class="form-group">
                <label for="nom">nom </label>
                <input class="form-control" name="nom" type="text" maxlength="64" placeholder="Entrez votre nom">
            </div>
            <div class="form-group">
                <label for="comment">commentaire </label>
                <textarea class="form-control" name="comment" id="commentaire" rows="3" placeholder="Ecrivez un commentaire"></textarea>

            </div>
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

        $id=$_SESSION['lieux_id'];
        $name = $_POST["nom"];
        $comment = $_POST["comment"];

        $database->insert("lieux", [
            "id" => $id,
            "nom" => $name,
            "commentaire" => $comment
        ]);
        //Changing the id
        $_SESSION['lieux_id']=$id+1;
    }
    ?>

</body>

</html>