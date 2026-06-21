<?php
include 'connect.php';

// sigurnost
$id = intval($_GET['id']);

// uzmi jedan članak
$sql = "SELECT * FROM destinacije WHERE id = $id AND arhiva = 0";
$result = $conn->query($sql);

// ako ne postoji članak
if ($result->num_rows == 0) {
    echo "Članak ne postoji.";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $row['naslov']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<main >

   
    
    <section>

        
        <h1 class="naslov">
        <?php echo $row['naslov']; ?>
        </h1>

        <div class="datum">
            <?php echo $row['datum']; ?>
        </div>

        <img class="slika" src="uploads/<?php echo $row['slika']; ?>" alt="">

        <p class="tekst">
            <?php echo nl2br($row['tekst']); ?>
        </p>


    </section>
    

</main>

<?php include 'footer.php'; ?>


</body>
</html>