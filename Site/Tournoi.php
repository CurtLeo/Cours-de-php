<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tournoi</title>
</head>
<body>
    <header>
        <h1>Détails du Tournoi</h1>
    </header>
    <main>
        <section class="tournoi">
            <?php
                // Connexion à la base de données
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=ma_base_de_donnees", "nom_utilisateur", "mot_de_passe");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Requête SQL
                    $stmt = $pdo->prepare("SELECT Nom, Pays, DateDebut, DateFin FROM tournois WHERE id = :id");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();

                    // Affichage des données
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<h2>" . htmlspecialchars($row["Nom"]) . "</h2>";
                        echo "<p><strong>Pays:</strong> " . htmlspecialchars($row["Pays"]) . "</p>";
                        echo "<p><strong>Date de Début:</strong> " . htmlspecialchars($row["DateDebut"]) . "</p>";
                        echo "<p><strong>Date de Fin:</strong> " . htmlspecialchars($row["DateFin"]) . "</p>";
                    } else {
                        echo "Tournoi non trouvé.";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            ?>
        </section>
    </main>
</body>
</html>
