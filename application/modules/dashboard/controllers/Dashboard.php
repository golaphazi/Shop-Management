<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
session_start();
class Dashboard extends CI_Controller {
	public $companyID, $userId, $logged_in;
    public function __construct() {
        parent::__construct(); 
		$this->companyID 	= isset($_SESSION['companyID']) ? $_SESSION['companyID'] : 0;
		$this->userId 		= isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
		$this->logged_in  	= isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
		$this->load->model(array('Dashboard_model' => 'dashboard'));
	}
	
	
	public function index() {
    	$this->shop->is_login(true);
		$data = array();
		
		$this->load->view('include/header'); 
		$this->load->view('dashboard', $data);
		$this->load->view('include/footer');
		
    }
	
	
	public function myaccount(){
		$this->shop->is_login(true);
		$data = array();
		
		$this->load->view('include/header'); 
		$this->load->view('profile', $data);
		$this->load->view('include/footer');
	}

	
}

?>