<?php
include("connexion.php");
session_start();

// Vérifie si le formulaire de postulation a été soumis
if (isset($_POST['submit'])) {
  // Récupère les données du formulaire
  $id_user = $_SESSION['id_user'];
  $id_emploie = $_POST['id_emploie'];
  $date = date('Y-m-d H:i:s');

  // Vérifie que les variables ne sont pas vides
  if (!empty($id_user) && !empty($id_emploie)) {
    // Vérifie que la table `application` existe
    $sql = "SHOW TABLES LIKE 'application'";
    $result = mysqli_query($connection, $sql);
    $table_exists = mysqli_num_rows($result) > 0;

    if ($table_exists) {
      // Vérifie que la requête SQL est correcte
      $sql = "INSERT INTO application (id_user, id_emploie, date) VALUES ($id_user, $id_emploie, '$date')";
      // Exécute la requête SQL
      $result = mysqli_query($connection, $sql);

      // Vérifie si la requête a réussi
      if ($result) {
        // Redirige l'utilisateur vers la même page pour rafraîchir
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
      } else {
        // Affiche un message d'erreur
        echo 'Erreur : ' . mysqli_error($connection);
      }
    } else {
      // Affiche un message d'erreur si la table `application` n'existe pas
      echo 'Erreur : la table `application` n\'existe pas.';
    }
  } else {
    // Affiche un message d'erreur si les variables sont vides
    echo 'Erreur : les variables sont vides.';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="home1.css">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="icon" type="img" href="./images/logo.png">
</head>

<body>
  <header>
    <article class="logo">
      <img src="./images/logo1.png" alt="logo">
      <h1>JOBHIVE HUB</h1>
    </article>
    <ul class="navbar">
      <li><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Find Job</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
    <?php
    $idU = $_SESSION['id_user'];
    $sql = "SELECT * FROM user WHERE id_user=$idU";
    $result1 = mysqli_query($connection, $sql);


    while ($row = mysqli_fetch_assoc($result1)) {

      ?>
      <article class="user">

        <h1 class="nom_user">
          <?php echo $row['nom_et_prenom']; ?>
        </h1>
        <p class="role_user">
          <?php echo $row['role']; ?>
        </p>
      </article>
    <?php } ?>
    <form action="logout.php" method="POST">
      <button class="Btn">

        <div class="sign"><svg viewBox="0 0 512 512">
            <path
              d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
            </path>
          </svg></div>

        <div class="text">Logout</div>
      </button>
    </form>
  </header>
  <section class="section1">
    <form action="" method="POST">
      <h1 class="slegon">jobhivehub.tn, votre plateforme <br>emploi poste en Tunisie</h1>
      <article class="search">
        <i class='bx bx-search'></i>
        <input type="text" name="search" id="search" placeholder="Search">
      </article>
      <article class="recherch">
        <button type="submit" class="btn1">Recherche</button>
      </article>
    </form>
  </section>
  <section class="section2">
    <h3 class="h3">Les emploi disponibles à la une</h3>
  </section>


  <?php
  $sql = "SELECT * FROM emploie ORDER BY id_emploie DESC ";
  $result = mysqli_query($connection, $sql);


  while ($row = mysqli_fetch_assoc($result)) {

    ?>
    <section class="section3">
      <article class="article1">
        <div class="div2">
          <a href="#" class="link">
            <?php echo $row['titre']; ?>
          </a>
          <div class="div1">
            <p class="socite"><i class='bx bxs-school'></i>
              <?php echo $row['nom_du_société']; ?>
            </p>
            <p class="location"><i class="ri-map-pin-line"></i>
              <?php echo $row['adresse']; ?>
            </p>
          </div>
          <p class="description">
            <?php echo $row['description']; ?>
          </p>
          <form action="" method="POST">
            <input type="hidden" name="id_emploie" value="<?php echo $row['id_emploie']; ?>">
            <button type="submit" name="submit">Postuler</button>
          </form>
          <?php if (isset($_POST['submit'])) {
            // Récupère les données du formulaire
            $id_user = $_SESSION['id_user'];
            $id_emploie = $_POST['id_emploie'];
            $date = date('Y-m-d H:i:s');

            // Vérifie que les variables ne sont pas vides
            if (!empty($id_user) && !empty($id_emploie)) {
              // Vérifie que la table `application` existe
              $sql = "SHOW TABLES LIKE 'application'";
              $result = mysqli_query($connection, $sql);
              $table_exists = mysqli_num_rows($result) > 0;

              if ($table_exists) {
                // Vérifie que la requête SQL est correcte
                $sql = "INSERT INTO application (id_user, id_emploie, date) VALUES ($id_user, $id_emploie, '$date')";
                echo 'Requête SQL : ' . $sql . '<br>';

                // Exécute la requête SQL
                $result = mysqli_query($connection, $sql);

                // Vérifie si la requête a réussi
                if ($result) {
                  // Affiche un message de remerciement
                  echo "Votre candidature a bien été soumise.";
                } else {
                  // Affiche un message d'erreur
                  echo 'Erreur : ' . mysqli_error($connection);
                }
              } else {
                // Affiche un message d'erreur si la table `application` n'existe pas
                echo 'Erreur : la table `application` n\'existe pas.';
              }
            } else {
              // Affiche un message d'erreur si les variables sont vides
              echo 'Erreur : les variables sont vides.';
            }
          }

          // Ferme la connexion à la base de données
        
          ?>
        </div>
      </article>
    </section>
    <?php

  }
  mysqli_close($connection);
  ?>

  <!--<section class="section4">
    <article class="article1">
      <img src="./images/image2.png" alt="socite" srcset="">
      <div class="div2">
        <a href="#" class="link">Développeur Web .Net/.Net Core Expérimenté</a>
        <div class="div1">
          <p class="socite"><i class='bx bxs-school'></i>NAKI SERVICES</p>
          <p class="location"><i class="ri-map-pin-line"></i>Tunis,Marsa,tunis</p>
        </div>
        <p class="description">Développeur Web .Net/.Net Core Expérimenté</p>
      </div>
    </article>
  </section>
  <section class="section5">
    <article class="article1">
      <img src="./images/image3.png" alt="socite" srcset="">
      <div class="div2">
        <a href="#" class="link">Comptable Senior (Comptabilité Française)</a>
        <div class="div1">
          <p class="socite"><i class='bx bxs-school'></i>NAKI SERVICES</p>
          <p class="location"><i class="ri-map-pin-line"></i>Tunis, lac2 ,tunis</p>
        </div>
        <p class="description">Comptable Senior (Comptabilité Française)</p>
      </div>
    </article>
  </section>
  <section class="section6">
    <article class="article1">
      <img src="./images/image4.png" alt="socite" srcset="">
      <div class="div2">
        <a href="#" class="link">Developer Senior (developer Française)</a>
        <div class="div1">
          <p class="socite"><i class='bx bxs-school'></i>NAKI SERVICES</p>
          <p class="location"><i class="ri-map-pin-line"></i>Tunis, centre ville,tunis</p>
        </div>
        <p class="description">Developer Senior (developer Française)</p>
      </div>
    </article>
  </section>-->
  <footer class="footer">

    <ul class="navbar footer-navbar">
      <li><a href="#">Privacy Policy</a></li>
      <li><a href="#">Terms of Service</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
    <p>&copy; 2023 Jobhive Hub. All rights reserved.</p>
  </footer>
  <script src="home1.js"></script>
</body>

</html>