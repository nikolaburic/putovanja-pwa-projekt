<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Putovanja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>

    <!-- EUROPA -->
    <section class="europa">
        <h2 class="kategorija">EUROPA</h2>

        <?php
        $query = "SELECT * FROM destinacije 
                  WHERE arhiva = 0 AND kategorija = 'Europa' 
                  ORDER BY datum DESC";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)) {
        ?>
        
        <article>
            <div class="destinacija-card">

                <div class="slika">
                    <img src="uploads/<?php echo $row['slika']; ?>" 
                         alt="<?php echo htmlspecialchars($row['naslov']); ?>">
                </div>

                <div class="content">

                    <div class="card-top">
                        <h3><?php echo $row['naslov']; ?></h3>
                        <span class="datum"><?php echo $row['datum']; ?></span>
                    </div>

                    <p><?php echo $row['sazetak']; ?></p>

                    <div class="card-bottom">
                        <a href="clanak.php?id=<?php echo $row['id']; ?>" class="btn">
                            Pročitaj više →
                        </a>
                    </div>

                </div>

            </div>
        </article>

        <?php } ?>

    </section>

    <!-- AMERIKA -->
    <section class="amerika">
        <h2 class="kategorija">AMERIKA</h2>

        <?php
        $query = "SELECT * FROM destinacije 
                  WHERE arhiva = 0 AND kategorija = 'Amerika' 
                  ORDER BY datum DESC";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)) {
        ?>
        
        <article>
            <div class="destinacija-card">

                <div class="slika">
                    <img src="uploads/<?php echo $row['slika']; ?>" 
                         alt="<?php echo htmlspecialchars($row['naslov']); ?>">
                </div>

                <div class="content">

                    <div class="card-top">
                        <h3><?php echo $row['naslov']; ?></h3>
                        <span class="datum"><?php echo $row['datum']; ?></span>
                    </div>

                    <p><?php echo $row['sazetak']; ?></p>

                    <div class="card-bottom">
                        <a href="clanak.php?id=<?php echo $row['id']; ?>" class="btn">
                            Pročitaj više →
                        </a>
                    </div>

                </div>

            </div>
        </article>

        <?php } ?>

    </section>


    <!-- AZIJA -->
    <section class="azija">
        <h2 class="kategorija">AZIJA</h2>

        <?php
        $query = "SELECT * FROM destinacije 
                  WHERE arhiva = 0 AND kategorija = 'Azija' 
                  ORDER BY datum DESC";
        $result = mysqli_query($conn, $query);

        while($row = mysqli_fetch_assoc($result)) {
        ?>

        <article>
            <div class="destinacija-card">

                <div class="slika">
                    <img src="uploads/<?php echo $row['slika']; ?>" 
                         alt="<?php echo htmlspecialchars($row['naslov']); ?>">
                </div>

                <div class="content">

                    <div class="card-top">
                        <h3><?php echo $row['naslov']; ?></h3>
                        <span class="datum"><?php echo $row['datum']; ?></span>
                    </div>

                    <p><?php echo $row['sazetak']; ?></p>

                    <div class="card-bottom">
                        <a href="clanak.php?id=<?php echo $row['id']; ?>" class="btn">
                            Pročitaj više →
                        </a>
                    </div>

                </div>

            </div>
        </article>

        <?php } ?>

    </section>

</main>

<?php include 'footer.php'; ?>

</body>
</html>