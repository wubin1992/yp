<?php
if(!function_exists('get_suffix'))
{
    /**获取后缀名
     * @param string $name 字段名字
     */
    function get_suffix($name)
    {
    	//转换成小写
    	$name = strtolower($name);
    	
    	if ( strstr($name, '.com.cn') ) return 'com.cn';//单独判断
    	$data = explode('.', $name);
    	return end($data);
    }
}

if(!function_exists('get_type'))
{
    /**获取后缀名
     * @param string $name 字段名字
     */
    function get_type($str)
    {
		$letter = "(b|p|m|f|d|t|n|l|g|k|h|j|q|x|zh|ch|sh|r|z|c|s|y|w)(a|o|e|i|u|v|ai|ei|ui|ao|ou|iu|ie|ve|er|an|en|in|un|vn|ang|eng|ing|ong|zhi|chi|shi|ri|zi|ci|si|yi|wu|yu|ye|yue|yin|yun|yuan|ying|an|en|in|un|vn|ang|eng|ing|ong)";
		
		if ( preg_match("/^({$letter}){1}$/", $str) ) {
			return '单拼音';
		}
		if ( preg_match("/^({$letter}){2}$/", $str) ) {
			return '双拼音';
		}
		if ( preg_match("/^({$letter}){3}$/", $str) ) {
			return '三拼音';
		}
		if ( preg_match("/^({$letter}){4}$/", $str) ) {
			return '四拼音';
		}
		if ( preg_match("/^[a-zA-Z]{2}$/", $str) ) {
			return '双字母';
		}
		if ( preg_match("/^[a-zA-Z]{3}$/", $str) ) {
			return '三字母';
		}
		if ( preg_match("/^[a-zA-Z]{4}$/", $str) ) {
			return '四字母';
		}
		if ( preg_match("/^[a-zA-Z]{5}$/", $str) ) {
			return '五字母';
		}
		if ( preg_match("/^\d{3}$/", $str) ) {
			return '三数字';
		}
		if ( preg_match("/^\d{4}$/", $str) ) {
			return '四数字';
		}
		if ( preg_match("/^\d{5}$/", $str) ) {
			return '五数字';
		}
		return '其他';
	}
}

/**输出json数据
 *@params int $flag 100表示执行为真，其他都为假并退出
 *@params string|int|array $data 返回的数据
 *@params bool $die 是否退出
 */
function jsonData($flag,$data,$die = false)
{
    $params['flag'] = $flag;
    $params['data'] = $data;
    echo json_encode($params);
    $flag == 100 OR exit(1);
    $die === false OR exit(2);
}

$CI = &get_instance();

if(!function_exists('post_get'))
{
    /**获取post get参数
     * @param string $name 字段名字
     * @param string [int,float,..] 字段类型
     */
    function post_get($name,$type='string')
    {
        global $CI;
        switch($type){
        case 'int':
            return intval(trim($CI->input->post_get($name,true)));
            break;
        default :
            return trim($CI->input->post_get($name,true));
        }
    }
}

if(!function_exists('build_url'))
{
	/**生成路劲
    * @param array $array 数组
    * wb 2017-5-9
    */
	function build_url( $url, $array )
	{
		foreach ( $array as $k => $v ) {
			$result[$k] = '';
			foreach ( $array as $k1 => $v1 ) {
				if ( $k != $k1 && $v1 != '' ) {
					$result[$k] .= ($result[$k] == '') ? ($k1.'='.$v1) : ('&'.$k1.'='.$v1);
				}
			}
//			$result[$k] = ($result[$k] == '') ? $url : ($url.'?'.$result[$k]);
			$result[$k] = $url.'?'.$result[$k];
		}
		return $result;
	}
}

if(!function_exists('cutstr_html'))
{
	/**去除标签以及不必要的东西
	 * @param string $string
	 */
	function cutstr_html($string){  
	    $string = strip_tags($string);  
	    $string = trim($string);  
	    $string = ereg_replace("\t","",$string);  
	    $string = ereg_replace("\r\n","",$string);  
	    $string = ereg_replace("\r","",$string);  
	    $string = ereg_replace("\n","",$string);  
	    $string = ereg_replace(" ","",$string);  
	    return trim($string);  
	}
}

if(!function_exists('random'))
{
	/**
	 * 产生随机字符串
	 */
	function random($length=32,$numeric=0) {
		$seed = '0123456789';
		$numeric or $seed .= 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$max = strlen($seed) - 1;
		$result = '';
		while($length --> 0){
			$result .= $seed{mt_rand(0,$max)};
		}
		return $result;
	}
}

if(!function_exists('wb_cut'))
{
	/**
     * php截取指定两个字符之间字符串，默认字符集为utf-8
     * @param string $begin  开始字符串
     * @param string $end    结束字符串
     * @param string $str    需要截取的字符串
     * @return string
     */
    function wb_cut($str,$begin,$end){
        $b = mb_strpos($str,$begin) + mb_strlen($begin);
        if ( $end ) {
	        $e = mb_strpos($str,$end) - $b;
	        return mb_substr($str,$b,$e);
        } else {
	        return mb_substr($str,$b);
        }
    }
}

if(!function_exists('wb_cut2'))
{
	/**
     * php截取指定两个字符之间字符串，默认字符集为utf-8
     * @param string $begin  开始字符串
     * @param string $str    需要截取的字符串
     * @return string
     */
    function wb_cut2($str,$begin){
        $b = mb_strpos($str,$begin) + mb_strlen($begin);
        return mb_substr($str,$b);
    }
}

if(!function_exists('getIP'))
{
	/**
	 * PHP获取ip
	 */
	function getIP() {
	    global $ip;
	    if (getenv("HTTP_CLIENT_IP"))
	        $ip = getenv("HTTP_CLIENT_IP");
	    else if(getenv("HTTP_X_FORWARDED_FOR"))
	        $ip = getenv("HTTP_X_FORWARDED_FOR");
	    else if(getenv("REMOTE_ADDR"))
	        $ip = getenv("REMOTE_ADDR");
	    else $ip = "Unknow";  
	    return $ip;
	}
}
?>