<?php
session_start();

$host = "localhost";
$dbname = "marvel";
$username = "root";
$password = "";

$message = "";

try {
    $dbConnect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    // Destroy the session
    session_destroy();
    // Redirect to the inscription/connexion page
    header("Location: inscription.php");
    exit;
}

if (isset($_POST['inscription'])) {
    $pseudo = $_POST['pseudo'];
    $motdepasse = $_POST['motdepasse'];
    $email = $_POST['email'];

    $sql = "INSERT INTO utilisateur (pseudo, motdepasse, email) VALUES (:pseudo, :motdepasse, :email)";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':motdepasse', $motdepasse);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $message = "Inscription réussie, vous pouvez maintenant vous connecter.";
}

if (isset($_POST['seconnecter'])) {
    $identifiant = $_POST['identifiant'];
    $motdepasse = $_POST['motdepasse'];

    // Vérifier les informations d'identification dans la base de données
    $sql = "SELECT * FROM utilisateur WHERE pseudo = :identifiant AND motdepasse = :motdepasse";
    $stmt = $dbConnect->prepare($sql);
    $stmt->bindParam(':identifiant', $identifiant);
    $stmt->bindParam(':motdepasse', $motdepasse);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Connexion réussie, enregistrer l'utilisateur dans la session
        $_SESSION['donnees'] = $user;
        header("Location: marvel.php");
        exit();
    } else {
        // Identifiants incorrects, afficher un message d'erreur
        $message = "Identifiants incorrects.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel - Inscription/Connexion</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
    <div class="hover-effect">
        <section class="bodycontainer">
            <form method="POST" class="white-text">
                <br><h1>Inscription</h1>
<br><br>
                <label for="pseudo">Pseudo :</label><br>
                <input type="text" name="pseudo" required><br><br>

                <label for="motdepasse">Mot de passe :</label><br>
                <input type="password" name="motdepasse" required><br><br>

                <label for="email">Email :</label><br>
                <input type="email" name="email" required><br><br>

                <input type="submit" name="inscription" value="S'inscrire">
            </form>
<br>
            <form method="POST" class="white-text">
                <h1>Connexion</h1>
<br><br>
                <label for="identifiant">Identifiant :</label><br>
                <input type="text" name="identifiant" required><br><br>

                <label for="motdepasse">Mot de passe :</label><br>
                <input type="password" name="motdepasse" required><br><br>

                <input type="submit" name="seconnecter" value="Se connecter">
            </form>

            <p><?php echo $message; ?></p>
        </section>
    </div>
</body>

</html>