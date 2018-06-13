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

    <!--<li class="meniu-ascuns-sub-500"><a href="#contact">Contact</a>
        <ul>
            <li><a href="http://localhost/Prognosix/contactFinal.php">Laurentiu Cozma</a></li>
            <li><a href="http://localhost/Prognosix/contactFinal.php">Sorin Lazar</a></li>
        </ul>
    </li>-->

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


	<div class="content silver evaluare-nota">
		<h4> Ups!... Din pacate nu te-ai autoevaluat bine!</h4>
		<h4> Nota ta la exemen este: 10 cu felicitari!</h4>
		<h4> Nota introdusa de tine: 4 </h4>
		<h4> Nota ta va fi scazuta cu M punte :( </h4>
    </div>


<!--  Content  -->
</body>
</html>