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
    <title>Ajouter Fournisseur</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
 
 
</head>
<body class="client">

<divc class="wrapper">
  <?php require_once('navbar.php');?>
    

  <div class="main_content">
    <h3>Ajouter Fournisseur</h3>
          <div>
                <form action="" method="post">
                  <label for="id_four">id fournisseur</label>
                  <input type="number" id="id_four" name="id_four" placeholder="id fournisseur....">

                  <label for="nom_four">nom</label>
                  <input type="text" id="nom_four" name="nom_four" placeholder="nom de fournisseur...">
                  
                  <label for="tele_four">tele</label>
                  <input type="number" id="tele_four" name="tele_four" placeholder="N de telephone..">
                  
                  <label for="email_four">email</label>
                  <input type="email" id="email_four" name="email_four" placeholder="adresse email..">
                
                  <label for="adresse_four">adresse</label>
                  <input type="text" id="adresse_four" name="adresse_four" placeholder="adresse..">
                
                  <input type="submit"  name="submit" value="Ajouter">
                </form>
          </div>
          <div>
                  <?php
                    require_once('fournissClass.php');
                      $four=new Fourni();
                      
                      if (isset($_POST['submit'])) {
                        $id_four=$_POST['id_four'];
                        $nom_four=$_POST['nom_four'];
                        $tele_four=$_POST['tele_four'];
                        $email_four=$_POST['email_four'];
                        $adresse_four=$_POST['adresse_four'];
                        $four->setid($id_four);
                        $four->setnom($nom_four);
                        $four->settele($tele_four);
                        $four->setemail($email_four);
                        $four->setaddress($adresse_four);
                        $four->save();
                      
                        
                      }

                      
                      
                    $reponse=$four->showAll();

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
                      $email = $ligne['email_four'];
                      $id=$ligne['id_four'];
                      echo "<tr>";
                      echo "<td>";
                      echo $ligne['id_four'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['nom_four'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['tele_four'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['email_four'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['adresse_four'];
                      echo "</td>";
                          echo "<td>";
                      echo "<a style=\"color:blue; width:120%;\" href=\"editFourni.php?id=$id\" ><i class=\"far fa-edit\"></i></a>";
                      echo "</td>";
                          echo "<td>";
                          echo "<a style=\"color:red; width:120%;\" href=\"editFourni.php?email=$email\"><i class=\"far fa-trash-alt\"></i></a>";
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