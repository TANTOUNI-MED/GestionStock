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
    <title>Ajouter Commande</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
 
</head>
<body class="client">

<divc class="wrapper">
  <?php require_once('navbar.php');?>
    

  <div class="main_content">
    <h3>Ajouter Commande</h3>
          <div>

                <form action="" method="post">
                  <label for="num_com">Num Commande</label>
                  <input type="number" id="num_com" name="num_com" placeholder="Numero de commande....">

                  <label for="date">La Date De Commande</label>
                  <input type="date" id="date" name="date" placeholder="date..">
                  
                   <label for="id_cli">Client</label>
                  <select  id="id_cli" name="id_cli" >
                  <option selected disabled>Choisir un Client</option>
                  <?php
                    require_once('clientClass.php');
                    $cli=new client();
                    $reponse=$cli->showAll();
                    while ($line=$reponse->fetch()) { 
                 ?>
                        <option  value="<?php echo $line['id_cli'] ?>"><?php echo $line['email_cli'] ?></option>
                 <?php
                    }
                  ?>
                  </select>

                  <label for="ref_prod">produit</label>
                  <select  id="ref_prod" name="ref_prod" >
                  <option selected disabled>Choisir une Produit</option>
                  <?php
                    require_once('produitClass.php');
                    $pr=new produit();
                    $reponse=$pr->showAll();
                    while ($line=$reponse->fetch()) { 
                 ?>
                        <option  value="<?php echo $line['ref_prod'] ?>"><?php echo $line['libelle'] ?></option>
                 <?php
                    }
                  ?>
                  </select>
                  <label for="quan_prod">Quantite de Produit</label>
                  <input type="number" name="quan_prod" min="1" max="100"  placeholder="quantite de produit....">

                  
                  <input type="submit"  name="submit" value="Ajouter">
                  
                </form>
          </div>
          <div class="search-container">
            <div>
             <form action="" method="post">
              <input type="number" name="search" placeholder="rechercher une commande selon son num.." name="search">
              <button type="submit" name="subSearch"><i class="fa fa-search"></i></button>
            </form>
           </div>
         </div>
          <div>
                  <?php
                    require_once('commandeClass.php');
                    require_once('commandeProduitClass.php');
                    $cm=new commande();
                      $cmpr=new commandeProduit();  
                      if (isset($_POST['submit'])) {
                        $num_com=$_POST['num_com'];
                        $date=$_POST['date'];
                        $id_cli=$_POST['id_cli'];
                        $ref_prod=$_POST['ref_prod'];
                        $quan_prod=$_POST['quan_prod'];
                        $cm->setnum_com($num_com);
                        $cm->setdate($date);
                        $cm->setid_cli($id_cli);
                        $cmpr->setquan_prod($quan_prod);
                        $cmpr->setref_prod($ref_prod);
                        $cm->save();
                        if($num_com){
                            $cmpr->setnum_com($num_com);
                        }else{
                            $cmpr->setnum_com($cm->getnum_com());
                        }
                        $cmpr->save();
                      
                        
                      }
                    if (isset($_POST['subSearch'])) {
                        $num=$_POST['search'];
                        $reponse=$cm->UnComProd($num);
                        if (!$reponse->fetch()) {
                          echo "<p  style='color:green; text-align:center; font-size: 30px;'> la commande n'existe pas !! </p>";
                        }
                        $reponse=$cm->UnComProd($num);
                    }else{
                      $reponse=$cm->ComProd();
                    }
                      
                   
                    
                   
                    ?>
                    <table>
                      <th>ID CLIENT</th>
                      <th>NUM COMMANDE</th>
                      <th>DATE</th>
                      <th>REFERENCE PRODUIT</th>
                      <th>QUANTITE PRODUIT</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      <?php
                    while($ligne= $reponse->fetch()){
                      $num_com=$ligne['num_com'];
                      echo "<tr>";
                      echo "<td>";
                      echo $ligne['id_cli'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['num_com'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['date'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['ref_prod'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['quan_prod'];
                      echo "</td>";
                      echo "<td>";
                      echo "<a style=\"color:blue; width:120%;\"href=\"editCommande.php?numU=$num_com\" ><i class=\"far fa-edit\"></i></a>";
                      echo "</td>";
                      echo "<td>";
                      echo "<a style=\"color:red; width:120%;\"  href=\"editCommande.php?numS=$num_com\"><i class=\"far fa-trash-alt\"></i></a>";
                      echo "</td>";
                      echo "<td>";
                      echo "<a style=\"color:#4CAF50; width:120%;\"  href=\"imprimer.php?num=$num_com\"><i class=\"fas fa-print\"></i></a>";
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