<?php

    require_once('connection.php');
    class admin{
        private $id_user;
        private $password;
        private $login;
        
        public function __construct(){

        }
        public function getpassword(){
            return $this->password;
        }
        public function getlogin(){
            return $this->login;
        }

        public function sedtpassword($password){
            $this->password=$password;
        }
        public function setlogin($login){
            $this->login=$login;
        }

        public function save(){
            $co=new Conn();
            $co->prepare_execute("insert into  users  (password,login)
                                values ('".$this->password."','".$this->login."')");
        }
        public function showAll(){
            $co=new Conn();
            return $co->query("select password,login from users where 1");
        }
        public function update($login){
            $co=new Conn();
            $co->prepare_execute("update users set password ='".$this->password."',
                                         login = '".$this->login."'
                                                where login = '".$login."'");
        }
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from users where login ='".$this->login."'");

            
        }
        public function testLogin(){
            
            $co=new Conn();
            return $co->query("select password,login from users where password ='".$this->password."' and login ='".$this->login."'");
            

        }
        public function UnAdmin($login){
            $co=new Conn();
            return $co->query("select password,login from users where login='".$login."';");
        }

    }


?>