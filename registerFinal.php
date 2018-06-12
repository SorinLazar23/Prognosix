<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>ProGnosix</title>
    <link href="styleFinal.css" rel="stylesheet" type="text/css">
    
</head>
<body>

<!--  Meniu  -->
  <ul class = "meniu">
    <li><a href="http://localhost/Prognosix/indexFinal.html">Home</a></li>

    <li><a href="#news">News</a></li>

    <li id="meniu-ascuns-sub-500"><a href="#contact">Contact</a>
      <ul>
        <li><a href="http://localhost/Prognosix/contactFinal.html">Laurentiu Cozma</a></li>
            <li><a href="http://localhost/Prognosix/contactFinal.html">Sorin Lazar</a></li>
      </ul>
    </li> 

    <li id="meniu-ascuns-sub-500"><a href="#about">About</a>
        <ul>
          <li><a href="http://localhost/Prognosix/team.html">Our team</a></li>
          <li><a href="http://localhost/Prognosix/prognosix.html">ProGnosix</a></li>
        </ul>
      </li>

      <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/team.html">Our team</a></li>
      <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/prognosix.html">ProGnosix</a></li>
        

      <?php if(isset($_SESSION['user'])){ ?>
  <li id="meniu-ascuns-sub-500"><a href="#">Logout</a></li>
  <?php }else{ ?>
  <li id="meniu-ascuns-sub-500"><a href="#User">User</a>
    <ul>
      <li><a href="http://localhost/Prognosix/loginFinal.php">Login</a></li>
      <li><a href="http://localhost/Prognosix/registerFinal.php">Register</a></li>
    </ul>
  </li>
  <?php } ?>

    <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/loginFinal.html">Login</a></li>
    <li id="meniu-ascuns-peste-500"><a href="http://localhost/Prognosix/registerFinal.html">Register</a></li>
  </ul>
<!--  Meniu  -->

<!--  Registerul  -->

  <div class = "content"> 
      <form action="RegisterPost.php" method="post" class="formular">
        <fieldset class="fieldset">
          <legend class="legend-top"><h2>Inregistrare</h2></legend>
          <p>
            <input type="text" name="e-mail" id="e-mail" placeholder="E-mail" />
          </p>

          <p>
            <input type="text" name="nume" id="nume" placeholder="Nume" />
          </p>

          <p>
            <input type="text" name="prenume" id="prenume" placeholder="Prenume" />
          </p>

          <p>
            <input type="password" name="parola" id="parola" placeholder="Parola" />
          </p>

          <p class="button-wrapper">
            <input type="submit" name="inregistrare" id="inregistrare" class="buton-formular" value="Inregistrare" />
            <input type="reset" name="reset" id="reset" class="buton-formular" value="Resetare" />
          </p>

        </fieldset>
      </form>
  </div>
  <!--  Registerul  -->

</body>
</html>