<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
//session_start();
Class Shopping Extends CI_model {
	public $userId, $companyID, $logged_in, $userLogin;

    public function __construct() {
        parent::__construct();
        $this->companyID 	= isset($_SESSION['companyID']) ? $_SESSION['companyID'] : 0;
		$this->userId 		= isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
		$this->logged_in  	= isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
		$this->userLogin  	= isset($_SESSION['userLogin']) ? $_SESSION['userLogin'] : '';

    }
	
	
	public function is_login($type = true){
		if($type == true){
			if($this->companyID > 0 AND $this->userId > 0 AND strlen($this->userLogin) > 1){
				return true;
			}else{
				redirect( base_url().'login', 'refresh');
			}
		}else{
			if($this->companyID > 0 AND $this->userId > 0 AND strlen($this->userLogin) > 1){
				redirect( base_url().'dashboard', 'refresh');
			}
		}
	}
	
	/**
	##
		Company information 
	##
	**/
	
	public function company_info($id = 0, $query = ''){
		if($id > 0){
			$id = $id;
		}else{
			$id = $this->companyID;
		}
		$company = $this->db->query("SELECT * FROM shop_company WHERE COMPANY_ID = '{$id}' {$query}");
		$fetch = $company->result_array();
		if(is_array($fetch) AND sizeof($fetch) > 0){
			return $fetch[0];
		}else{
			return '';
		}
		
	}
	
	
	/**
	##
		User information 
	##
	**/
	
	public function user_info($id = 0, $query = ''){
		if($id > 0){
			$id = $id;
		}else{
			$id = $this->userId;
		}
		$company = $this->db->query("SELECT * FROM shop_access_user WHERE USER_ID = '{$id}' {$query}");
		$fetch = $company->result_array();
		if(is_array($fetch) AND sizeof($fetch) > 0){
			return $fetch[0];
		}else{
			return '';
		}
		
	}
	
	
	/**
	##
		main menu company and user
	##
	**/
	
	private function query_main_menu($company = 0, $type = 'Access', $userAccess = 'Default'){
		if($company > 0){
			$id = $company;
		}else{
			$id = $this->companyID;
		}
		
		$subQuery = ''; $WHERE = '';
		if($userAccess == 'Access'){
			$subQuery = " INNER JOIN menu_access_user AS subJoin ON menu.MENU_ID = subJoin.MENU_ID ";
			$WHERE = " AND subJoin.ACCESS_CATE = 'Main' AND subJoin.SUB_MENU_ID = 0 AND subJoin.COMPANY_ID = '{$this->companyID}' AND subJoin.USER_ID = '{$this->userId}' AND subJoin.USER_ACCESS_STATUS = 'Active' ";
		}
		
		if($type == 'Access'){
			$companyArry = $this->db->query("SELECT 
														menu.MENU_NAME,
														menu.MENU_URL,
														menu.ICON_MENU,
														menu.MENU_ID 
												FROM 
														shop_menu AS menu
												INNER JOIN menu_access_company AS access
														ON menu.MENU_ID = access.MANU_ID 
												{$subQuery}
												WHERE 	access.COMPANY_ID = '{$id}' 
														AND access.SUB_MENU_ID = 0 
														AND access.ACCESS_CATE = 'Main' 
														AND menu.MENU_STATUS = 'Active' 
														AND access.ACCESS_STATUS = 'Active'
														{$WHERE}
												ORDER BY menu.MENU_SORTING ASC
											");
		}else{
			$companyArry = $this->db->query("SELECT menu.MENU_NAME, menu.MENU_URL, menu.ICON_MENU, menu.MENU_ID FROM shop_menu  AS menu {$subQuery} WHERE menu.MENU_STATUS = 'Active' {$WHERE} ORDER BY menu.MENU_SORTING ASC");
		}
		$fetch = $companyArry->result_array();
		if(is_array($fetch) AND sizeof($fetch) > 0){
			return $fetch;
		}else{
			return '';
		}
		
	}
	
	
	private function query_main_menu_user($id = 0, $type = 'Access', $comAccess = 'Default'){
		
		$subQuery = ''; $WHERE = '';
		if($comAccess == 'Access'){
			$subQuery = " INNER JOIN menu_access_company AS subJoin ON menu.SUB_MENU_ID = subJoin.SUB_MENU_ID ";
			$WHERE = " AND subJoin.ACCESS_CATE = 'Sub' AND subJoin.SUB_MENU_ID != 0 AND subJoin.COMPANY_ID = '{$this->companyID}' AND subJoin.ACCESS_STATUS = 'Active' ";
		}
		
		if($type == 'Access'){
			$companyArry = $this->db->query("SELECT 
														menu.SUB_MENU_NAME,
														menu.SUB_MENU_URL,
														menu.SUB_MENU_ID
												FROM 
														shop_sub_menu AS menu
												INNER JOIN menu_access_user AS access
														ON menu.SUB_MENU_ID = access.SUB_MENU_ID 
												$subQuery
												WHERE 	access.MENU_ID = '{$id}'
														AND access.SUB_MENU_ID != 0 
														AND access.ACCESS_CATE = 'Sub' 
														AND access.USER_ID = '{$this->userId}' 
														AND access.COMPANY_ID = '{$this->companyID}' 
														AND menu.SUB_MENU_STATUS = 'Active' 
														AND access.USER_ACCESS_STATUS = 'Active' 
														$WHERE	
												ORDER BY menu.SUB_SORTING ASC
												");
		}else{
			$companyArry = $this->db->query("SELECT menu.SUB_MENU_NAME, menu.SUB_MENU_URL,  menu.SUB_MENU_ID FROM shop_sub_menu  AS menu $subQuery WHERE menu.MENU_ID = '{$id}' AND menu.SUB_MENU_STATUS = 'Active' $WHERE ORDER BY menu.SUB_SORTING ASC");
		}
		//echo $this->db->last_query();
		$fetch = $companyArry->result_array();
		//print_r($fetch);exit;
		if(is_array($fetch) AND sizeof($fetch) > 0){
			return $fetch;
		}else{
			return array();
		}
		
	}
	
	public function main_menu($type = 'Main', $subId = 0){
		$company = $this->company_info();
		$user = $this->user_info();
		
		$comAccess = isset($company['ACCESS_TYPE']) ? $company['ACCESS_TYPE'] : 'None';
		$userAccess = isset($user['ACCESS_MENU']) ? $user['ACCESS_MENU'] : 'Access';
		//print_r($this->query_main_menu_user(4, $userAccess));
		if($type == 'Main'){
			return $this->query_main_menu(0, $comAccess, $userAccess);
		}else{
			return $this->query_main_menu_user($subId, $userAccess, $comAccess);
		}		
	}
	
	private function page_check_login_url_private($id = 0, $type = 'Access', $comAccess = 'Default'){
		
		$subQuery = ''; $WHERE = '';
		if($comAccess == 'Access'){
			$subQuery = " INNER JOIN menu_access_company AS subJoin ON menu.SUB_MENU_ID = subJoin.SUB_MENU_ID ";
			$WHERE = " AND subJoin.ACCESS_CATE = 'Sub' AND subJoin.SUB_MENU_ID = '{$id}' AND subJoin.COMPANY_ID = '{$this->companyID}' AND subJoin.ACCESS_STATUS = 'Active' ";
		}
		
		if($type == 'Access'){
			$companyArry = $this->db->query("SELECT 
														menu.SUB_MENU_NAME,
														menu.SUB_MENU_URL,
														menu.SUB_MENU_ID
												FROM 
														shop_sub_menu AS menu
												INNER JOIN menu_access_user AS access
														ON menu.SUB_MENU_ID = access.SUB_MENU_ID 
												$subQuery
												WHERE 	menu.MENU_ID = access.MENU_ID
														AND access.SUB_MENU_ID = '{$id}' 
														AND access.ACCESS_CATE = 'Sub' 
														AND access.USER_ID = '{$this->userId}' 
														AND access.COMPANY_ID = '{$this->companyID}' 
														AND menu.SUB_MENU_STATUS = 'Active' 
														AND access.USER_ACCESS_STATUS = 'Active' 
														$WHERE	
												ORDER BY menu.SUB_SORTING ASC
												");
		}else{
			$companyArry = $this->db->query("SELECT menu.SUB_MENU_NAME, menu.SUB_MENU_URL,  menu.SUB_MENU_ID FROM shop_sub_menu  AS menu $subQuery WHERE menu.SUB_MENU_ID = '{$id}' AND menu.SUB_MENU_STATUS = 'Active' $WHERE ORDER BY menu.SUB_SORTING ASC");
		}
		//echo $this->db->last_query();
		$fetch = $companyArry->result_array();
		//print_r($fetch);exit;
		if(is_array($fetch) AND sizeof($fetch) > 0){
			return $fetch;
		}else{
			return array();
		}
		
	}
	
	public function page_check_login_url($page=''){
		$company = $this->company_info();
		$user = $this->user_info();
		
		$comAccess = isset($company['ACCESS_TYPE']) ? $company['ACCESS_TYPE'] : 'None';
		$userAccess = isset($user['ACCESS_MENU']) ? $user['ACCESS_MENU'] : 'Access';
		//echo $comAccess; exit;
		$check1 = $this->db->query("SELECT SUB_MENU_ID FROM shop_sub_menu WHERE SUB_MENU_URL = '".$page."'");
		$check = $check1->result_array();
		//print_r($check);exit;
		if(is_array($check) AND sizeof($check) > 0){
			$pageID = $check[0]['SUB_MENU_ID'];
			$data = $this->page_check_login_url_private($pageID, $userAccess, $comAccess);
			//print_r($data);exit;
			if(is_array($data) AND sizeof($data) > 0){
				return true;
			}else{
				echo '<center><h2>Sorry Page not found</h2></center>'; exit;
			}
		}else{
			echo '<center><h2>Sorry Page not found</h2></center>'; exit;
		}
	}
	
}
?>