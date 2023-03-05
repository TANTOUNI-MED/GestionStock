<?php
    require_once('connection.php');
    class client{
        private $id;
        private $nom;
        private $tele;
        private $email;
        private $address;
        public function __construct(){

        }
        public function getid(){
            return $this->id;
        }
        public function getnom(){
            return $this->nom;
        }

        public function gettele(){
            return $this->tele;
        }
        public function getemail(){
            return $this->email;
        }
        public function getaddress(){
            return $this->address;
        }
        public function setid($id){
            $this->id=$id;
        }
        public function setnom($nom){
            $this->nom=$nom;
        }

        public function settele($tele){
            $this->tele=$tele;
        }
        public function setemail($email){
            $this->email=$email;
        }
        public function setaddress($ad){
            $this->address=$ad;
        }
        public function save(){
            $co=new Conn();
            $co->prepare_execute("insert into  client   
                                values ('".$this->id."','".$this->nom."','".$this->tele."','".$this->email."','".$this->address."')");
        }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from client where 1");
        }
        public function update($ucid){
            $co=new Conn();
            $co->prepare_execute("update client set id_cli = '".$this->id."',
                                                nom_cli = '".$this->nom."',
                                                tele_cli = '".$this->tele."',
                                                email_cli = '".$this->email."',
                                                adresse_cli =' ".$this->address."'
                                                where id_cli = '".$ucid."'");
        }
        public function rechercher($id){
            $co=new Conn();
            return $co->query("select * from client where id_cli='".$id."';");

        }
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from client where email_cli ='".$this->email."'");

        }


    }


?>