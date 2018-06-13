<?php

session_start();

// sterg variabilele salvate in sesiune (Ex. $_SESSION['user'])
session_unset();
// distrug sesiunea
session_destroy();

// redirectez utilizatorul catre pagina initiala
header('Location: indexFinal.php');