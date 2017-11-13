<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    protected $adminId;

    public function __construct()
    {
        parent::__construct();
//      $this->authLogin();
        $this->recordLog();
    }

    //验证用户有没有登陆
//  protected function authLogin()
//  {
//      if($this->session->has_userdata('adminId'))
//      {
//          $adminId = intval($this->session->userdata('adminId')); 
//          if($adminId > 0)
//          {
//              $this->adminId = $adminId;
//              return true;
//          }
//      }
//      
//      $this->session->set_userdata('jump', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);	//未登录前获取访问的地址
//      header('Location:/login') && exit();
//  }
    
    //记录访问日志
    protected function recordLog()
    {
//      $this->adminId
		$this->load->model('Log_model','log1');
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $add = array(
        	'ip' => getIP(),
        	'url' => $url,
        	'time' => time()
        );
        $this->log1->insert($add);
    }
	
}
