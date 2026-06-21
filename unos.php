<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putovanja | Unos destinacije</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'connect.php'; include 'header.php'; ?>

<main>
    <h2>Dodaj novu destinaciju</h2>

    <?php
    // ============================================================
    // OBRADA FORME - INSERT u bazu
    // ============================================================
    $poruka = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // 1. Dohvat podataka iz forme
        $naslov     = trim($_POST['naslov']);
        $sazetak    = trim($_POST['sazetak']);
        $tekst      = trim($_POST['tekst']);
        $kategorija = $_POST['kategorija'];
        $datum      = date('Y-m-d'); // trenutni datum u formatu baze

        // Checkbox arhiva - ako nije označen, $_POST['arhiva'] ne postoji
        if (isset($_POST['arhiva'])) {
            $arhiva = 1;
        } else {
            $arhiva = 0;
        }

        // 2. Obrada slike (upload datoteke)
        $slika = "";
        if (isset($_FILES['slika']) && $_FILES['slika']['name'] != "") {
            $slika = $_FILES['slika']['name'];
            $target = 'uploads/' . $slika;
            move_uploaded_file($_FILES['slika']['tmp_name'], $target);
        }

        // 3. Validacija
        if (empty($naslov) || empty($sazetak) || empty($tekst)) {
            $poruka = '<p class="poruka-greska">Naslov, sažetak i tekst su obavezni!</p>';
        } else {
            // 4. INSERT upit - prepared statement (zaštita od SQL injection)
            $sql = "INSERT INTO destinacije (datum, naslov, sazetak, tekst, slika, kategorija, arhiva) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $datum, $naslov, $sazetak, $tekst, $slika, $kategorija, $arhiva);

            if ($stmt->execute()) {
                $poruka = '<p class="poruka-uspjeh">Destinacija "' . htmlspecialchars($naslov) . '" uspješno dodana!</p>';
            } else {
                $poruka = '<p class="poruka-greska">Greška: ' . $stmt->error . '</p>';
            }
            $stmt->close();
        }
    }
    ?>

    <?php echo $poruka; ?>

    <form action="unos.php" method="POST" enctype="multipart/form-data">

        <div class="form-item">
            <label for="naslov">Naziv destinacije</label>
            <input type="text" id="naslov" name="naslov" required>
        </div>

        <div class="form-item">
            <label for="sazetak">Kratki sažetak (do 50 znakova)</label>
            <textarea id="sazetak" name="sazetak" rows="3" required></textarea>
        </div>

        <div class="form-item">
            <label for="tekst">Sadržaj (cijeli opis destinacije)</label>
            <textarea id="tekst" name="tekst" rows="8" required></textarea>
        </div>

        <div class="form-item">
            <label for="kategorija">Kategorija</label>
            <select id="kategorija" name="kategorija">
                <option value="Europa">Europa</option>
                <option value="Amerika">Amerika</option>
                <option value="Azija">Azija</option>
                <option value="Ostatak svijeta">Ostatak svijeta</option>
            </select>
        </div>

        <div class="form-item">
            <label for="slika">Slika</label>
            <input type="file" id="slika" name="slika" accept="image/*">
        </div>

        <div class="form-item">
            <label>
                <input type="checkbox" name="arhiva">
                Arhiviraj (ne prikazuj na stranici)
            </label>
        </div>

        <div class="form-item">
            <button type="reset">Poništi</button>
            <button type="submit">Objavi destinaciju</button>
        </div>

    </form>
</main>

<?php include 'footer.php'; ?>

</body>
</html>