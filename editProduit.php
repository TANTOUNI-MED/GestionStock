<?php
require_once('produitClass.php');
if (isset($_GET['idS'])) {
    $pr=new produit();
          $pr->setref($_GET['idS']);
           $pr->supprimer();
           header('location:ajouterProduit.php');
                    }
   if (isset($_GET['idU'])) {
            $id=$_GET['idU'];
            $pr=new produit();
            $reponse=$pr->rechercher($id);
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
                    <h3>Modifier Produit</h3>
                        <div>
                        <form action="" method="post">
                            <label for="ref_prod">Ref Produit</label>
                            <input  disabled type="number" value="<?php echo $line['ref_prod']  ?>" placeholder="reference Produit....">
                            <input type="hidden" value="<?php echo $line['ref_prod'] ?>" name="ref_prod" >

                            <label for="libelle">libelle</label>
                            <input type="text" id="libelle" name="libelle" value="<?php echo $line['libelle']  ?>" placeholder="libelle...">
                            <label for="prix_unit">prix unitaire</label>
                            <input type="number" id="prix_unit" name="prix_unit" value="<?php echo $line['prix_unit']  ?>" placeholder="prix unitaire..">
                            <label for="quan_init">quantité initiale</label>
                            <input type="number" id="quan_init" name="quan_init" value="<?php echo $line['quan_init']  ?>" placeholder="quantité initiale..">
                            <label for="prix_achat">prix d'achat</label>
                            <input type="number" id="prix_achat" name="prix_achat" value="<?php echo $line['prix_achat']  ?>" placeholder="prix d'achat..">
                            <label for="prix_vent">prix de vente</label>
                            <input type="number" id="prix_vent" name="prix_vent" value="<?php echo $line['prix_vent']  ?>" placeholder="prix de vente..">
                            <label for="category">Categorie</label>
                            <select  id="category" name="categorie" >
                            <option  disabled>Choisir une categorie</option>
                            <?php
                                require_once('categorieClass.php');
                                $cat=new categorie();
                                $reponse2=$cat->showAll();
                                while ($line2=$reponse2->fetch()) { 
                                    if($line['id_cat']==$line2['id_cat']){
                            ?>
                            <option selected value="<?php echo $line2['id_cat']; ?>"><?php echo $line2['libelle_cat']; ?></option>
                            <?php
                                }else{
                             ?>
                            <option value="<?php echo $line2['id_cat']; ?>"><?php echo $line2['libelle_cat']; ?></option>
                            <?php
                                }
                            }
                            ?>
                            </select>
                            <input type="submit"  name="submit" value="Modifier">
                         </form>
                     </div>
            </div>
            </body>
            </html>
     <?php
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
            $pr->update($id);

           // header('location:ajouterProduit.php');
           echo "<script>window.location.href = 'ajouterProduit.php';</script>";
           }
              
                            
        }
        ?>