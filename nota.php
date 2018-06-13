<?php

session_start();

$conn = new mysqli("localhost", "root", "","Prognosix");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$probes = [];
$requiredProbes = [];
$showGrades = true;

if ($result = $conn->query(sprintf('SELECT * from  grade_files WHERE discipline_id=%d', intval($_GET["id"])))) {
    if ($result->num_rows > 0) {
        if($row = $result->fetch_assoc()) {

            $result2 = $conn->query(sprintf('SELECT * from grades WHERE user_id = %d AND discipline_id = %d', intval($_SESSION['user']['id']), intval($_GET['id'])));

            $usedProbes = [];
            if($result2->num_rows > 0){
                while($row2 = $result2->fetch_assoc()){
                    $usedProbes[] = $row2['round'];
                }
            }

            $pathinfo = pathinfo($row['url']);

            if($pathinfo['extension'] === 'csv'){
                $fd = fopen($row['url'], 'r');
                $header = fgets($fd);
                $header = explode(',', $header);
                unset($header[0]);
                foreach($header as $probe){
                    $isProbeRequired = strpos($probe, '*', -1) !== false ? true : false;

                    $id = rtrim(trim($probe), '*');

                    if($isProbeRequired){
                        $requiredProbes[] = $id;
                    }

                    if(!in_array($id, $usedProbes)){
                        $probes[] = [
                            'id' => $id,
                            'name' => $id
                        ];
                    }
                }

                foreach($requiredProbes as $probe){
                    if(!in_array($probe, $usedProbes)){
                        $showGrades = false;
                    }
                }
            }else if($pathinfo['extension'] === 'json'){
                $students = json_decode(file_get_contents($row['url']), true);

                foreach($students as $student){
                    if($student['nume_prenume'] === $_SESSION['user']['name']){
                        foreach($student['note'] as $key => $proba){

                            $isProbeRequired = $proba['obligatoriu'];

                            if($isProbeRequired){
                                $requiredProbes[] = $key;
                            }

                            if(!in_array($key, $usedProbes)){
                                $probes[] = [
                                    'id' => $key,
                                    'name' => $proba['denumire']
                                ];
                            }
                        }
                        break;
                    }
                }

                foreach($requiredProbes as $probe){
                    if(!in_array($probe, $usedProbes)){
                        $showGrades = false;
                    }
                }
            }else if($pathinfo['extension'] === 'xml'){
                $students = json_decode(json_encode(simplexml_load_file($row['url'])), true);

                foreach($students as $student){
                    if($student['nume_prenume'] === $_SESSION['user']['name']){
                        foreach($student['note'] as $key => $proba){

                            $isProbeRequired = $proba['obligatoriu'] === "true" ? true : false;

                            if($isProbeRequired){
                                $requiredProbes[] = $key;
                            }

                            if(!in_array($key, $usedProbes)){
                                $probes[] = [
                                    'id' => $key,
                                    'name' => $proba['denumire']
                                ];
                            }
                        }
                        break;
                    }
                }

                foreach($requiredProbes as $probe){
                    if(!in_array($probe, $usedProbes)){
                        $showGrades = false;
                    }
                }
            }
        }
    }
}

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

    <li><a rel="alternate" href="http://localhost/Prognosix/newsFinal.php" title="My RSS feed" type="application/rss+xml">News</a></li>

    <!--<li class="meniu-ascuns-sub-500"><a href="#contact">Contact</a>
        <ul>
            <li><a href="http://localhost/Prognosix/contactFinal.php">Laurentiu Cozma</a></li>
            <li><a href="http://localhost/Prognosix/contactFinal.php">Sorin Lazar</a></li>
        </ul>
    </li>-->

    <?php if($showGrades){ ?>
        <li class="meniu-ascuns-sub-500"><a href="#contact">Notele mele</a>
            <ul>
                <li><a href="http://localhost/Prognosix/exportCSV.php?id=<?php echo $_GET['id']; ?>">CSV</a></li>
                <li><a href="http://localhost/Prognosix/exportPDF.php?id=<?php echo $_GET['id']; ?>">PDF</a></li>
            </ul>
        </li>
    <?php } ?>

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

    <?php if(!empty($probes)){ ?>
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
                <input type="text" name="nota" id="nota-examen" placeholder="Nota ta" />
              </p>

              <p class="button-wrapper">
                <input type="submit" name="calculare" id="calculare" class="buton-formular" value="Calculare" />
                <input type="reset" name="reset" id="reset" class="buton-formular" value="Resetare" />
              </p>
            </fieldset>
          </form>
        </div>
      <!--  Acordare nota  -->
    <?php }else{ ?>
        <div class="content-note">
            <p class="mesaj">Nu mai sunt probe la care poti sa ghicesti nota.</p>
        </div>
    <?php } ?>
</body>
</html>

<?php

$conn->close();

?>