<?php
    require_once('connection.php');
    class categorie{
        private $id_cat;
        private $libelle_cat;
        
        public function __construct(){

        }
        public function getid_cat(){
            return $this->id_cat;
        }
        public function getlibelle_cat(){
            return $this->libelle_cat;
        }

        public function setid_cat($id_cat){
            $this->id_cat=$id_cat;
        }
        public function setlibelle_cat($libelle_cat){
            $this->libelle_cat=$libelle_cat;
        }

        public function save(){
            $co=new Conn();
            $co->prepare_execute("insert into  categorie  
                                values ('".$this->id_cat."','".$this->libelle_cat."')");
        }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from categorie where 1");
        }
        public function update($id){
            $co=new Conn();
            $co->prepare_execute("update categorie set id_cat ='".$this->id_cat."',
                                                    libelle_cat = '".$this->libelle_cat."'
                                                where id_cat = '".$id."'");
        }
        public function rechercher($id){
            $co=new Conn();
            return $co->query("select * from categorie where id_cat='".$id."';");

        }
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from categorie where id_cat ='".$this->id_cat."'");

        }


    }


?>