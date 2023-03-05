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
    <title>Ajouter Categorie</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
 
 
</head>
<body class="client">

<divc class="wrapper">
  <?php require_once('navbar.php');?>
    

  <div class="main_content">
    <h3>Ajouter Categorie</h3>
          <div>
                <form action="" method="post">
                  <label for="id_cat">Id Categorie</label>
                  <input type="number" id="id_cat" name="id_cat" placeholder="id categorie....">

                  <label for="libelle">libelle</label>
                  <input type="text" id="libelle_cat" name="libelle_cat" placeholder="libelle...">
                
                  <input type="submit"  name="submit" value="Ajouter">
                </form>
          </div>
          <div>
                  <?php
                    require_once('categorieClass.php');
                      $cat=new categorie();
                      
                      if (isset($_POST['submit'])) {
                        $id_cat=$_POST['id_cat'];
                        $libelle_cat=$_POST['libelle_cat'];
                        $cat->setid_cat($id_cat);
                        $cat->setlibelle_cat($libelle_cat);
                        $cat->save();
                      
                      
                        
                      }

                      
                      
                    $reponse=$cat->showAll();

                    // $co = new conn();

                    // $requete="select * from client where 1";
                    // $reponse = $co->query($requete);   
                    ?>
                    <table>
                    <th>ID CATEGORIE</th>
                      <th>LIBELLE</th>
                        <th></th>
                        <th></th>
                      <?php
                    while($ligne= $reponse->fetch()){
                      $id=$ligne['id_cat'];
                      echo "<tr>";
                      echo "<td>";
                      echo $ligne['id_cat'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['libelle_cat'];
                      echo "</td>";
                          echo "<td>";
                      echo "<a style=\"color:blue; width:120%;\" href=\"editCategorie.php?idU=$id\" ><i class=\"far fa-edit\"></i></a>";
                      echo "</td>";
                          echo "<td>";
                          echo "<a style=\"color:red; width:120%;\" href=\"editCategorie.php?idS=$id\"><i class=\"far fa-trash-alt\"></i></a>";
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