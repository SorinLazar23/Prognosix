<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>ProGnosix</title>
    <link href="styleFinal.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
</head>
<body>

<!--  Meniu  -->
  <ul class = "meniu">
    <li><a href="http://localhost/Prognosix/indexFinal.php">Home</a></li>

    <li><a href="#news">News</a></li>

    <li id="meniu-ascuns-sub-500"><a href="#contact">Contact</a>
      <ul>
        <li><a href="http://localhost/Prognosix/contactFinal.php">Laurentiu Cozma</a></li>
            <li><a href="http://localhost/Prognosix/contactFinal.php">Sorin Lazar</a></li>
      </ul>
    </li> 

    <li id="meniu-ascuns-sub-500"><a href="#about">About</a>
        <ul>
          <li><a href="http://localhost/Prognosix/team.php">Our team</a></li>
          <li><a href="http://localhost/Prognosix/prognosix.php">ProGnosix</a></li>
        </ul>
      </li>

      <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/team.php">Our team</a></li>
      <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/prognosix.php">ProGnosix</a></li>
        

      <li id="meniu-ascuns-sub-500"><a href="#User">User</a>
      <ul>
        <li><a href="http://localhost/Prognosix/loginFinal.php">Login</a></li>
        <li><a href="http://localhost/Prognosix/registerFinal.php">Register</a></li>
      </ul>
    </li>

    <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/loginFinal.php">Login</a></li>
    <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/registerFinal.php">Register</a></li>
  </ul>

<!--  Meniu  -->

<!--  Contact  -->

  <div class = "content-contact"> 
      <form action="#" method="post" class="formular">
        <fieldset class="fieldset">
          <legend class="legend-top"><h2>Trimite-ne un mesaj</h2></legend>
          <p>
            <!-- <label for="e-mail">E-mail</label> -->
            <input type="text" name="e-mail" id="e-mail" placeholder="E-mail" />
          </p>

          <p>
            <!-- <label for="parola">Parola</label> -->
            <input type="password" name="parola" id="parola" placeholder="Parola" />
          </p>
          <p>
              <textarea id="textarea" cols="50" rows="5" placeholder="Trimite-ne un mesaj!"></textarea>
              
          </p>

          <p class="button-wrapper">
            <input type="submit" name="mesaj" id="mesaj" class="buton-formular" value="Trimite mesaj" />
            <input type="reset" name="reset" id="reset" class="buton-formular" value="Resetare" />
          </p>

        </fieldset>
      </form>
  </div>
  <!--  Contact  -->

</body>
</html>