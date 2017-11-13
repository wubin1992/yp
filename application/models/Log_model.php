<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log_Model extends CI_Model{

    const TBL="log";
    
	//插入数据
	public function insert($conditions=array())
	{
		$this->db->insert(self::TBL, $conditions); 
		return $this->db->insert_id();
	}
	
}
