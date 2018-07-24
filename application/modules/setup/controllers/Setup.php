<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
session_start();
class Setup extends CI_Controller {
	public $companyID, $userId, $logged_in;
    public function __construct() {
        parent::__construct(); 
		$this->companyID 	= isset($_SESSION['companyID']) ? $_SESSION['companyID'] : 0;
		$this->userId 		= isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
		$this->logged_in  	= isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
		$this->load->model(array('Setup_model' => 'setup'));
		$this->load->model(array('next-pagination/Next_pagination' => 'pagi'));
	}
	
	
	public function index() {
    	$this->shop->is_login(true);
		$data = array();
		
		$this->load->view('include/header'); 
		$this->load->view('dashboard', $data);
		$this->load->view('include/footer');
		
    }
	
	
	public function supplier_info($edit = 0){
		$this->shop->is_login(true);
		
		$this->shop->page_check_login_url('supplier_info');
		
		$data = array();
		$data['MSG'] = '';
		$data['mass'] = 'warning';
		$data['edit'] = $edit;
		
		$this->load->view('include/header'); 
		
		if(isset($_POST['submit_supplier'])){
			$supply = array();
			$supply['SUPPLIER_NAME'] 	= $this->input->post('name', true);
			$supply['SUPPLIER_EMAIL'] 	= $this->input->post('email', true);
			$supply['SUPPLIER_PHONE'] 	= $this->input->post('phone', true);
			$supply['SUPPLIER_ADDRESS'] = $this->input->post('address', true);
			if($edit == 0){
				$supply['COMPANY_ID'] 		= $this->companyID;
				$supply['ENT_DATE'] 		= date('Y-m-d');
				$supply['ENT_USER'] 		= $this->userId;
			}
			$supply['SUPPLIER_STATUS'] = isset($_POST['status']) ? $_POST['status'] : 'Active';
			
			if(strlen($supply['SUPPLIER_NAME']) > 0 AND strlen($supply['SUPPLIER_EMAIL']) > 0){
				if($edit == 0){
					$search = $this->db->query("SELECT SUPPLIER_NAME FROM info_supplier WHERE SUPPLIER_NAME = '".$supply['SUPPLIER_NAME']."'");
					if($search->num_rows() == 0){
						if($this->db->insert('info_supplier', $supply)){
							$data['mass'] = 'success';
							$data['MSG'] = 'Successfully added supplier info...';
							redirect( base_url().'setup/supplier_info/', 'refresh');
						}else{
							$data['mass'] = 'danger';
							$data['MSG'] = 'Sorry system error...';
						}
					}else{
						$data['mass'] = 'info';
						$data['MSG'] = 'Sorry already added this supplier...';
					}
				
				}else{
					if($this->db->update('info_supplier', $supply, array('SUPPLIER_ID' => $edit, 'COMPANY_ID' => $this->companyID))){
						$data['mass'] = 'success';
						$data['MSG'] = 'Successfully update supplier info...';
						redirect( base_url().'setup/supplier_info/', 'refresh');
					}else{
						$data['mass'] = 'danger';
						$data['MSG'] = 'Sorry system error...';
					}
				}
				
			}else{
				$data['mass'] = 'warning';
				$data['MSG'] = 'Please fill up supplier info...';
			}
			
		}
		if($edit > 0){
			$data['edit_data'] = $this->setup->supplier_data($edit);
		}else{
			$data['edit_data'] = '';
		}
		
		$coutn = $this->db->query("SELECT SUPPLIER_ID FROM info_supplier WHERE SUPPLIER_STATUS != 'Delete'")->num_rows();
		$getOffset = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$pagiData = array();
		$pagiData['total_count'] = $coutn;
		$pagiData['offset_name'] = 'page';
		$pagiData['offset'] = $getOffset;
		$pagiData['limit'] = 10; // Per page
		$pagiData['pre_text'] = '&laquo;'; 
		$pagiData['next_text'] = '&raquo;'; 
		
		$offset = $this->pagi->initialize($pagiData);
		$data['increment'] = $offset;
		
		$data['supplier_list'] = $this->setup->supplier_data(0,$offset);
		
		$this->load->view('supplier', $data);
		$this->load->view('include/footer');
	}

	public function product_items($edit = 0){
		$this->shop->is_login(true);
		$this->shop->page_check_login_url('product_items');
		$data = array();
		$data['MSG'] = '';
		$data['mass'] = 'warning';
		$data['edit'] = $edit;
		
		$this->load->view('include/header'); 
		
		$data['items_type'] = $this->setup->items_type();
		$data['items_unit'] = $this->setup->items_unit();
		
		if(isset($_POST['submit_items'])){
			$supply = array();
			$supply['ITEM_NAME'] 	= $this->input->post('name_item', true);
			$supply['ITEM_TYPE'] 	= $this->input->post('type', true);
			$supply['ITEM_UNIT'] 	= $this->input->post('unit', true);
			$supply['REMARKS'] 		= $this->input->post('remarks', true);
			if($edit == 0){
				$supply['COMPANY_ID'] 		= $this->companyID;
				$supply['ENT_DATE'] 		= date('Y-m-d');
				$supply['ENT_USER'] 		= $this->userId;
			}
			$supply['ITEM_STATUS'] = isset($_POST['status']) ? $_POST['status'] : 'Active';
			
			if(strlen($supply['ITEM_NAME']) > 0){
				if($edit == 0){
					$search = $this->db->query("SELECT ITEM_NAME FROM product_items WHERE ITEM_NAME = '".$supply['ITEM_NAME']."'");
					if($search->num_rows() == 0){
						if($this->db->insert('product_items', $supply)){
							$data['mass'] = 'success';
							$data['MSG'] = 'Successfully added product item...';
							redirect( base_url().'setup/product_items/', 'refresh');
						}else{
							$data['mass'] = 'danger';
							$data['MSG'] = 'Sorry system error...';
						}
					}else{
						$data['mass'] = 'info';
						$data['MSG'] = 'Sorry already added this product item...';
					}
				
				}else{
					if($this->db->update('product_items', $supply, array('ITEM_ID' => $edit, 'COMPANY_ID' => $this->companyID))){
						$data['mass'] = 'success';
						$data['MSG'] = 'Successfully update product item...';
						redirect( base_url().'setup/product_items/', 'refresh');
					}else{
						$data['mass'] = 'danger';
						$data['MSG'] = 'Sorry system error...';
					}
				}
				
			}else{
				$data['mass'] = 'warning';
				$data['MSG'] = 'Please fill up item info...';
			}
			
		}
		if($edit > 0){
			$data['edit_data'] = $this->setup->items_data($edit);
		}else{
			$data['edit_data'] = '';
		}
		
		$coutn = $this->db->query("SELECT ITEM_ID FROM product_items WHERE ITEM_STATUS != 'Delete'")->num_rows();
		$getOffset = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$pagiData = array();
		$pagiData['total_count'] = $coutn;
		$pagiData['offset_name'] = 'page';
		$pagiData['offset'] = $getOffset;
		$pagiData['limit'] = 10; // Per page
		$pagiData['pre_text'] = '&laquo;'; 
		$pagiData['next_text'] = '&raquo;'; 
		
		$offset = $this->pagi->initialize($pagiData);
		$data['increment'] = $offset;
		
		$data['items_list'] = $this->setup->items_data(0,$offset);
		
		$this->load->view('product-items', $data);
		$this->load->view('include/footer');
	}
	
	public function items_model($edit = 0){
		$this->shop->is_login(true);
		$this->shop->page_check_login_url('items_model');
		$data = array();
		$data['MSG'] = '';
		$data['mass'] = 'warning';
		$data['edit'] = $edit;
		
		$this->load->view('include/header'); 
		
		$data['items_list_all'] = $this->setup->items_data_all();
		$data['items_type'] = $this->setup->items_type();
		$data['items_unit'] = $this->setup->items_unit();
		
		if(isset($_POST['submit_model'])){
			//echo 'Hi';
			$supply = array();
			$supply['MODEL_CODE'] 			= $this->input->post('name_item', true);
			$supply['MODEL_BUY_PRICE'] 		= $this->input->post('stock_price', true);
			$supply['MODEL_SELL_PRICE'] 	= $this->input->post('sell_price', true);
			$supply['ITEM_ID'] 				= $this->input->post('item_id', true);
			if($edit == 0){
				$item = $this->setup->items_data($supply['ITEM_ID']);
				if(is_array($item) AND sizeof($item) > 0){
					$supply['ITEM_TYPE'] 	= $item[0]['ITEM_TYPE'];
					$supply['ITEM_UNIT'] 	= $item[0]['ITEM_UNIT'];
				}
			}else{
				$supply['ITEM_TYPE'] 	= $this->input->post('type', true);
				$supply['ITEM_UNIT'] 	= $this->input->post('unit', true);
			}
			$supply['REMARKS'] 		= $this->input->post('remarks', true);
			if($edit == 0){
				$supply['COMPANY_ID'] 		= $this->companyID;
				$supply['ENT_DATE'] 		= date('Y-m-d');
				$supply['ENT_USER'] 		= $this->userId;
			}
			$supply['MODEL_STATUS'] = isset($_POST['status']) ? $_POST['status'] : 'Active';
			
			if(strlen($supply['MODEL_CODE']) > 0 AND $supply['MODEL_BUY_PRICE'] > 0 AND $supply['MODEL_SELL_PRICE'] > 0 AND $supply['ITEM_ID'] > 0){
				if($edit == 0){
					$search = $this->db->query("SELECT MODEL_CODE FROM product_items_model WHERE MODEL_CODE = '".$supply['MODEL_CODE']."' AND ITEM_ID = '".$supply['ITEM_ID']."'");
					if($search->num_rows() == 0){
						if($this->db->insert('product_items_model', $supply)){
							$data['mass'] = 'success';
							$data['MSG'] = 'Successfully added item model...';
							redirect( base_url().'setup/items_model/', 'refresh');
						}else{
							$data['mass'] = 'danger';
							$data['MSG'] = 'Sorry system error...';
						}
					}else{
						$data['mass'] = 'info';
						$data['MSG'] = 'Sorry already added this item model...';
					}
				
				}else{
					if($this->db->update('product_items_model', $supply, array('MODEL_ID' => $edit, 'COMPANY_ID' => $this->companyID))){
						$data['mass'] = 'success';
						$data['MSG'] = 'Successfully update item model...';
						redirect( base_url().'setup/items_model/', 'refresh');
					}else{
						$data['mass'] = 'danger';
						$data['MSG'] = 'Sorry system error...';
					}
				}
				
			}else{
				$data['mass'] = 'warning';
				$data['MSG'] = 'Please fill up model info...';
			}
			
		}
		if($edit > 0){
			$data['edit_data'] = $this->setup->items_model_data($edit);
		}else{
			$data['edit_data'] = '';
		}
		
		$coutn = $this->db->query("SELECT MODEL_ID FROM product_items_model WHERE MODEL_STATUS != 'Delete'")->num_rows();
		$getOffset = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$pagiData = array();
		$pagiData['total_count'] = $coutn;
		$pagiData['offset_name'] = 'page';
		$pagiData['offset'] = $getOffset;
		$pagiData['limit'] = 10; // Per page
		$pagiData['pre_text'] = '&laquo;'; 
		$pagiData['next_text'] = '&raquo;'; 
		
		$offset = $this->pagi->initialize($pagiData);
		$data['increment'] = $offset;
		
		$data['items_list'] = $this->setup->items_model_data(0,$offset);
		
		$this->load->view('product-medol', $data);
		$this->load->view('include/footer');
	}

}

?>