<?php
    require_once('connection.php');
    class approProduit{
        private $ref_prod;
        private $num_appro;
        private $quan_appro;
     
        public function __construct(){

        }
        public function getnum_appro(){
            return $this->num_appro;
        }
        public function getref_prod(){
            return $this->ref_prod;
        }

        public function getquan_prod(){
            return $this->quan_prod;
        }
        public function setnum_appro($num_appro){
            $this->num_appro=$num_appro;
        }
        public function setref_prod($ref_prod){
            $this->ref_prod=$ref_prod;
        }

        public function setquan_appro($quan_appro){
            $this->quan_appro=$quan_appro;
        }
        public function save(){
            $co=new Conn();
          
            $co->prepare_execute("insert into  approvisionnement_produit  
                                values ('".$this->ref_prod."','".$this->num_appro."','".$this->quan_appro."')");
  }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from approvisionnement_produit where 1");
        }
        public function update($num){
            $co=new Conn();
            $co->prepare_execute("update approvisionnement_produit set ref_prod = '".$this->ref_prod."',
                                                num_appro = '".$this->num_appro."',
                                                quan_appro = '".$this->quan_appro."'
                                                where num_appro = '".$num."'");
        }
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from approvisionnement_produit where num_appro ='".$this->num_appro."'");

        }


    }


?>