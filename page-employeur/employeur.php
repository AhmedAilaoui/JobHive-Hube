<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "jobhive_hub";

    $connection = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $titre = $_POST['titre'];
    $domaine = $_POST['domaine'];
    $adresse = $_POST['adresse'];
    $nom_du_société = $_POST['name'];
    $salaire = $_POST['salaire'];
    $contrat = $_POST['contrat'];
    $description = $_POST['description'];
    $sql = "INSERT INTO emploie (titre,nom_du_société, description, adresse, domaine, salaire, contrat) VALUES ('$titre','$nom_du_société', '$description', '$adresse', '$domaine', '$salaire','$contrat')";

    if (mysqli_query($connection, $sql)) {
        header("Location: ../page-employeur/employeurr.php");
        exit();
    } else {
        echo "Error registering user: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>