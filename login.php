<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putovanja | Prijava</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// session_start() MORA biti prva stvar u fajlu, prije bilo čega drugog!
session_start();
include 'connect.php';
include 'header.php';
?>

<main>
    <div class="auth-box">
        <h2>Prijava</h2>

        <?php
        $msg = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = trim($_POST['username']);
            $lozinka  = $_POST['lozinka'];

            // Dohvati korisnika iz baze prema korisničkom imenu (prepared statement)
            $sql = "SELECT korisnicko_ime, lozinka, razina, ime FROM korisnik 
                    WHERE korisnicko_ime = ?";
            $stmt = mysqli_stmt_init($conn);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 's', $username);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika, $ime);
                mysqli_stmt_fetch($stmt);

                // Provjeri postoji li korisnik i je li lozinka ispravna
                if (mysqli_stmt_num_rows($stmt) > 0 && password_verify($lozinka, $lozinkaKorisnika)) {

                    // Postavi session varijable
                    $_SESSION['username']  = $imeKorisnika;
                    $_SESSION['razina']    = $levelKorisnika;
                    $_SESSION['ime']       = $ime;

                    // Preusmjeri na administrator.php
                    header('Location: index.php');
                    exit();

                } else if (mysqli_stmt_num_rows($stmt) == 0) {
                    // Korisnik ne postoji u bazi
                    $msg = '<p class="poruka-greska">
                                Korisnik ne postoji! 
                                <a href="registracija.php">Registriraj se ovdje →</a>
                            </p>';
                } else {
                    // Pogrešna lozinka
                    $msg = '<p class="poruka-greska">Pogrešno korisničko ime ili lozinka!</p>';
                }
            }
        }

        // Ako je korisnik već prijavljen, preusmjeri ga
        if (isset($_SESSION['username'])) {
            header('Location: index.php');
            exit();
        }
        ?>

        <?php echo $msg; ?>

        <form action="login.php" method="POST">

            <div class="form-item">
                <label for="username">Korisničko ime</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>

            <div class="form-item">
                <label for="lozinka">Lozinka</label>
                <input type="password" id="lozinka" name="lozinka" required>
            </div>

            <div class="form-item">
                <button type="submit">Prijavi se</button>
            </div>

            <p class="auth-link">
                Nemaš račun? <a href="registracija.php">Registriraj se ovdje →</a>
            </p>

        </form>

    </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>