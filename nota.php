<?php

session_start();

$conn = new mysqli("localhost", "root", "","Prognosix");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$probes = [];

if ($result = $conn->query(sprintf('SELECT * from  grade_files WHERE discipline_id=%d', intval($_GET["id"])))) {
    if ($result->num_rows > 0) {
        if($row = $result->fetch_assoc()) {

            $pathinfo = pathinfo($row['url']);

            $id = '';
            $name = '';
            if($pathinfo['extension'] === 'csv'){
                $fd = fopen($row['url'], 'r');
                $header = fgets($fd);
                $header = explode(',', $header);
                unset($header[0]);
                foreach($header as $probe){
                    $id = rtrim(trim($probe), '*');

                    $probes[] = [
                        'id' => $id,
                        'name' => $id
                    ];
                }
            }
        }
    }
}

$conn->close();

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
          <?php foreach($probes as $probe){ ?>
            <li><a href="#"><label for="radio-<?php echo $probe['id']; ?>"><?php echo $probe['name']; ?></label></a></li>
          <?php } ?>
      </ul>
  </div>

	<div class="content-note">
		<form action="calculatePost.php" method="post" class="formular">
        <fieldset class="fieldset">
          <legend class="legend-top"><h2>Acorda o nota</h2></legend>
            <input type="hidden" value="<?php echo $row['id']; ?>" name="grade_file_id" />
            <?php foreach($probes as $probe){ ?>
                <input type="radio" name="runda" value="<?php echo $probe['id']; ?>" id="radio-<?php echo $probe['id']; ?>"/>
            <?php } ?>
          <p>
            <input type="text" name="notaExamen" id="nota-examen" placeholder="Nota ta" />
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