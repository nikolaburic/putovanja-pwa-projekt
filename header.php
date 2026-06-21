<?php session_start(); ?>

<header>
    <nav class="nav-bar">

        <!-- Lijeva strana -->
        <div class="nav-left">
            <a href="index.php" class="nav-link">PUTOVANJA</a>
        </div>

        <!-- HAMBURGER gumb (vidljiv samo na mobitelu) -->
        <button class="nav-toggle" aria-label="Otvori meni">
            ☰
        </button>

        <!-- Desna strana -->
        <ul class="nav-right">

            <li><a href="kategorija.php?kategorija=Europa">EUROPA</a></li>
            <li><a href="kategorija.php?kategorija=Amerika">AMERIKA</a></li>
            <li><a href="kategorija.php?kategorija=Azija">AZIJA</a></li>

            <?php if (!isset($_SESSION['username'])) { ?>

                <!-- NIJE PRIJAVLJEN -->
                <li><a href="registracija.php">PRIJAVA</a></li>

            <?php } else { ?>

                <?php switch ($_SESSION['razina']) {

                    case 1: ?>
                        <!-- RAZINA 1 - može unositi vijesti -->
                        <li><a href="unos.php">UNOS VIJESTI</a></li>
                        <?php
                        break;

                    case 2: ?>
                        <!-- RAZINA 2 - admin, može uređivati -->
                        <li><a href="unos.php">UNOS VIJESTI</a></li>
                        <li><a href="uredivanje.php">UREĐIVANJE</a></li>
                        <?php
                        break;

                    default:
                        // RAZINA 0 - običan korisnik
                        break;
                } ?>

                <li><a href="logout.php">ODJAVA</a></li>

            <?php } ?>

        </ul>

    </nav>
</header>