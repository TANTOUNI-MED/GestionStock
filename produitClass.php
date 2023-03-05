<?php
    require_once('connection.php');
    class produit{
        private $ref;
        private $libelle;
        private $prix_unit;
        private $quan_init;
        private $prix_achat;
        private $prix_vent;
        private $id_cat;
        public function __construct(){

        }
        public function getref(){
            return $this->ref;
        }
        public function getlibelle(){
            return $this->libelle;
        }

        public function getprix_unit(){
            return $this->prix_unit;
        }
        public function getquan_init(){
            return $this->quan_init;
        }
        public function getprix_achat(){
            return $this->prix_achat;
        }
        public function getprix_vent(){
            return $this->prix_vent;
        }
        public function getid_cat(){
            return $this->id_cat;
        }
        public function setref($ref){
            $this->ref=$ref;
        }
        public function setlibelle($libelle){
            $this->libelle=$libelle;
        }

        public function setprix_unit($prix_unit){
            $this->prix_unit=$prix_unit;
        }
        public function setquan_init($quan_init){
            $this->quan_init=$quan_init;
        }
        public function setprix_achat($prix_achat){
            $this->prix_achat=$prix_achat;
        }
        public function setprix_vent($prix_vent){
            $this->prix_vent=$prix_vent;
        }
        public function setid_cat($id_cat){
            $this->id_cat=$id_cat;
        }
      
        public function save(){
            $co=new Conn();
            $co->prepare_execute("insert into  produit  
                                values ('".$this->ref."','".$this->libelle."','".$this->prix_unit."','".$this->quan_init."','".$this->prix_achat."','".$this->prix_vent."','".$this->id_cat."')");
        }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from produit where 1");
        }
       
        public function update($Pref){
            $co=new Conn();
            $co->prepare_execute("update produit set ref_prod = '".$this->ref."',
                                                libelle = '".$this->libelle."',
                                                prix_unit = '".$this->prix_unit."',
                                                quan_init = '".$this->quan_init."',
                                                prix_achat =' ".$this->prix_achat."',
                                                prix_vent =' ".$this->prix_vent."',
                                                id_cat =' ".$this->id_cat."'
                                                where ref_prod = '".$Pref."'");
        }
     
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from produit where ref_prod ='".$this->ref."'");

        }

        public function ProdCat(){
            $co=new Conn();
            return $co->query("select p.ref_prod, p.libelle, p.prix_unit,
                                 p.quan_init, p.prix_achat,p.prix_vent,c.libelle_cat
                                  from produit p inner join categorie c on p.id_cat = c.id_cat;");

           
        }
          public function rechercher($pr){
            $co=new Conn();
            return $co->query("select p.ref_prod, p.libelle, p.prix_unit,
            p.quan_init, p.prix_achat,p.prix_vent,c.libelle_cat
             from produit p inner join categorie c on p.id_cat = c.id_cat where p.ref_prod='".$pr."'");

        }
        public function updateQuantite($Pref,$Quan){
            $co=new Conn();
            $reponse=$this->rechercher($Pref);
            $line=$reponse->fetch();
            $q=$line['quan_init'];
            $co->prepare_execute("update produit set 
                                                quan_init = '".$q-$Quan."'
                                                where ref_prod = '".$Pref."'");
        }
      

    }


?>