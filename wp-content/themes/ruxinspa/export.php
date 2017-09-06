<?php 
header('Content-type: text/html; charset=utf-8');
header("Content-type:application/vnd.ms-excel;charset=UTF-8"); 
header("Content-Disposition:filename=users.xls"); //输出的表格名称

require('../../../wp-load.php');

global $wpdb;

//$sql = urldecode($_GET['sql']);

$rows = $wpdb->get_results("SELECT name,phone FROM rx_appointment GROUP BY phone");

echo $title = "name\t phone\t\n";

//echo iconv("UTF-8","GB2312",$title);

//echo iconv("UTF-8","GB2312",base64_decode($v['wxNiCheng']))."\t";

foreach ($rows as $k => $v) {
	echo $v->name."\t";
	echo $v->phone."\t\n";
}

?>