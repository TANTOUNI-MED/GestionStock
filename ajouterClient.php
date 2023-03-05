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
    <title>Ajouter Client</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body class="client">

<divc class="wrapper">
  <?php require_once('navbar.php');?>
    

  <div class="main_content">
    <h3>Ajouter Client</h3>
          <div>
                <form action="" method="post">
                  <label for="id_cli">id client</label>
                  <input type="number" id="id_cli" name="id_cli" placeholder="id client....">

                  <label for="nom_cli">nom</label>
                  <input type="text" id="nom_cli" name="nom_cli" placeholder="nom de client...">
                  
                  <label for="tele_cli">tele</label>
                  <input type="number" id="tele_cli" name="tele_cli" placeholder="N de telephone..">
                  
                  <label for="email_cli">email</label>
                  <input type="email" id="email_cli" name="email_cli" placeholder="adresse email..">
                
                  <label for="adresse_cli">adresse</label>
                  <input type="text" id="adresse_cli" name="adresse_cli" placeholder="adresse..">
                
                  <input type="submit"  name="submit" value="Ajouter">
                </form>
          </div>
          <div>
                  <?php
                    require_once('clientClass.php');
                      $cli=new client();
                      
                      if (isset($_POST['submit'])) {
                        $id_cli=$_POST['id_cli'];
                        $nom_cli=$_POST['nom_cli'];
                        $tele_cli=$_POST['tele_cli'];
                        $email_cli=$_POST['email_cli'];
                        $adresse_cli=$_POST['adresse_cli'];
                        $cli->setid($id_cli);
                        $cli->setnom($nom_cli);
                      $cli->settele($tele_cli);
                      $cli->setemail($email_cli);
                      $cli->setaddress($adresse_cli);
                      $cli->save();
                      
                        
                      }

                      
                      
                    $reponse=$cli->showAll();

                    // $co = new conn();

                    // $requete="select * from client where 1";
                    // $reponse = $co->query($requete);   
                    ?>
                    <table>
                    <th>ID</th>
                      <th>NOM</th>
                      <th>TELE</th>
                      <th>EMAIL</th>
                      <th>ADRESSE</th>
                        <th></th>
                        <th></th>
                      <?php
                    while($ligne= $reponse->fetch()){
                      $email = $ligne['email_cli'];
                      $id=$ligne['id_cli'];
                      echo "<tr>";
                      echo "<td>";
                      echo $ligne['id_cli'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['nom_cli'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['tele_cli'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['email_cli'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['adresse_cli'];
                      echo "</td>";
                          echo "<td>";
                      echo "<a style=\"color:blue; width:120%;\" href=\"editClient.php?id=$id\" ><i class=\"far fa-edit\"></i></a>";
                      echo "</td>";
                          echo "<td>";
                          echo "<a style=\"color:red; width:120%;\" href=\"editClient.php?email=$email\"><i class=\"far fa-trash-alt\"></i></a>";
                      echo "</td>";

                      echo "</tr>";

                      
                    }
                  
                    ?>
                    </table>
           </div>
  </div>
</div>
</body>
</html>