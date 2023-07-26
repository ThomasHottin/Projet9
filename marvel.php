<?php
session_start();

$host = "localhost";
$dbname = "marvel";
$username = "root";
$password = "";

try {
    $dbConnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

// REQUETE TRI DES FILMS PAR ANNEES

$sql_years = "SELECT DISTINCT YEAR(date) AS annee FROM films ORDER BY annee DESC";
$stmt_years = $dbConnect->prepare($sql_years);
$stmt_years->execute();
$years = $stmt_years->fetchAll(PDO::FETCH_ASSOC);

$selected_year = isset($_GET['annee']) ? intval($_GET['annee']) : 0;

$sql_films = "SELECT films.*, acteur.*, realisateur.*
              FROM films
              LEFT JOIN joue ON films.id_film = joue.id_film
              LEFT JOIN acteur ON joue.id_acteur = acteur.id_acteur
              LEFT JOIN realise ON films.id_film = realise.id_film
              LEFT JOIN realisateur ON realise.id_realisateur = realisateur.id_realisateur";

if ($selected_year !== 0) {
    $sql_films .= " WHERE YEAR(films.date) = :selected_year";
}

$sql_films .= " ORDER BY films.date ASC";

$stmt_films = $dbConnect->prepare($sql_films);

if ($selected_year !== 0) {
    $stmt_films->bindParam(':selected_year', $selected_year);
}

$stmt_films->execute();
$result = $stmt_films->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <header>
        <img src="images\Marvel-Wallpaper-04-3840-x-2160.jpg" alt="marvel">
    </header>

    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="inscription.php">S'inscrire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="inscription.php">Se connecter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="marvel.php?page=crudfilm">Ajouter/modifier/supprimer</a>
                    </li>
                    <form method="GET">
                        <a class="nav-link active" aria-current="page" href="#">Trier par années : </a>
                        <select name="annee" id="annee">
                            <option value="0">Toutes les années</option>
                            <?php
                            foreach ($years as $year) {
                                echo '<option value="' . $year['annee'] . '">' . $year['annee'] . '</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" value="Trier">
                    </form>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item1">
                        <a class="nav-link active" class="right" aria-current="page" href="inscription.php?logout=true">Se déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- AFFICHAGE DU TRI PAR ANNEE -->

    <?php
    if (isset($_GET['annee']) && $_GET['annee'] !== 'toutes') {
        $selected_year = intval($_GET['annee']);

        if (isset($result) && count($result) > 0) {
            echo '<div class="card-container">';
            $current_film_id = null;
            foreach ($result as $value) {
                if ($current_film_id !== $value['id_film']) {
                    if ($current_film_id !== null) {
                        echo '<p><strong>Réalisateur(s):</strong> ' . implode(', ', $directors) . '</p>';
                        echo '</div>';
                    }
                    $current_film_id = $value['id_film'];
                    $directors = array();
                    echo '<div class="card">';
                    echo '<h3>' . $value['titre'] . '</h3>';
                    echo '<p><strong>Date:</strong> ' . $value['date'] . '</p>';
                    echo '<p><strong>Durée:</strong> ' . $value['duree'] . ' minutes</p>';
                    echo '<p><strong>Acteur:</strong> ' . $value['nom_acteur'] . ' ' . $value['prenom_acteur'] . '</p>';
                    echo '<img src="' . $value['affiche'] . '" alt="Affiche du film">';
                }
                $directors[] = $value['nom_realisateur'] . ' ' . $value['prenom_realisateur'];
            }
            if ($current_film_id !== null) {
                echo '<p><strong>Réalisateur(s):</strong> ' . implode(', ', $directors) . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "Aucun film trouvé.";
        }
    }

    // LISTE DE FILMS   


    if (isset($_SESSION['donnees'])) {
        $page = isset($_GET['page']) ? $_GET['page'] : '';

        if ($page === 'listefilm') {
    ?>
            <div class="card-container">
                <?php

                // Read
                $sql = "SELECT films.*, acteur.*, realisateur.*
                        FROM films
                        LEFT JOIN joue ON films.id_film = joue.id_film
                        LEFT JOIN acteur ON joue.id_acteur = acteur.id_acteur
                        LEFT JOIN realise ON films.id_film = realise.id_film
                        LEFT JOIN realisateur ON realise.id_realisateur = realisateur.id_realisateur";
                $stmt = $dbConnect->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $value) {
                    echo '<div class="card">
                              <h3>' . $value['titre'] . '</h3>
                              <p><strong>Date:</strong> ' . $value['date'] . '</p>
                              <p><strong>Durée:</strong> ' . $value['duree'] . ' minutes</p>
                              <p><strong>Acteur:</strong> ' . $value['nom_acteur'] . ' ' . $value['prenom_acteur'] . '</p>
                              <p><strong>Réalisateur:</strong> ' . $value['nom_realisateur'] . ' ' . $value['prenom_realisateur'] . '</p>
                              <img src="' . $value['affiche'] . '" alt="Affiche du film">
                              </div>';
                }
                ?>
            </div>
        <?php

            //AJOUTER/MODIFIER/SUPPRIMER

        } elseif ($page === 'crudfilm') {
        ?>
            <div class="card-container1">
                <form method="POST">
                    <label>Ajouter un film : </label>
                    <input type="text" name="titre" placeholder="titre">
                    <input type="date" name="date" placeholder="date">
                    <input type="number" name="duree" placeholder="duree">
                    <input type="text" name="affiche" placeholder="affiche">
                    <input type="submit1" name="submitCreate" value="Ajouter">
                    <br><br>
                    <label>Modifier des données de films : </label>
                    <input type="number" name="updateId" placeholder="Id">
                    <input type="text" name="updateTitre" placeholder="titre">
                    <input type="date" name="updateDate" placeholder="date">
                    <input type="number" name="updateDuree" placeholder="duree">
                    <input type="text" name="updateAffiche" placeholder="affiche">
                    <input type="submit1" name="updateSubmit" value="UPDATE">
                    <br><br>
                    <label>Supprimer des films</label>
                    <input type="number" name="Id" placeholder="Id">
                    <input type="submit1" name="deleteSubmit" value="Supprimer">
                    <br><br>
                    <label>Ajouter un acteur :</label>
                    <input type="text" name="nom_acteur" placeholder="Nom de l'acteur">
                    <input type="text" name="prenom_acteur" placeholder="Prénom de l'acteur">
                    <input type="submit1" name="submitActor" value="Ajouter acteur">
                    <label>Ajouter un utilisateur :</label>
                    <input type="text" name="pseudo" placeholder="Pseudo">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="motdepasse" placeholder="Mot de passe">
                    <input type="submit1" name="submitDirector" value="Ajouter l'utilisateur">
                    <label>Supprimer un utilisateur</label>
                    <input type="number" name="Id" placeholder="Id">
                    <input type="submit1" name="deleteSubmit" value="Supprimer l'utilisateur">
                </form>
            </div>

    <?php

            if (isset($_SESSION['donnees'])) {
                $page = isset($_GET['page']) ? $_GET['page'] : '';

                if ($page === 'crudfilm') {

                    if (isset($_POST['submitCreate'])) {
                        $titre = addslashes($_POST['titre']);
                        $date = $_POST['date'];
                        $duree = $_POST['duree'];
                        $affiche = $_POST['affiche'];

                        $sql = "INSERT INTO `films`(`titre`, `date`, `duree`, `affiche`) VALUES (:titre, :date, :duree, :affiche)";
                        $stmt = $dbConnect->prepare($sql);
                        $stmt->bindParam(':titre', $titre);
                        $stmt->bindParam(':date', $date);
                        $stmt->bindParam(':duree', $duree);
                        $stmt->bindParam(':affiche', $affiche);
                        $stmt->execute();
                    }

                    if (isset($_POST['updateSubmit'])) {
                        $id = $_POST['updateId'];
                        $titre = addslashes($_POST['updateTitre']);
                        $date = $_POST['updateDate'];
                        $duree = $_POST['updateDuree'];
                        $affiche = $_POST['updateAffiche'];

                        $sql = "UPDATE `films` SET `titre`=:titre, `date`=:date, `duree`=:duree, `affiche`=:affiche WHERE id_film = :id";
                        $stmt = $dbConnect->prepare($sql);
                        $stmt->bindParam(':titre', $titre);
                        $stmt->bindParam(':date', $date);
                        $stmt->bindParam(':duree', $duree);
                        $stmt->bindParam(':affiche', $affiche);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                    }

                    if (isset($_POST['submitDirector'])) {
                        $nom_realisateur = $_POST['nom_realisateur'];
                        $prenom_realisateur = $_POST['prenom_realisateur'];

                        $sql = "INSERT INTO `realisateur`(`nom_realisateur`, `prenom_realisateur`) VALUES (:nom_realisateur, :prenom_realisateur)";
                        $stmt = $dbConnect->prepare($sql);
                        $stmt->bindParam(':nom_realisateur', $nom_realisateur);
                        $stmt->bindParam(':prenom_realisateur', $prenom_realisateur);
                    }

                    if (isset($_POST['deleteSubmit'])) {
                        $id = $_POST['Id'];

                        $sql = "DELETE FROM `films` WHERE id_film = :id";
                        $stmt = $dbConnect->prepare($sql);
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();

                        header("refresh: 1; http://localhost/Projet9/marvel.php");
                    }
                }
            }

            // DECONNEXION

        } else {
            ($page === 'crudfilm');
        }

        if (isset($_POST['destroysession'])) {
            session_destroy();
            header("refresh:1; http://localhost/Projet9/marvel.php");
            echo "<br>Vous êtes déconnecté";
        }
    }
    ?>
    </section>
    </div>
</body>

</html>