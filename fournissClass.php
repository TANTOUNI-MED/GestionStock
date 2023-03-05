<?php
    require_once('connection.php');
    class Fourni{
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
            $co->prepare_execute("insert into  fournisseur  
                                values ('".$this->id."','".$this->nom."','".$this->tele."','".$this->email."','".$this->address."')");
        }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from fournisseur where 1");
        }
        public function update($frid){
            $co=new Conn();
            $co->prepare_execute("update fournisseur set id_four = '".$this->id."',
                                                nom_four = '".$this->nom."',
                                                tele_four = '".$this->tele."',
                                                email_four = '".$this->email."',
                                                adresse_four =' ".$this->address."'
                                                where id_four = '".$frid."'");
        }
        public function rechercher($id){
            $co=new Conn();
            return $co->query("select * from fournisseur where id_four ='".$id."'");

        }
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from fournisseur where email_four ='".$this->email."'");

        }


    }


?>