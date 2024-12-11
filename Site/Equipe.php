<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Équipe</title>
</head>
<body>
    <header>
        <h1>Détails de l'Équipe</h1>
    </header>
    <main>
        <section class="equipe">
            <?php
                // Connexion à la base de données
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=ma_base_de_donnees", "nom_utilisateur", "mot_de_passe");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Requête SQL
                    $stmt = $pdo->prepare("SELECT Nom, Pays, DateCreation FROM equipes WHERE id = :id");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();

                    // Affichage des données
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<h2>" . htmlspecialchars($row["Nom"]) . "</h2>";
                        echo "<p><strong>Pays:</strong> " . htmlspecialchars($row["Pays"]) . "</p>";
                        echo "<p><strong>Date de Création:</strong> " . htmlspecialchars($row["DateCreation"]) . "</p>";
                    } else {
                        echo "Équipe non trouvée.";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            ?>
        </section>
    </main>
</body>
</html>
