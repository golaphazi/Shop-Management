<?php
Class Dashboard_model Extends CI_model {
	public $userID;

    public function __construct() {
        parent::__construct();
        $this->userID = $this->session->userData( 'userID' );
    }
	
	
	public function home(){
		return 'dgdg';
	}
	
}
?>