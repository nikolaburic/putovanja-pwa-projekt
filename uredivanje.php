<?php
session_start();
include 'connect.php';

// ============================================================
// ZAŠTITA PRISTUPA - samo prijavljeni admin (razina 2)
// ============================================================
if ( !isset($_SESSION['username']) || $_SESSION['razina'] != 2 ) {
    header("Location: index.php");
    exit();
}

// ============================================================
// BRISANJE ZAPISA (DELETE)
// ============================================================
if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM destinacije WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Redirect nakon brisanja - sprječava ponovno slanje forme ako se stranica osvježi (F5)
    header("Location: uredivanje.php");
    exit();
}

// ============================================================
// UREĐIVANJE ZAPISA (UPDATE)
// ============================================================
if (isset($_POST['update'])) {
    $id         = intval($_POST['id']);
    $naslov     = trim($_POST['naslov']);
    $sazetak    = trim($_POST['sazetak']);
    $tekst      = trim($_POST['tekst']);
    $kategorija = $_POST['kategorija'];

    // Checkbox - ako nije označen, ne postoji u $_POST
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    // Slika - ako je uploadana NOVA slika, zamijeni; inače zadrži postojeću
    if (isset($_FILES['slika']) && $_FILES['slika']['name'] != "") {
        $slika  = $_FILES['slika']['name'];
        $target = 'uploads/' . $slika;
        move_uploaded_file($_FILES['slika']['tmp_name'], $target);
    } else {
        // Zadrži staru sliku - dohvati je iz skrivenog inputa forme
        $slika = $_POST['stara_slika'];
    }

    $sql = "UPDATE destinacije 
            SET naslov = ?, sazetak = ?, tekst = ?, slika = ?, kategorija = ?, arhiva = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $naslov, $sazetak, $tekst, $slika, $kategorija, $arhiva, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: uredivanje.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putovanja | Uređivanje</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section class="uredivanje-stranica">
        <h2 class="kategorija-naslov">UREĐIVANJE DESTINACIJA</h2>

        <?php
        // Dohvati SVE destinacije (i arhivirane, admin treba vidjeti sve)
        $sql = "SELECT * FROM destinacije ORDER BY datum DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>

        <div class="admin-card">

            <form action="uredivanje.php" method="POST" enctype="multipart/form-data">

                <!-- Skriveno polje - koji zapis se uređuje -->
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <!-- Skriveno polje - čuva ime stare slike ako se ne uploada nova -->
                <input type="hidden" name="stara_slika" value="<?php echo htmlspecialchars($row['slika']); ?>">

                <div class="form-item">
                    <label>Naziv destinacije</label>
                    <input type="text" name="naslov" value="<?php echo htmlspecialchars($row['naslov']); ?>" required>
                </div>

                <div class="form-item">
                    <label>Sažetak</label>
                    <textarea name="sazetak" rows="2" required><?php echo htmlspecialchars($row['sazetak']); ?></textarea>
                </div>

                <div class="form-item">
                    <label>Tekst</label>
                    <textarea name="tekst" rows="5" required><?php echo htmlspecialchars($row['tekst']); ?></textarea>
                </div>

                <div class="form-item">
                    <label>Kategorija</label>
                    <select name="kategorija">
                        <?php
                        $kategorije = ["Europa", "Amerika", "Azija", "Ostatak svijeta"];
                        foreach ($kategorije as $k) {
                            $selected = ($row['kategorija'] == $k) ? 'selected' : '';
                            echo "<option value=\"$k\" $selected>$k</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-item">
                    <label>Slika (ostavi prazno za zadržavanje postojeće)</label><br>
                    <img src="uploads/<?php echo htmlspecialchars($row['slika']); ?>" width="100" style="display:block; margin-bottom:8px;">
                    <input type="file" name="slika" accept="image/*">
                </div>

                <div class="form-item">
                    <label>
                        <input type="checkbox" name="arhiva" <?php echo ($row['arhiva'] == 1) ? 'checked' : ''; ?>>
                        Arhivirano (ne prikazuje se na stranici)
                    </label>
                </div>

                <div class="form-item">
                    <button type="submit" name="update">Spremi izmjene</button>
                </div>

            </form>

            <!-- Posebna forma SAMO za brisanje (drugi gumb, druga akcija) -->
            <form action="uredivanje.php" method="POST" onsubmit="return confirm('Sigurno želiš obrisati ovu destinaciju?');">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="delete" class="btn-delete">Izbriši destinaciju</button>
            </form>

            

        </div>

        <?php } ?>

    </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>