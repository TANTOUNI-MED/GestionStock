<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>home</title>

</head>

<body>

  <divc class="wrapper">
    <?php require_once('navbar.php'); ?>

    <div class="main_contentH">
      <div class="moha">
        <?php
        echo "<p class=\"texth\">";
        echo "Bienvenue " . " " . $_SESSION['login'];
        echo "</p>";
        ?>

        <h3 class="text2h">
          Gestion De Stock
        </h3>
        <p class="kl">.
        </p>
      </div>

    </div>
    </div>
</body>

</html>