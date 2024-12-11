<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Joueur</title>
</head>
<body>
    <header>
        <h1>Détails du Joueur</h1>
    </header>
    <main>
        <section class="joueur">
            <?php
                // Connexion à la base de données
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=ma_base_de_donnees", "nom_utilisateur", "mot_de_passe");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Requête SQL
                    $stmt = $pdo->prepare("SELECT Pseudo, Nom, Image, Pays, DateNaissance, Role, DateFinContrat, Description FROM joueurs WHERE id = :id");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();

                    // Affichage des données
                    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<h2>" . htmlspecialchars($row["Pseudo"]) . "</h2>";
                        echo "<img src='" . htmlspecialchars($row["Image"]) . "' alt='" . htmlspecialchars($row["Pseudo"]) . "'>";
                        echo "<p><strong>Nom:</strong> " . htmlspecialchars($row["Nom"]) . "</p>";
                        echo "<p><strong>Pays:</strong> " . htmlspecialchars($row["Pays"]) . "</p>";
                        echo "<p><strong>Date de Naissance:</strong> " . htmlspecialchars($row["DateNaissance"]) . "</p>";
                        echo "<p><strong>Rôle:</strong> " . htmlspecialchars($row["Role"]) . "</p>";
                        echo "<p><strong>Date de Fin de Contrat:</strong> " . htmlspecialchars($row["DateFinContrat"]) . "</p>";
                        echo "<p><strong>Description:</strong> " . htmlspecialchars($row["Description"]) . "</p>";
                    } else {
                        echo "Joueur non trouvé.";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            ?>
        </section>
    </main>
</body>
</html>
