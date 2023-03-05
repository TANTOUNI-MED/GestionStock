<?php
    require_once('connection.php');
    class commande{
     
        private $num_com;
        private $date;
        private $id_cli;
     
        public function __construct(){

        }
        public function getnum_com(){
            return $this->num_com;
        }
        public function getdate(){
            return $this->date;
        }

        public function getid_cli(){
            return $this->id_cli;
        }
        public function setnum_com($num_com){
            $this->num_com=$num_com;
        }
        public function setdate($date){
            $this->date=$date;
        }

        public function setid_cli($id_cli){
            $this->id_cli=$id_cli;
        }
        public function save(){
            $co=new Conn();
            
            $co->prepare_execute("insert into  commande  
                                values ('".$this->num_com."','".$this->date."','".$this->id_cli."')");
            $stmt = $co->query("select LAST_INSERT_ID()");
            $last_id = $stmt->fetchColumn();
            $this->num_com = $last_id;
        }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from commande where 1");
        }
        public function update($num){
            $co=new Conn();
            $co->prepare_execute("update commande set num_com = '".$this->num_com."',
                                                date = '".$this->date."',
                                                id_cli = '".$this->id_cli."'
                                                where num_com = '".$num."'");
        }
    
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from commande where num_com ='".$this->num_com."'");

        }
        public function ComProd(){
            $co=new Conn();
            return $co->query("select c.id_cli,c.num_com, c.date,p.ref_prod, p.quan_prod
                                         from commande c inner join commande_produit p 
                                         on p.num_com = c.num_com;");
        }
        public function UnComProd($un){
            $co=new Conn();
            return $co->query("select c.id_cli,c.num_com, c.date,p.ref_prod, p.quan_prod
                                         from commande c inner join commande_produit p 
                                         on p.num_com = c.num_com where c.num_com='".$un."' ;");
        }


    }


?>