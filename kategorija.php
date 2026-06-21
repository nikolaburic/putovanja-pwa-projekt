<?php
include 'connect.php';

// uzimamo kategoriju iz URL-a
$kategorija = $_GET['kategorija'];
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Kategorija - <?php echo htmlspecialchars($kategorija); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php include 'header.php'; ?>

<main>

<section class="kategorija-stranica">

    <h2 class="kategorija">
        <?php echo strtoupper(htmlspecialchars($kategorija)); ?>
    </h2>

    <?php
    // Prepared statement - zaštita od SQL injection
    $query = "SELECT * FROM destinacije 
              WHERE arhiva = 0 
              AND kategorija = ? 
              ORDER BY datum DESC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $kategorija);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
    ?>
        <p style="padding: 20px;">Trenutno nema destinacija u ovoj kategoriji.</p>
    <?php
    }

    while($row = $result->fetch_assoc()) {
    ?>

        <div class="destinacija-card">

            <div class="slika">
                <img src="uploads/<?php echo $row['slika']; ?>" 
                     alt="<?php echo htmlspecialchars($row['naslov']); ?>">
            </div>

            <div class="content">

                <div class="card-top">
                    <h3>
                        <a href="clanak.php?id=<?php echo $row['id']; ?>">
                            <?php echo htmlspecialchars($row['naslov']); ?>
                        </a>
                    </h3>

                    <span class="datum">
                        <?php echo $row['datum']; ?>
                    </span>
                </div>

                <p><?php echo htmlspecialchars($row['sazetak']); ?></p>

                <div class="card-bottom">
                        <a href="clanak.php?id=<?php echo $row['id']; ?>" class="btn">
                            Pročitaj više →
                        </a>
                </div>

            </div>

        </div>

    <?php } ?>

</section>

</main>

<?php include 'footer.php'; ?> 

</body>
</html>