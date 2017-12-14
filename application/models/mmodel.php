<?php

class mmodel extends MY_Model{
 
    public function __construct(){
        parent::__construct();
       $this->mailto = 'tkwp_mailto';
    }
	// PAGE  HOME
	public function getCity(){
		 $query = $this->db->query("  select * from tkwp_quanhuyen_category     order by sort asc  ");
		 return  $query->result_array();
	}
	public function getWard($id){
		 $query = $this->db->query("  select * from tkwp_quanhuyen_category  where parent = '".$id."'  order by sort asc  ");
		 return  $query->result_array();
	}
	  public function add($data){
       $c = $this->db->insert($this->mailto,$data);
	   if($c) 
		   return 1 ;
	   else return 0 ;
    }
	// END PAGE HOME
	
	
	
}