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
    <title>Ajouter Admin</title>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
 
 
</head>
<body class="client">

<divc class="wrapper">
  <?php require_once('navbar.php');?>
    

  <div class="main_content">
    <h3>AJOUTER ADMIN</h3>
          <div>
                <form action="" method="post">
                  <label for="login">Login</label>
                  <input type="text"  name="login" placeholder="Login....">

                  <label for="password">Password</label>
                  <input type="text" name="password" placeholder="password...">
                
                  <input type="submit"  name="submit" value="Ajouter">
                </form>
          </div>
          <div>
                  <?php
                    require_once('adminClass.php');
                      $admin=new admin();
                      
                      if (isset($_POST['submit'])) {
                        $login=$_POST['login'];
                        $password=$_POST['password'];
                        $admin->setlogin($login);
                        $admin->sedtpassword($password);
                        $admin->save();
                      
                      
                        
                      }

                      
                      
                    $reponse=$admin->showAll();

                    // $co = new conn();

                    // $requete="select * from client where 1";
                    // $reponse = $co->query($requete);   
                    ?>
                    <table>
                    <th>LOGIN</th>
                      <th>PASSWORD</th>
                        <th></th>
                        <th></th>
                      <?php
                    while($ligne= $reponse->fetch()){
                      $lo=$ligne['login'];
                      echo "<tr>";
                      echo "<td>";
                      echo $ligne['login'];
                      echo "</td>";
                      echo "<td>";
                      echo $ligne['password'];
                      echo "</td>";
                          echo "<td>";
                      echo "<a style=\"color:blue; width:120%;\" href=\"editAdmin.php?loginU=$lo\" ><i class=\"far fa-edit\"></i></a>";
                      echo "</td>";
                          echo "<td>";
                          echo "<a style=\"color:red; width:120%;\" href=\"editAdmin.php?loginS=$lo\"><i class=\"far fa-trash-alt\"></i></a>";
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