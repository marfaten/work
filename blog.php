<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="blog.css" />
</head>
<body>


<h1>Bienvenue sur mon blog</h1>
<center><p> Voici les derniers billets dont on a discuté</p></center>


<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>
<?php
// On récupère les 5 derniers billets
$req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
while($data=$req->fetch())
{
    ?>
    <div class=news>
        <?php echo htmlspecialchars($data['titre']); ?>
        <em><h3>le <?php echo $data['date_creation_fr']; ?></h3></em>

        <p>
            <?php
            // On affiche le contenu du billet
            echo nl2br(htmlspecialchars($data['contenu']));
            ?>
            <br />
            <a href="commentaires.php?billet=<?php echo $data['id']; ?>">Commentaires</a>
        </p>
    </div>
<?php
}
$req->closeCursor();
?>

</body>
</html>