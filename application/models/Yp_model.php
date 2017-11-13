<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yp_Model extends CI_Model{

    const TBL="yp";
    
	//插入数据
	public function insert($conditions=array())
	{
		$this->db->insert(self::TBL, $conditions); 
		return $this->db->insert_id();
	}
	
	//获取单条数据
	public function get_detail($conditions=array())
	{
		return  $this->db->get_where(self::TBL, $conditions)->row_array();
	}
	
	//节点列表
	public function get_page_list($conditions=array(), $offset, $limit) 
	{
		return $this->db->where($conditions)->order_by('id','desc')->limit($offset, $limit)->get(self::TBL)->result_array();
	}

	//更新节点
	public function update($id,$conditions=array())
	{
		$this->db->where('id', $id)->update(self::TBL, $conditions); ;
		return $this->db->affected_rows();
	}

	//查询总条数
	public function get_total($conditions=array())
	{
    	return $this->db->where($conditions)->count_all_results(self::TBL);
	}
	
	//获取列表
	public function get_list()
	{
		return $this->db->get(self::TBL)->result_array();
	}
	
}
