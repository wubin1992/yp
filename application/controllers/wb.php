<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wb extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Yp_model','yp');
	}

	public function index()
	{
		
	}
	
		
	
}
