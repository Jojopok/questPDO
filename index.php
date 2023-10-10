<?php
require_once 'connect.php';
$pdo = new \PDO(DSN, USER, PASS);

$friends = []; // Initialisez la variable $friends

if (isset($_POST["Firstname"]) && isset($_POST["Lastname"]) && !empty($_POST["Firstname"]) && !empty($_POST["Lastname"])  ) {
    $query = "INSERT INTO friend(firstname, lastname) VALUES (:firstname, :lastname)";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':firstname', $_POST['Firstname'], PDO::PARAM_STR);
    $statement->bindParam(':lastname', $_POST['Lastname'], PDO::PARAM_STR);
    $statement->execute();

    $query = "SELECT * FROM friend";
    $statement = $pdo->query($query);
    $friends = $statement->fetchAll();
} else {
    echo "⚠️ Les champs ne sont pas tous remplis. ⚠️";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach($friends as $friend) {
            echo "<li>{$friend['firstname']} {$friend['lastname']}</li>";
        }
        ?>
    </ul>
    <form method="post">
        <input name="Firstname" type="text" placeholder="Firstname">
        <input name="Lastname" type="text" placeholder="Lastname">
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>