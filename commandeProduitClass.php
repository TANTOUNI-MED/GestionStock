<?php
    require_once('connection.php');
    class commandeProduit{
        private $ref_prod;
        private $num_com;
        private $quan_prod;
     
        public function __construct(){

        }
        public function getnum_com(){
            return $this->num_com;
        }
        public function getref_prod(){
            return $this->ref_prod;
        }

        public function getquan_prod(){
            return $this->quan_prod;
        }
        public function setnum_com($num_com){
            $this->num_com=$num_com;
        }
        public function setref_prod($ref_prod){
            $this->ref_prod=$ref_prod;
        }

        public function setquan_prod($quan_prod){
            $this->quan_prod=$quan_prod;
        }
        public function save(){
            $co=new Conn();
          
            $co->prepare_execute("insert into  commande_produit  
                                values ('".$this->ref_prod."','".$this->num_com."','".$this->quan_prod."')");
            //modification des produit apres la commande
            require_once("produitClass.php");
            $pro=new produit();
            $pro->updateQuantite($this->ref_prod,$this->quan_prod);


  }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from commande_produit where 1");
        }
        public function update($num){
            $co=new Conn();
            $co->prepare_execute("update commande_produit set ref_prod = '".$this->ref_prod."',
                                                num_com = '".$this->num_com."',
                                                quan_prod = '".$this->quan_prod."'
                                                where num_com = '".$num."'");
        }
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from commande_produit where num_com ='".$this->num_com."'");

        }


    }


?>