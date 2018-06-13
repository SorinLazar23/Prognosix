<?php session_start(); ?>
<?php

const STUDENT_TYPE = '1';
const PROFESOR_TYPE = '2';

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
    <script src="js/jquery.js"></script>
    <script src="js/main.js"></script>
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
    <?php if(!empty($_SESSION['user'])){ ?>
        <?php if($_SESSION['user']['type'] === STUDENT_TYPE){ ?>
            <div class="content silver no-margin">
                <a href="nota.php?id=1"><img class="object" src="img/BD.jpeg" alt="BD image" /></a>
                <a href="nota.php?id=2"><img class="object" src="img/GPC.png" alt="GPC image" /></a>
                <a href="nota.php?id=3"><img class="object" src="img/TW.jpeg" alt="TW image" /></a>
                <a href="nota.php?id=4"><img class="object" src="img/ML.jpg" alt="ML image" /></a>
                <a href="nota.php?id=5"><img class="object" src="img/IA.png" alt="IA image" /></a>
                <a href="nota.php?id=6"><img class="object" src="img/Python.png" alt="Python image"/></a>
            </div>
        <?php }else if($_SESSION['user']['type'] === PROFESOR_TYPE){ ?>
            <div class="content silver no-margin">
                <form action="uploadPost.php" method="post" class="formular" enctype="multipart/form-data">
                    <fieldset class="fieldset">
                        <legend class="legend-top"><h2>Uploadarea fisierelor cu note</h2></legend>
                        <p>
                            <!-- <label for="e-mail">E-mail</label> -->
                            <?php
                                $conn = new mysqli("localhost", "root", "","Prognosix");

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                $rows = [];

                                if ($result = $conn->query(sprintf('SELECT * from  disciplines WHERE teacher_id="%s"', $_SESSION["user"]["id"]))) {
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $rows[] = $row;
                                        }
                                    }
                                }

                                $conn->close();
                            ?>
                            <select name="disciplina" id="disciplina">
                                <?php foreach($rows as $row){ ?>
                                    <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                <?php } ?>
                            </select>
                        </p>

                        <p>
                            <!-- <label for="parola">Parola</label> -->
                            <input type="file" name="fisier_note" id="fisier_note" placeholder="Fisier Note" />
                        </p>

                        <p class="button-wrapper">
                            <input type="submit" name="upload" id="upload" class="buton-formular" value="Uploadare" />
                            <input type="reset" name="reset" id="reset" class="buton-formular" value="Resetare" />
                        </p>

                    </fieldset>
                </form>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="content silver no-margin">
            <a href="loginFinal.php">Va rog sa va logati.</a>
        </div>
    <?php } ?>
<!--  Content  -->
</body>
</html>