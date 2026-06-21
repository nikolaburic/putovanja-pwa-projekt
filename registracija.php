<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putovanja | Registracija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
include 'connect.php'; 
include 'header.php'; 

$msg = "";
$registriranKorisnik = false;

// Inicijalne vrijednosti da ih možemo vratiti u formu
$ime = "";
$prezime = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Trim i spremanje u varijable
    $ime      = trim($_POST['ime'] ?? '');
    $prezime  = trim($_POST['prezime'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $lozinka  = $_POST['lozinka']  ?? '';
    $lozinka2 = $_POST['lozinka2'] ?? '';
    $razina   = 0; // svi novi korisnici su razina 0 (ne-admin)

    // Validacija
    if (empty($ime) || empty($prezime) || empty($username) || empty($lozinka) || empty($lozinka2)) {
        $msg = '<p class="poruka-greska">Sva polja su obavezna!</p>';

    } elseif ($lozinka !== $lozinka2) {
        // Lozinke se ne poklapaju
        $msg = '<p class="poruka-greska">Lozinke se ne poklapaju!</p>';

    } else {
        // Provjeri postoji li već korisnik s tim korisničkim imenom
        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                // Korisničko ime već postoji
                $msg = '<p class="poruka-greska">Korisničko ime već postoji! Odaberi drugo.</p>';

            } else {
                // Hashiranje lozinke
                $hashed = password_hash($lozinka, PASSWORD_BCRYPT);

                // INSERT novog korisnika
                $sql2 = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) 
                         VALUES (?, ?, ?, ?, ?)";
                $stmt2 = mysqli_stmt_init($conn);

                if (mysqli_stmt_prepare($stmt2, $sql2)) {
                    mysqli_stmt_bind_param($stmt2, 'ssssi', $ime, $prezime, $username, $hashed, $razina);
                    mysqli_stmt_execute($stmt2);

                    $registriranKorisnik = true;

                    // Po želji: resetiraj polja nakon uspješne registracije
                    $ime = "";
                    $prezime = "";
                    $username = "";
                }
            }
        }
    }
}
?>

<main>
    <div class="auth-box">
        <h2>Registracija</h2>

        <?php if ($registriranKorisnik): ?>

            <p class="poruka-uspjeh">
                Registracija uspješna! 
                <a href="login.php">Klikni ovdje za prijavu →</a>
            </p>

        <?php else: ?>

            <!-- Poruka o grešci ili info -->
            <?php echo $msg; ?>

            <!-- Forma za registraciju -->
            <form action="registracija.php" method="POST">

                <div class="form-item">
                    <label for="ime">Ime</label>
                    <input 
                        type="text" 
                        id="ime" 
                        name="ime" 
                        required
                        value="<?php echo htmlspecialchars($ime, ENT_QUOTES, 'UTF-8'); ?>"
                    >
                </div>

                <div class="form-item">
                    <label for="prezime">Prezime</label>
                    <input 
                        type="text" 
                        id="prezime" 
                        name="prezime" 
                        required
                        value="<?php echo htmlspecialchars($prezime, ENT_QUOTES, 'UTF-8'); ?>"
                    >
                </div>

                <div class="form-item">
                    <label for="username">Korisničko ime</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        required
                        value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>"
                    >
                </div>

                <div class="form-item">
                    <label for="lozinka">Lozinka</label>
                    <input 
                        type="password" 
                        id="lozinka" 
                        name="lozinka" 
                        required
                    >
                </div>

                <div class="form-item">
                    <label for="lozinka2">Ponovi lozinku</label>
                    <input 
                        type="password" 
                        id="lozinka2" 
                        name="lozinka2" 
                        required
                    >
                </div>

                <div class="form-item">
                    <button type="submit">Registriraj se</button>
                </div>

                <p class="auth-link">
                    Već imaš račun? <a href="login.php">Prijavi se ovdje →</a>
                </p>

            </form>

        <?php endif; ?>

    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>