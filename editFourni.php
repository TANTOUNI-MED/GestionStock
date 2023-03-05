<?php
require_once('fournissClass.php');
if (isset($_GET['email'])) {
   
    $four=new Fourni();
          $four->setemail($_GET['email']);
           $four->supprimer();
           header('location:ajouterFourni.php');
                    }

   if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $four=new Fourni();
            $reponse=$four->rechercher($id);
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
                    <h3>Modifier Fournisseur</h3>
                        <div>
                          <form action="" method="post">
                            <label for="id_four">id fournisseur</label>
                            <input disabled type="number" value="<?php  echo $line['id_four'] ?>" name="id_four" placeholder="id fournisseur....">
                            <input type="hidden" value="<?php echo $line['id_four'] ?>" name="id_four" >

                            <label for="nom_four">nom</label>
                            <input type="text" id="nom_four" value="<?php  echo $line['nom_four'] ?>" name="nom_four" placeholder="nom de fournisseur...">
                            
                            <label for="tele_four">tele</label>
                            <input type="number" id="tele_four" value="<?php  echo $line['tele_four'] ?>" name="tele_four" placeholder="N de telephone..">
                            
                            <label for="email_four">email</label>
                            <input type="email" id="email_four" value="<?php  echo $line['email_four'] ?>" name="email_four" placeholder="adresse email..">
                            
                            <label for="adresse_four">adresse</label>
                            <input type="text" id="adresse_four" value="<?php  echo $line['adresse_four'] ?>" name="adresse_four" placeholder="adresse..">
                            
                            <input type="submit"  name="submit" value="Modifier">
                            </form>
                     </div>
            </div>
            </body>
            </html>
            <?php
        
                      
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
             
             $four->update($id);
           
           header('location:ajouterFourni.php');
           }
              
                            
            }


                    ?>