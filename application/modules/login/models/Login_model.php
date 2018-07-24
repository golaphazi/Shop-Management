<?php
Class Login_model Extends CI_model {
	public $userID;

    public function __construct() {
        parent::__construct();
        $this->userID = $this->session->userData( 'userID' );
    }
	
	
	public function login_user($login_id,$password){
		$loginData = $this->db->query("SELECT 
											user.USER_ID,
											user.USER_LOGIN,
											company.COMPANY_ID
											
											FROM
													`shop_access_user` AS user
											INNER JOIN `shop_company` AS company ON user.COMPANY_ID = company.COMPANY_ID
											WHERE
													user.USER_STATUS IN ('Active')
													AND company.COM_STATUS IN('Active', 'DeActive', 'No_entry')
													AND user.USER_PASSWORD = '{$password}'
													AND (user.USER_LOGIN = '{$login_id}' OR user.USER_EMAIL = '{$login_id}')

								  ");
		if($loginData->num_rows() == 1){
			$userData = $loginData->row();			
			$_SESSION['companyID'] 	= $userData->COMPANY_ID;
			$_SESSION['userId'] 	= $userData->USER_ID;
			$_SESSION['userLogin'] 	= $userData->USER_LOGIN;
			$_SESSION['logged_in'] 	= true;
			
			redirect( base_url().'dashboard', 'refresh');
		}else{
			$this->session->set_flashdata('messagePr', 'Sorry!! invalid login ..');	
		}
	}
	
}
?>