<?php
require_once('clientClass.php');
if (isset($_GET['email'])) {
   
    $cli=new client();
          $cli->setemail($_GET['email']);
           $cli->supprimer();
           header('location:ajouterClient.php');
                    }

   if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $cli=new client();
            $reponse=$cli->rechercher($id);
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
                    <h3>Modifier Client</h3>
                        <div>
                            <form action="" method="post">
                                <label for="id_cli">id client</label>
                                <input disabled type="number" id="id_cli"  value="<?php  echo $line['id_cli'] ?>" placeholder="id client...">
                                <input type="hidden" value="<?php echo $line['id_cli'] ?>" name="id_cli">

                                <label for="nom_cli">nom</label>
                                <input type="text" id="nom_cli" name="nom_cli" value="<?php echo $line['nom_cli'] ?>" placeholder="nom ce client...">
                                
                                <label for="tele_cli">tele</label>
                                <input type="number" id="tele_cli" name="tele_cli" value="<?php echo $line['tele_cli'] ?>" placeholder="N de telephone..">
                                
                                <label for="email_cli">email</label>
                                <input type="email" id="email_cli" name="email_cli" value="<?php echo $line['email_cli'] ?>" placeholder="adresse email..">
                                
                                <label for="adresse_cli">adresse</label>
                                <input type="text" id="adresse_cli" name="adresse_cli" value="<?php echo $line['adresse_cli'] ?>" placeholder="adresse..">
                                
                                <input type="submit"  name="submit" value="Modifier">
                                </form>
                     </div>
            </div>
            </body>
            </html>
            <?php
           
                      
           if (isset($_POST['submit'])) {
             $id_cli=$_POST['id_cli'];
             $nom_cli=$_POST['nom_cli'];
             $tele_cli=$_POST['tele_cli'];
             $email_cli=$_POST['email_cli'];
             $adresse_cli=$_POST['adresse_cli'];
             $cli->setid($id_cli);
             $cli->setnom($nom_cli);
             $cli->settele($tele_cli);
             $cli->setemail($email_cli);
             $cli->setaddress($adresse_cli);
             $cli->update($id);
           
           header('location:ajouterClient.php');
           }
              
                            
            }


                    ?>