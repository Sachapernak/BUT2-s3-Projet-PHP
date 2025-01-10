<?php
// Matchs.php
$index = isset($_POST['index']) ? $_POST['index'] : "Aucune donnée reçue";
?>

<!DOCTYPE html>
<html>
<body>
    <h1>Index reçu : <?php echo htmlspecialchars($index); ?></h1>

    <form action="test.php" method="post">
        <input type="hidden" name="index" value="0">
        <button type="submit">Soumettre</button>
    </form>
</body>
</html>
