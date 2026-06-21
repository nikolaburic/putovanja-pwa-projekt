<!DOCTYPE html>
<html lang="hr">
<head>
    
    <link rel="stylesheet" href="style.css">
</head>



<footer>
    
        <p>&copy; 2026 Putujmo Svijetom | Sva prava pridržana</p>
        <p>Kontakt: info@putujmosvijetom.com</p>
    
</footer>

</body>
</html>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const navBar   = document.querySelector('.nav-bar');
    const navToggle = document.querySelector('.nav-toggle');

    if (navBar && navToggle) {
        navToggle.addEventListener('click', function () {
            navBar.classList.toggle('nav-open');
        });
    }
});
</script>