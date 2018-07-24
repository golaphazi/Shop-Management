<?php
Class Setup_model Extends CI_model {
	public $userID;

    public function __construct() {
        parent::__construct();
        $this->companyID 	= isset($_SESSION['companyID']) ? $_SESSION['companyID'] : 0;
		$this->userId 		= isset($_SESSION['userId']) ? $_SESSION['userId'] : 0;
		$this->logged_in  	= isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false;
		
    }
	
	private function supplier_data_value($id=0, $offset=0, $show = 'pagi'){
		if($id > 0){
			$search = $this->db->query("SELECT * FROM info_supplier WHERE SUPPLIER_ID = '".$id."' AND SUPPLIER_STATUS != 'Delete' AND COMPANY_ID = '".$this->companyID."'");
		}else{
			if($show == 'all'){
				$search = $this->db->query("SELECT * FROM info_supplier WHERE SUPPLIER_STATUS != 'Delete' AND COMPANY_ID = '".$this->companyID."'  ORDER BY SUPPLIER_NAME ASC");			
			}else{
				$search = $this->db->query("SELECT * FROM info_supplier WHERE SUPPLIER_STATUS != 'Delete' AND COMPANY_ID = '".$this->companyID."'  ORDER BY SUPPLIER_ID DESC LIMIT $offset,10");
			
			}
		}
		return 	$search->result_array();	
	}
	
	public function supplier_data($id=0, $offset=0){
		return $this->supplier_data_value($id,$offset);
	}
	
	public function supplier_data_all($id=0, $offset=0){
		return $this->supplier_data_value($id,$offset, 'all');
	}
	
	public function items_type($id= 0){
		if($id > 0){
			$search = $this->db->query("SELECT * FROM setting_item_type WHERE ITEM_TYPE_ID = '".$id."' AND ITEM_TYPE_STATUS != 'Delete' ");
		}else{
			$search = $this->db->query("SELECT * FROM setting_item_type WHERE ITEM_TYPE_STATUS = 'Active'  ORDER BY ITEM_TYPE_ID ASC");
		}
		return 	$search->result_array();
	}
	
	public function items_unit($id= 0){
		if($id > 0){
			$search = $this->db->query("SELECT * FROM setting_item_unit WHERE ITEM_UNIT_ID = '".$id."' AND ITEM_UNIT_STATUS != 'Delete' ");
		}else{
			$search = $this->db->query("SELECT * FROM setting_item_unit WHERE ITEM_UNIT_STATUS = 'Active'  ORDER BY ITEM_UNIT_ID ASC");
		}
		return 	$search->result_array();
	}
	
	
	private function items_data_value($id=0, $offset=0, $show = 'pagi'){
		if($id > 0){
			$search = $this->db->query("SELECT * FROM product_items AS item INNER JOIN setting_item_type AS type ON item.ITEM_TYPE = type.ITEM_TYPE_ID INNER JOIN setting_item_unit AS unit ON item.ITEM_UNIT = unit.ITEM_UNIT_ID WHERE item.ITEM_ID = '".$id."' AND item.ITEM_STATUS != 'Delete' AND item.COMPANY_ID = '".$this->companyID."'");
		}else{
			if($show == 'all'){
				$search = $this->db->query("SELECT * FROM product_items AS item INNER JOIN setting_item_type AS type ON item.ITEM_TYPE = type.ITEM_TYPE_ID INNER JOIN setting_item_unit AS unit ON item.ITEM_UNIT = unit.ITEM_UNIT_ID WHERE item.ITEM_STATUS != 'Delete' AND item.COMPANY_ID = '".$this->companyID."'  ORDER BY item.ITEM_NAME ASC");
			}else{
				$search = $this->db->query("SELECT * FROM product_items AS item INNER JOIN setting_item_type AS type ON item.ITEM_TYPE = type.ITEM_TYPE_ID INNER JOIN setting_item_unit AS unit ON item.ITEM_UNIT = unit.ITEM_UNIT_ID WHERE item.ITEM_STATUS != 'Delete' AND item.COMPANY_ID = '".$this->companyID."'  ORDER BY item.ITEM_ID DESC LIMIT $offset,10");
			}
			
		}
		return 	$search->result_array();	
	}
	
	public function items_data($id=0, $offset=0){
		return $this->items_data_value($id,$offset);
	}
	
	public function items_data_all($id=0, $offset=0){
		return $this->items_data_value($id,$offset, 'all');
	}
	
	
	private function items_model_data_value($id=0, $offset=0, $show = 'pagi'){
		if($id > 0){
			$search = $this->db->query("SELECT * FROM product_items_model AS model INNER JOIN setting_item_type AS type ON model.ITEM_TYPE = type.ITEM_TYPE_ID INNER JOIN setting_item_unit AS unit ON model.ITEM_UNIT = unit.ITEM_UNIT_ID WHERE model.MODEL_ID = '".$id."' AND model.MODEL_STATUS != 'Delete' AND model.COMPANY_ID = '".$this->companyID."'");
		}else{
			if($show == 'all'){
				$search = $this->db->query("SELECT * FROM product_items_model AS model INNER JOIN setting_item_type AS type ON model.ITEM_TYPE = type.ITEM_TYPE_ID INNER JOIN setting_item_unit AS unit ON model.ITEM_UNIT = unit.ITEM_UNIT_ID WHERE model.MODEL_STATUS != 'Delete' AND model.COMPANY_ID = '".$this->companyID."'  ORDER BY model.MODEL_CODE ASC");
			}else{
				$search = $this->db->query("SELECT * FROM product_items_model AS model INNER JOIN setting_item_type AS type ON model.ITEM_TYPE = type.ITEM_TYPE_ID INNER JOIN setting_item_unit AS unit ON model.ITEM_UNIT = unit.ITEM_UNIT_ID WHERE model.MODEL_STATUS != 'Delete' AND model.COMPANY_ID = '".$this->companyID."'  ORDER BY model.MODEL_ID DESC LIMIT $offset,10");
			}
			
		}
		return 	$search->result_array();	
	}
	
	public function items_model_data($id=0, $offset=0){
		return $this->items_model_data_value($id,$offset);
	}
	
	public function items_model_data_all($id=0, $offset=0){
		return $this->items_model_data_value($id,$offset, 'all');
	}
	
}
?>