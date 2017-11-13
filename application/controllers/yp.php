<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vendor/Autoload.php';
use QL\QueryList;
class yp extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Yp_model','yp');
	}

	public function index()
	{
		$rules = array(
			'url' 	=> array('.hy_companylist li .fl a', 'href'),
			'company' 	=> array('.hy_companylist li .fl a', 'html'),
			'tel' 	=> array('.hy_companylist li .tel', 'html'),
			'intro' 	=> array('.hy_companylist li p', 'html'),
			'data' 	=> array('.hy_companylist li dl', 'html', 'dd em'),
		);

		
			$data = QueryList::Query("http://www.51sole.com/nantong/",
				array(
				    'url' 	=> array('.hy_include li a', 'href'),
				    'type' 	=> array('.hy_include li a', 'html')
			    )
			)->data;
//			$bool = true;
			foreach ( $data as $k1 => $v1 ) {
				$url = "http://www.51sole.com{$v1['url']}";
				$type = $v1['type'];
				$page = 1;
				while (1) {
					$new_url = $url.'p'.$page++.'/';
					if ( $page == 101 ) {
						break;
					}
					echo $new_url."\n";
//					if ( $new_url == 'http://www.51sole.com/nantong-light/p37/' ) {
//						$bool = false;
//					}
//					if ( $bool ) {
//						continue;
//					}
					$res = QueryList::Query($new_url, $rules)->data;
					if ( empty($res) ) {
						break;
					}
					foreach ( $res as $k => $v ) {
						if ( !isset($v['company']) ) {
							break;
						}
						if ( $this->yp->get_detail(array('company' => $v['company'])) ) {
							echo $v['company']."已存在\n";
							continue;
						}
						$v['intro'] = $res[$k*2]['intro'];
						$v['type'] = $type;
						
						$v['data'] = str_replace(' ', '', $v['data']);
						$v['add'] = trim(wb_cut( $v['data'], '地址：', '主营产品：'));
						$v['bus'] = trim(wb_cut2( $v['data'], '主营产品：'));
						unset($v['data']);
						$this->yp->insert($v);
						echo $v['url']."\n";
					}
				}
//					exit;
			}
			
		echo '完成';
		exit;
	}
	
	//详情
	public function info()
	{
//		$res = $this->yp->get_list();
//		foreach ( $res as $k => $v )
//		{
//			if ( $v['add'] != '' ) {
//				continue;
//			}
//			
//			if ( strstr($v['url'], '.html') ) {
//				$data = QueryList::Query($v['url'],
//					array(
//					    'url' 	=> array('.contact-info li:eq(5) span a', 'href', '-em')
//				    )
//				)->data;
//				$v['url'] = $data[0]['url'];
//			}
			
			
//			$data = QueryList::Query($v['url'],
			$data = QueryList::Query('http://yzt160739.51sole.com/companyabout.htm',
				array(
				    'add' 	=> array('html', 'html', '-i')
//				    'add' 	=> array('#navcontact li:eq(1) span', 'html', '-i'),
//				    'contacts' 	=> array('#navcontact li:eq(2) span', 'html', '-i'),
//				    'tel' 	=> array('#navcontact li:eq(4) span', 'html', '-i'),
//				    'founding_time' 	=> array('#companyinfo li:eq(4)', 'html')
			    ),'','UTF-8','gb2312'
			)->data;
			
			var_dump($data);
//			$data = $data[0];
//			$data['contacts'] = trim($data['contacts']);
//			$data['founding_time'] = trim($data['founding_time'], "公司成立时间：");
//			var_dump($data);
//			if ( $v1 )
			
//			exit;
//			if ( $k1 == 10 ) {
//				exit;
//			}
//			
//		}
		
	}
	
	
}
