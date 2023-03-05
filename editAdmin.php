<?php
require_once('adminClass.php');
if (isset($_GET['loginS'])) {
   
    $admin=new admin();
          $admin->setlogin($_GET['loginS']);
           $admin->supprimer();
           header('location:ajouterAdmin.php');
                    }

   if (isset($_GET['loginU'])) {
            $login=$_GET['loginU'];
            $admin=new admin();
            $reponse=$admin->UnAdmin($login);
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
                    <h3>Modifier Admin</h3>
                    
                        <div>
                        <form action="" method="post">
                            <label for="login">Login</label>
                            <input type="text"  name="login" value="<?php echo $line['login']?>" placeholder="Login....">

                            <label for="password">Password</label>
                            <input type="text" name="password" value="<?php echo $line['password']?>"placeholder="password...">
                            
                            <input type="submit"  name="submit" value="Modifier">
                        </form>
                     </div>
            </div>
            </body>
            </html>
            <?php
                      
           if (isset($_POST['submit'])) { 
             $login=$_POST['login'];
             $password=$_POST['password'];
             $admin->setlogin($login);
             $admin->sedtpassword($password);
             $admin->update($login);
           
             header('location:ajouterAdmin.php');
           }
              
                            
            }


                    ?>