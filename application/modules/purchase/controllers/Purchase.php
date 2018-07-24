<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
session_start();
class Purchase extends CI_Controller {
	public $companyID, $userId, $logged_in;
    public function __construct() {
        parent::__construct(); 
		$this->companyID 	= isset($_SESSION['companyID']) ? $_SESSION['companyID'] : 0;
		$this->userId 		= isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
		$this->logged_in  	= isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
		$this->load->model(array('Purchase_model' => 'purchase'));
		$this->load->model(array('next-pagination/Next_pagination' => 'pagi'));
	}
	
	
	public function index() {
    	$this->shop->is_login(true);
		$data = array();
		$this->load->view('include/header'); 
		$this->load->view('dashboard', $data);
		$this->load->view('include/footer');
		
    }
	
	
	/*
	## Search items
	*/
	
	public function search_model(){
		$module_array 	= array();
		$id = isset($_REQUEST['item']) ? $_REQUEST['item'] : 0;
		if($id > 0){
			$sarch = $this->db->query("SELECT MODEL_ID,MODEL_CODE FROM product_items_model WHERE ITEM_ID = '".$id."' AND COMPANY_ID = '".$this->companyID."' AND MODEL_STATUS = 'Active' ORDER BY MODEL_CODE ASC");
			if($sarch->num_rows() > 0){
				foreach($sarch->result_array() AS $value){
					$module_array[] = array('optionValue'=>$value['MODEL_ID'], 'optionDisplay'=>$value['MODEL_CODE']);
				}
			}
		}
		echo json_encode($module_array); exit;
	}
	
	public function search_model_info(){
		$module_array 	= array();
		$id = isset($_REQUEST['model']) ? $_REQUEST['model'] : 0;
		if($id > 0){
			$sarch = $this->purchase->items_model_data($id);
			if(sizeof($sarch) > 0){
				foreach($sarch AS $value){
					$module_array[] = $value;
				}
			}
		}
		echo json_encode($module_array); exit;
	}
	
	public function add_stock($edit = 0){
		$this->shop->is_login(true);
		$this->shop->page_check_login_url('add_stock');
		$data = array();
		$data['MSG'] = '';
		$data['mass'] = 'warning';
		$data['edit'] = $edit;
		
		$this->load->view('include/header'); 
		
		$data['items_list_all'] = $this->purchase->items_data_all();
		$data['supplier_list_all'] = $this->purchase->supplier_data_all();
		
		if(isset($_POST['submit_purchase'])){
			
		}
		
		$this->load->view('add_stock', $data);
		$this->load->view('include/footer');
	}
	
	
	
}

?>