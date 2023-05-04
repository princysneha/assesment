<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();

        $this->load->model('Main_Model');
	}		
	public function index()
	{
		$data['country']=$this->Main_Model->country();
		$this->load->view('city',$data);
	}

	public function listAll()
	{
		$data['country']=$this->Main_Model->country();
		$this->load->view('welcome_message',$data);
	}

	public function country(){
		$this->load->view('country');
	}

	public function state(){
		$data['country']=$this->Main_Model->country();
		$this->load->view('state',$data);
	}

	public function getState(){
	
		$country_id = $this->input->post('country');
		
		$data=$this->Main_Model->state($country_id);
		echo json_encode($data); 
	
	}

	public function getCity(){
	
		$state_id = $this->input->post('state');
		
		$data=$this->Main_Model->city($state_id);
		echo json_encode($data); 
	
	}
	public function store(){
		
		$data = [
			'name' => $this->input->post('country'),
			'created' => time()
		];
		$this->db->insert('country',$data);
		redirect('/index.php/welcome/list');
	}
	public function storeState(){
		
		$data = [
			'country_id' => $this->input->post('country'),
			'name' => $this->input->post('state'),
			'created' => time()
		];
		
		$this->db->insert('state',$data);
		redirect('/index.php/welcome/list');
	}

	public function storeCity(){
		$data = [
			
			'state_id' => $this->input->post('state'),
			'name' => $this->input->post('city'),
			'created' => time()
		];
		
		$this->db->insert('city',$data);
			
	}

	public function storeUpdate(){
		$data = [
			
			'state_id' => $this->input->post('state'),
			'name' => $this->input->post('city'),
			'created' => time()
		];
		echo "<pre>";
		print_r($data);

	}

	public function list(){
		$data['result']=$this->Main_Model->getAll();
		echo "<pre>";	
		print_r($data);
		$this->load->view('list',$data);
	}
}
