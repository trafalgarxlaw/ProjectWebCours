<?php
require  'Database.php';

//starting the session
session_start();

//selection in Database
$data_manifestant = $database->select("manifestations", "*");
$data_lieux = $database->select("lieux", "*");
$data_membres = $database->select("membres", "*");

$Manifestants_JSON = json_encode($data_manifestant);
$Lieux_JSON = json_encode($data_lieux);
$Membres_JSON = json_encode($data_membres);

?>

<script>
    var ManifData = <?php echo $Manifestants_JSON ?>;
    var LieuxData = <?php echo $Lieux_JSON ?>;
    var MembresData = <?php echo $Membres_JSON ?>;
</script>



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

    <!-- My JS -->
    <script type="text/javascript" src="../JS/DataTables.js"></script>



    <title>Data Tables<</title> </head> <body>
            <header>
                <h3>Data Tables</h3>
            </header>
            <hr>
            <main>
                <h3>Voici un résumé provenant de notre base de donnée.</h3>
                <hr>
                <table id="mytable">
                    <thead>
                        <th>nom</th>
                        <th>prenom</th>
                        <th>lieu</th>
                        <th>date</th>
                    </thead>

                    <tbody>

                    </tbody>

                </table>
                <script>
                    $(document).ready(function() {
                        var TheTable = $('#mytable').DataTable();

                    });
                </script>


            </main>

            <footer>

            </footer>



            </body>

</html>