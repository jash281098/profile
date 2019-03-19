<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    Class Main_model extends CI_Model {

  public function __construct() {
    parent::__construct(); 
  }
}


class Formdata extends CI_Model {

    public function insert_data($data){
        $this->load->database();
        $insert=$this->db->insert("form",$data);
        
        if(!insert){
            echo"no";
        }
        else{
            echo "yes";
        }
    }
    
    public function getd(){
        $res=$this->db->get('form');
        return $res->result();
    }


    
    public  function getdata($rowno,$rowperpage,$search){    
        $this->db->select('*');
        if(isset($search['first_name']) && !empty($search['first_name'])){
            $this->db->where('first_name', $search['first_name']);
        }
        if(isset($search['last_name']) && !empty($search['last_name'])){
            $this->db->where('last_name', $search['last_name']);
        }
        $this->db->limit($rowperpage, $rowno); 
        $query = $this->db->get('users');  
        return $query->result_array();    
    }


    public function getrecordcount($search){
        $this->db->select('count(*) as allcount');
        if(isset($search['first_name']) && !empty($search['first_name'])){
            $this->db->where('first_name', $search['first_name']);
        }
        if(isset($search['last_name']) && !empty($search['last_name'])){
            $this->db->where('last_name', $search['last_name']);
        }
        $query = $this->db->get("users");
        $result = $query->result_array();
        return $result[0]['allcount'];
    }


    public function update($id,$data){
        $this->db->where('id',$id);
        $this->db->update('users',$data);
    }

    function update_add($id,$data){
        $this->db->where('user_id',$id);
        $this->db->update('user_address',$data);
    }




    public  function fetch($id){
        $this->load->database();
        $this->db->where('id',$id);
        $query = $this->db->get('users');
        $row = $query->result();
        return $row[0];    
    }


    public function fetch_add($id){
        $this->db->where('user_id',$id);        
        $query = $this->db->get('user_address');
        $row = $query->result();
        return $row[0];
    }

    public function fetch_state(){
        $this->db->order_by('name','ASC');
        $query=$this->db->get('states');
        return $query->result();
    }

    function fetch_city($state_id){
        $this->db->where('state_id',$state_id);
        $this->db->order_by('name','ASC');
        $query=$this->db->get('cities');
        $output='<option value="">Select city</option>';
        foreach($query->result() as $row){
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
    }

}

