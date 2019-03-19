<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wel extends CI_Controller {


public function __construct(){
 
    parent::__construct();
    $this->load->helper('url');

    // Load session
    $this->load->library('session');

    // Load Pagination library
    $this->load->library('pagination');

    // Load model
    $this->load->model('formdata');
  }

  public function index(){
    redirect('wel/loadrecord');
  }


    public function loadRecord($rowno=0){
        $this->load->model('formdata');
        // Search text
        $search_text = "";
        $data=["first_name"=>'',"last_name"=>''];
        if($this->input->get('submit') != NULL ){
         $data=["first_name"=>$this->input->get('first_name'),"last_name"=>$this->input->get('last')];
        }
        // Row per page
        $rowperpage = 5;
        // Row position
        if($rowno != 0){
          $rowno = ($rowno-1) * $rowperpage;
        }
     
        // All records count
        $allcount = $this->formdata->getrecordCount($data);

        // Get records
        $users_record = $this->formdata->getData($rowno,$rowperpage,$data);
        // echo print_r($users_record);exit;
     
        // Pagination Configuration
        $config['base_url'] = base_url().'index.php/wel/loadRecord';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);
     
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;
        $data['search'] = $search_text;
         // echo print_r($data['result']);exit;
        // Load view
        $this->load->view('printdata',$data);
    } 
    
    
    public function update($id=''){
        $this->load->database();
        $this->load->model('formdata');
        $this->load->library('session');
        $this->load->helper(array('form'));
         $this->load->library('form_validation');
        $info['resul']=$this->formdata->fetch($id);
        $info['state']=$this->formdata->fetch_state();
        $info['add']=$this->formdata->fetch_add($id);
        $this->form_validation->set_rules('first', 'First Name', 'required');
        $this->form_validation->set_rules('last', 'Last Name', 'required');
        $this->form_validation->set_rules('num', 'Number', 'required');
        $this->form_validation->set_rules('alt', 'Alternate Number', 'required');
        $this->form_validation->set_rules('email', 'Alternate Number', 'required');
        $this->form_validation->set_rules('sec_email', 'Alternate Number', 'required');  
        $this->form_validation->set_rules('address', 'Alternate Number', 'required');
        $this->form_validation->set_rules('state', 'Alternate Number', 'required');
        $this->form_validation->set_rules('city', 'Alternate Number', 'required');
        if($_POST&& $this->form_validation->run()==true){
            $data=array(
                "user_id"=>$id,
                "image"=>$this->input->post("avatar")
            );
            
            $data1= array(
                "login_type"=>"cms",
                "first_name"=>$this->input->post("first"),
                "last_name"=>$this->input->post("last"),
                "mobile"=>$this->input->post("num"),
                "secondary_mobile"=>$this->input->post("alt"),
                "email"=>$this->input->post("email"),
                "secondary_email"=>$this->input->post("sec_email"),
                "image"=>$this->input->post("avatar")
            );
            $data2=array(
                "address_1"=>$this->input->post("address"),
                "state_id"=>$this->input->post("state"),
                "city_id"=>$this->input->post("city"),
                "pincode"=>$this->input->post("pincode")
            );
            $this->formdata->update($id,$data1);
            $this->formdata->update_add($id,$data2);
            $this->session->set_flashdata('key','Update Successfull'); 
            redirect("wel/loadrecord");
        }
        else{
            $this->load->view("form",$info);  
        }
    }


    function fetch_city(){
        if($this->input->post('state_id')){
            echo $this->formdata->fetch_city($this->input->post('state_id'));
        }
    } 

}
