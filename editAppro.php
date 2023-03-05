<?php
require_once('approClass.php');
require_once('approProduitClass.php');
if (isset($_GET['numS'])) {
          $ap=new appro();
          $ap->setnum_appro($_GET['numS']);
           $ap->supprimer();
           header('location:ajouterAppro.php');
                    }
   if (isset($_GET['numU'])) {
            $num=$_GET['numU'];
            $ap=new appro();
            $reponse=$ap->UnApproProd($num);
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
                    <h3>Modifier Approvisionnement</h3>
                        <div>
                          <form action="" method="post">
                            <label for="num_appro">Num Approvisionnement</label>
                            <input disabled type="number" value="<?php echo $line['num_appro'] ?>" placeholder="Numero de commande....">
                            <input type="hidden" value="<?php echo $line['num_appro'] ?>" name="num_appro" >

                            <label for="date">La Date D'Approvisionnement</label>
                            <input type="date" value="<?php echo $line['date'] ?>" name="date" placeholder="date..">
                            
                            <label for="id_cli">Fournisseur</label>
                            <select  id="id_cli" name="id_cli" >
                            <option disabled>Choisir un Fournisseur</option>
                            <?php 
                                require_once('fournissClass.php');
                                $four=new Fourni();
                                
                                $reponse=$four->showAll();
                                while ($line1=$reponse->fetch()) { 
                                    if ($line1['id_four']==$line['id_four']) {
                             ?>
                              <option selected value="<?php echo $line1['id_four'] ?>"><?php echo $line1['email_four'] ?></option>
                                 <?php    
                                    }else{
                                  ?>
                                    <option value="<?php echo $line1['id_four'] ?>"><?php echo $line1['email_four'] ?></option>
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
                            <label for="quan_appro">Quantite d'Approvisionnement</label>
                            <input type="number"  value="<?php echo $line['quan_appro'] ?>"  name="quan_appro" placeholder="quantite de produit....">

                            
                            <input type="submit"  name="submit" value="Modifier">
                  
                          </form>
                     </div>
            </div>
            </body>
            </html>
     <?php
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
        $appr->setnum_appro($num_appro);
        $appr->setquan_appro($quan_appro);
        $appr->setref_prod($ref_prod);
        $appr->update($num);
        $appr->update($num);
      
       header('location:ajouterAppro.php'); 
         }
            
        //    echo "<script>window.location.href = 'ajouterProduit.php';</script>";
     }
              
                            
        
        ?>