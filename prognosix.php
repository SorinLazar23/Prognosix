<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>ProGnosix</title>
    <link href="styleFinal.css" rel="stylesheet" type="text/css">
    <link href="homePage.css" rel="stylesheet" type="text/css">
</head>
<body>

<!--  Meniu  -->

<ul class = "meniu">
    <li><a href="http://localhost/Prognosix/indexFinal.php">Home</a></li>

    <li><a href="#news">News</a></li>

    <li class="meniu-ascuns-sub-500"><a href="#contact">Contact</a>
        <ul>
            <li><a href="http://localhost/Prognosix/contactFinal.php">Laurentiu Cozma</a></li>
            <li><a href="http://localhost/Prognosix/contactFinal.php">Sorin Lazar</a></li>
        </ul>
    </li>

    <li class="meniu-ascuns-sub-500"><a href="#about">About</a>
        <ul>
            <li><a href="http://localhost/Prognosix/team.php">Our team</a></li>
            <li><a href="http://localhost/Prognosix/prognosix.php">ProGnosix</a></li>
        </ul>
    </li>

    <?php if(isset($_SESSION['user'])){ ?>
        <li class="meniu-ascuns-sub-500"><a href="http://localhost/Prognosix/logout.php">Logout</a></li>
    <?php }else{ ?>
    <li class="meniu-ascuns-sub-500"><a href="#User">User</a>
        <ul>
            <li><a href="http://localhost/Prognosix/loginFinal.php">Login</a></li>
            <li><a href="http://localhost/Prognosix/registerFinal.php">Register</a></li>
        </ul>
    </li>
    <?php } ?>
</ul>



<!--  Meniu  -->

<!--  Content  -->
	<div class="content silver">
		<p>
			Sa se implementeze o aplicatie Web pentru realizarea de prognoze privitoare la punctajele obtinute de studenti la probele de evaluare -- teste scrise, activitati de laborator, proiecte etc. -- a cunostintelor la anumite discipline (e.g., Ingineria programarii, Practica SGBD, Tehnologii Web). Pentru fiecare runda a prognozelor, un utilizator (eventual, autentificat) va putea "ghici" doar o singura data nota pe care o va lua. In cazul in care nota precizata de acesta va coincide cu cea reala (preluata dintr-un document CSV, JSON sau XML separat), va primi P unitati in plus la punctaj, in caz contrar va obtine M unitati in minus. Dupa un numar de R runde, se vor putea afisa punctajele finale ale tuturor celor evaluati. Schimbarile de situatie vor fi disponibile via un flux RSS. Situatiile cu punctaje vor fi disponibile, de asemenea, ca documente adoptand formatele CSV si PDF.
		</p>

    </div>

<!--  Content  -->
</body>
</html>