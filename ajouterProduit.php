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
    <title>Ajouter Produit</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body class="client">

<divc class="wrapper">
  <?php require_once('navbar.php');?>
    

  <div class="main_content">
    <h3>Ajouter Produit</h3>
          <div>
                <form action="" method="post">
                  <label for="ref_prod">Ref Produit</label>
                  <input type="number" " name="ref_prod" placeholder="reference Produit....">

                  <label for="libelle">libelle</label>
                  <input type="text" name="libelle" placeholder="libelle...">
                  
                  <label for="prix_unit">prix unitaire</label>
                  <input type="number"name="prix_unit" placeholder="prix unitaire..">
                  
                  <label for="quan_init">quantité initiale</label>
                  <input type="number" name="quan_init" placeholder="quantité initiale..">
                
                  <label for="prix_achat">prix d'achat</label>
                  <input type="number" name="prix_achat" placeholder="prix d'achat..">
                
                  <label for="prix_vent">prix de vente</label>
                  <input type="number"  name="prix_vent" placeholder="prix de vente..">
                  <label for="category">Categorie</label>
                  <select  id="category" name="categorie" >
                  <option selected disabled>Choisir une categorie</option>
                  <?php
                    require_once('categorieClass.php');
                    $cat=new categorie();
                    $reponse=$cat->showAll();
                    while ($line=$reponse->fetch()) { 
                 ?>
                        <option value="<?php echo $line['id_cat'] ?>"><?php echo $line['libelle_cat'] ?></option>
                 <?php
                    }
                  ?>
                  </select>
                  <input type="submit"  name="submit" value="Ajouter">
                  
                </form>
          </div>
          <div class="search-container">
             <form action="" method="post">
              <input type="number" name="search" placeholder="rechercher un produit selon son id.." name="search">
              <button type="submit" name="subSearch"><i class="fa fa-search"></i></button>
            </form>
          </div>
          <div>
                  <?php
                    require_once('produitClass.php');
                      $pr=new produit();  
                      
                      if (isset($_POST['submit'])) {
                        $ref_prod=$_POST['ref_prod'];
                        $libelle=$_POST['libelle'];
                        $prix_unit=$_POST['prix_unit'];
                        $quan_init=$_POST['quan_init'];
                        $prix_achat=$_POST['prix_achat'];
                        $prix_vent=$_POST['prix_vent'];
                        $categorie=$_POST['categorie'];
                        $pr->setref($ref_prod);
                        $pr->setlibelle($libelle);
                      $pr->setprix_unit($prix_unit);
                      $pr->setquan_init($quan_init);
                      $pr->setprix_achat($prix_achat);
                      $pr->setprix_vent($prix_vent);
                      $pr->setid_cat($categorie);
                      $pr->save();
                    
                    
                      }
                      if (isset($_POST['subSearch'])) {
                        $ref_prod=$_POST['search'];
                        $reponse=$pr->rechercher($ref_prod);
                        if (!$reponse->fetch()) {
                          echo "<p  style='color:green; text-align:center; font-size: 30px;'> le produit n'existe pas !! </p>";
                        }
                        $reponse=$pr->rechercher($ref_prod);

                      }else{
                        $reponse=$pr->ProdCat();
                      }
                     
                 ?>
                    <table>
                      <th>REF</th>
                      <th>LIBELLE</th>
                      <th>PRIX UNITAIRE</th>
                      <th>QUANTITE INITIAL</th>
                      <th>PRIX ACHAT</th>
                      <th>PRIX  VENT</th>
                      <th>CATEGORIE</th>
                        <th></th>
                        <th></th>
                      <?php
                    while($ligne= $reponse->fetch()){
                      $id=$ligne['ref_prod'];
                      echo "<tr>";
                      echo "<td>";
                      echo $ligne['ref_prod'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['libelle'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['prix_unit'];
                      echo "</td>";
                      echo "<td>";
                      if ($ligne['quan_init']<100){
                        $q=$ligne['quan_init'];
                          echo "<P style=\"color:red; \" >$q   À Augmenté!!!</p>";
                      }else{
                         echo $ligne['quan_init'];
                      }
                     
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['prix_achat'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['prix_vent'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['libelle_cat'];
                      echo "</td>";
                          echo "<td>";
                      echo "<a style=\"color:blue; width:120%;\"href=\"editProduit.php?idU=$id\" ><i class=\"far fa-edit\"></i></a>";
                      echo "</td>";
                          echo "<td>";
                          echo "<a style=\"color:red; width:120%;\"  href=\"editProduit.php?idS=$id\"><i class=\"far fa-trash-alt\"></i></a>";
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