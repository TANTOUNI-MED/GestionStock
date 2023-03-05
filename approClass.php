<?php
    require_once('connection.php');
    class appro{
     
        private $num_appro;
        private $date;
        private $id_four;
     
        public function __construct(){

        }
        public function getnum_appro(){
            return $this->num_appro;
        }
        public function getdate(){
            return $this->date;
        }

        public function getid_four(){
            return $this->id_four;
        }
        public function setnum_appro($num_appro){
            $this->num_appro=$num_appro;
        }
        public function setdate($date){
            $this->date=$date;
        }

        public function setid_four($id_four){
            $this->id_four=$id_four;
        }
        public function save(){
            $co=new Conn();
            
            $co->prepare_execute("insert into  approvisionnement  
                                values ('".$this->num_appro."','".$this->date."','".$this->id_four."')");
            $stmt = $co->query("select LAST_INSERT_ID()");
            $last_id = $stmt->fetchColumn();
            $this->num_appro = $last_id;
        }
        public function showAll(){
            $co=new Conn();
            return $co->query("select * from approvisionnement where 1");
        }
        public function update($num){
            $co=new Conn();
            $co->prepare_execute("update approvisionnement set num_appro = '".$this->num_appro."',
                                                date = '".$this->date."',
                                                id_four = '".$this->id_four."'
                                                where num_appro = '".$num."'");
        }
        public function supprimer(){
            $co=new Conn();
            $co->prepare_execute("delete from approvisionnement where num_appro ='".$this->num_com."'");

        }
        public function ApproProd(){
            $co=new Conn();
            return $co->query("select a.id_four,a.num_appro, a.date,p.ref_prod, p.quan_appro
                                         from approvisionnement a inner join approvisionnement_produit p 
                                         on p.num_appro = a.num_appro;");
        }
        public function UnApproProd($un){
            $co=new Conn();
            return $co->query("select a.id_four,a.num_appro, a.date,p.ref_prod, p.quan_appro
                                 from approvisionnement a inner join approvisionnement_produit p 
                                 on p.num_appro = a.num_appro where a.num_appro='".$un."';");
        }


    }


?>