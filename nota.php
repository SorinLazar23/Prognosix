<?php
session_start();
?>
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

  <!--  Acordare nota  -->
  <div>
      <ul class = "meniu-note content">

          <li><a href="#news">Examen</a></li>
          <li><a href="#news">Proiect</a></li>
          <li><a href="#news">Laborator</a></li>

      </ul>
  </div>

	<div class="content-note">
		<form action="#" method="post" class="formular">
        <fieldset class="fieldset">
          <legend class="legend-top"><h2>Acorda o nota</h2></legend>
          <p>
            <input type="text" name="notaExamen" id="nota-examen" placeholder="Nota la examenul final" />
          </p>

          <p class="button-wrapper">
            <input type="submit" name="inregistrare" id="inregistrare" class="buton-formular" value="Calculare" />
            <input type="reset" name="reset" id="reset" class="buton-formular" value="Resetare" />
          </p>
        </fieldset>
      </form>
	</div>
  <!--  Acordare nota  -->
</body>
</html>