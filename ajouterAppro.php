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
    <title>Ajouter Approvisionnement</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body class="client">

<divc class="wrapper">
  <?php require_once('navbar.php');?>
    

  <div class="main_content">
    <h3>Ajouter Approvisionnement</h3>
          <div>

                <form action="" method="post">
                  <label for="num_appro">Num Approvisionnement</label>
                  <input type="number"  name="num_appro" placeholder="Numero d'Approvisionnement....">

                  <label for="date">La Date D'Approvisionnement</label>
                  <input type="date" name="date" placeholder="date..">
                  
                   <label for="id_four">Fournisseur</label>
                  <select   name="id_four" >
                  <option selected disabled>Choisir un fournisseur</option>
                  <?php
                    require_once('fournissClass.php');
                    $four=new Fourni();
                    $reponse=$four->showAll();
                    while ($line=$reponse->fetch()) { 
                 ?>
                        <option value="<?php echo $line['id_four'] ?>"><?php echo $line['email_four'] ?></option>
                 <?php
                    }
                  ?>
                  </select>

                  <label for="ref_prod">produit</label>
                  <select  id="ref_prod" name="ref_prod" >
                  <option selected disabled>Choisir un Produit</option>
                  <?php
                    require_once('produitClass.php');
                    $pr=new produit();
                    $reponse=$pr->showAll();
                    while ($line=$reponse->fetch()) { 
                 ?>
                        <option value="<?php echo $line['ref_prod'] ?>"><?php echo $line['libelle'] ?></option>
                 <?php
                    }
                  ?>
                  </select>
                  <label for="quan_appro">Quantite d'Approvisionnement</label>
                  <input type="number"  name="quan_appro" placeholder="quantite d'Approvisionnement....">

                  
                  <input type="submit"  name="submit" value="Ajouter">
                  
                </form>
          </div>
          <div class="search-container">
            <div>
             <form action="" method="post">
              <input type="number" name="search" placeholder="rechercher une Approvisionnement selon son num.." name="search">
              <button type="submit" name="subSearch"><i class="fa fa-search"></i></button>
            </form>
          </div>
         </div>
          <div>
                  <?php
                    require_once('approClass.php');
                    require_once('approProduitClass.php');
                    $ap=new appro();
                      $appr=new approProduit();  
                      if (isset($_POST['submit'])) {
                        $num_appro=$_POST['num_appro'];
                        $date=$_POST['date'];
                        $id_four=$_POST['id_four'];
                        $ref_prod=$_POST['ref_prod'];
                        $quan_appro=$_POST['quan_appro'];

                        $ap->setnum_appro($num_appro);
                        $ap->setdate($date);
                        $ap->setid_four($id_four);
                        $appr->setquan_appro($quan_appro);
                        $appr->setref_prod($ref_prod);
                        $ap->save();
                        if($num_appro){
                            $appr->setnum_appro($num_appro);
                        }else{
                            $appr->setnum_appro($ap->getnum_appro());
                        }
                        $appr->save();
                      
                        
                      }
                      if (isset($_POST['subSearch'])) {
                        $num=$_POST['search'];
                        $reponse=$ap->UnApproProd($num);
                        if (!$reponse->fetch()) {
                          echo "<p  style='color:green; text-align:center; font-size: 30px;'> la Approvisionnement n'existe pas !! </p>";
                        }
                        $reponse=$ap->UnApproProd($num);
                    }else{
                      $reponse=$ap->ApproProd();
                    }

 
                   
                    ?>
                    <table>
                      <th>ID FOURNISSEUR</th>
                      <th>NUM APPROVISIONNEMENT</th>
                      <th>DATE</th>
                      <th>REFERENCE PRODUIT</th>
                      <th>QUANTITE APPROVISIONNEMENT</th>
                        <th></th>
                        <th></th>
                      <?php
                    while($ligne= $reponse->fetch()){
                      $num_appro=$ligne['num_appro'];
                      echo "<tr>";
                      echo "<td>";
                      echo $ligne['id_four'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['num_appro'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['date'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['ref_prod'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['quan_appro'];
                      echo "</td>";
                      echo "<td>";
                      echo "<a style=\"color:blue; width:120%;\"href=\"editAppro.php?numU=$num_appro\" ><i class=\"far fa-edit\"></i></a>";
                      echo "</td>";
                      echo "<td>";
                      echo "<a style=\"color:red; width:120%;\"  href=\"editAppro.php?numS=$num_appro\"><i class=\"far fa-trash-alt\"></i></a>";
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