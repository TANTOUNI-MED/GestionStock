<?php
require_once('categorieClass.php');
if (isset($_GET['idS'])) {
   
    $cat=new categorie();
          $cat->setid_cat($_GET['idS']);
           $cat->supprimer();
           header('location:ajouterCategorie.php');
                    }

   if (isset($_GET['idU'])) {
            $id=$_GET['idU'];
            $cat=new categorie();
            $reponse=$cat->rechercher($id);
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
                    <h3>Modifier Categorie</h3>
                    
                        <div>
                            <form action="" method="post">
                                <label for="id_cat">Id Categorie</label>
                                <input disabled type="number" value="<?php echo $line['id_cat'] ?>" placeholder="id categorie....">
                                <input type="hidden" value="<?php echo $line['id_cat'] ?>" name="id_cat" placeholder="id categorie....">

                                <label for="libelle_cat">libelle</label>
                                <input type="text" value="<?php echo $line['libelle_cat'] ?>" name="libelle_cat" placeholder="libelle...">
                                
                                <input type="submit"  name="submit" value="Modifier">
                                </form>
                     </div>
            </div>
            </body>
            </html>
            <?php
           
                      
           if (isset($_POST['submit'])) { 
             $id_cat=$_POST['id_cat'];
             $libelle_cat=$_POST['libelle_cat'];
             $cat->setid_cat($id_cat);
             $cat->setlibelle_cat($libelle_cat);
             $cat->update($id);
           
             header('location:ajouterCategorie.php');
           }
              
                            
            }


                    ?>