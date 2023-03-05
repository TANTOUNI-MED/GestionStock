<?php
require_once('commandeClass.php');
require_once('commandeProduitClass.php');
if (isset($_GET['numS'])) {
    $cm=new commande();
          $cm->setnum_com($_GET['numS']);
           $cm->supprimer();
           header('location:ajouterCommande.php');
                    }
   if (isset($_GET['numU'])) {
            $num=$_GET['numU'];
            $cm=new commande();
            $reponse=$cm->UnComProd($num);
            $line=$reponse->fetch();
            
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="style.css">
                <title>Modifier</title>
            </head>
            <body class="client">
                <divc class="wrapper">
                <?php require_once('navbar.php');?>
                <div class="main_content">
                    <h3>Modifier Commande</h3>
                        <div>
                          <form action="" method="post">
                            <label for="num_com">Num Commande</label>
                            <input disabled type="number" value="<?php echo $line['num_com'] ?>" placeholder="Numero de commande....">
                            <input type="hidden" value="<?php echo $line['num_com'] ?>" name="num_com" >

                            <label for="date">La Date De Commande</label>
                            <input type="date" id="date" value="<?php echo $line['date'] ?>" name="date" placeholder="date..">
                            
                            <label for="id_cli">Client</label>
                            <select  id="id_cli" name="id_cli" >
                            <option disabled>Choisir un Client</option>
                            <?php 
                                require_once('clientClass.php');
                                $cli=new client();
                                
                                $reponse=$cli->showAll();
                                while ($line1=$reponse->fetch()) { 
                                    if ($line1['id_cli']==$line['id_cli']) {
                             ?>
                              <option selected value="<?php echo $line1['id_cli'] ?>"><?php echo $line1['email_cli'] ?></option>
                                 <?php    
                                    }else{
                                  ?>
                                    <option value="<?php echo $line1['id_cli'] ?>"><?php echo $line1['email_cli'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                            </select>

                            <label for="ref_prod">produit</label>
                            <select  id="ref_prod" name="ref_prod" >
                            <option  disabled>Choisir une Produit</option>
                            <?php
                                require_once('produitClass.php');
                                $pr=new produit();
                                $reponse=$pr->showAll();
                                while ($line1=$reponse->fetch()) { 
                                    if ($line1['ref_prod']==$line['ref_prod']){
                          ?>
                                        <option selected value="<?php echo $line1['ref_prod'] ?>"><?php echo $line1['libelle'] ?></option>
                         <?php 
                                     }else{
                                  
                            ?>
                                    <option  value="<?php echo $line1['ref_prod'] ?>"><?php echo $line1['libelle'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                            </select>
                            <label for="quan_prod">Quantite de Produit</label>
                            <input type="number"  value="<?php echo $line['quan_prod'] ?>" id="quan_prod" name="quan_prod" placeholder="quantite de produit....">

                            
                            <input type="submit"  name="submit" value="Modifier">
                  
                          </form>
                     </div>
            </div>
            </body>
            </html>
     <?php
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
        $cmpr->setnum_com($num_com);
        $cmpr->setquan_prod($quan_prod);
        $cmpr->setref_prod($ref_prod);
        $cm->update($num);
        $cmpr->update($num);
      
       header('location:ajouterCommande.php'); 
         }
            
        //    echo "<script>window.location.href = 'ajouterProduit.php';</script>";
     }
              
                            
        
        ?>