<?php
/*
File Name: send
Description: mobile message.
Version: 1.0.0
*/

// POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$date   = $_POST['field_Date'];
	$name   = trim($_POST["field_Name"]);
	$phone  = trim($_POST["field_Phone"]);
	$know   = $_POST['field_Know'];
	$others = $_POST['field_Others'];
	$robot  = $_POST['field_robot'];

	/**** send sms start *****/
	include 'APIClient2.php';

	$api = new transmitsmsAPI("6b5cc9ba59b9133f6ef5b453734d1cd9",'microuniver');

	$to = '+6593437610';

	$sms_message = "Ru Xin Spa\nName: {$name}\nPhone: {$phone}\nDateTime: {$date}";

	// sending to a set of numbers
	$result = $api->sendSms($sms_message,$to);

	// $fp = fopen('log.txt', 'w+');
	// fwrite($fp, $result->error->code.'---'.date('Y-m-d H:i')."\r\n");
	// fclose($fp);
	 
	if($result->error->code == 'SUCCESS'){

	    //echo"Message to {$result->recipients} recipients sent with ID {$result->message_id}, cost {$result->cost}";

		require('../../../wp-load.php');

	    global $wpdb;

	    $sql = "INSERT INTO rx_appointment (name,phone,know,others,isRobot,appointmentTime,createTime)VALUES('{$name}','{$phone}','{$know}','{$others}','{$robot}','{$date}','".date('Y-m-d H:i:s')."')";

    	$wpdb->query($sql);

		//短信发送记录
	    $wpdb->query("UPDATE rx_options SET option_value=option_value+1 WHERE option_name='used-message'");

	}else{
	    echo"Error: {$result->error->code}";
	    exit;
	}

	/**** send sms end *****/

	/**** send email start *****/

	$body = "
		<h2>Reservation</h2>
		<p>Name: {$name}</p>
		<p>Phone: {$phone}</p>
		<p>Date: {$date}</p>
	";
	if(!empty($masseur)){
		$body .= "<p>Masseur: {$masseur}</p>";
	}

	if(!empty($message)){
		$body .= "<p>Special Request: {$message}</p>";
	}

	include ABSPATH.WPINC.'/class-phpmailer.php';
	include ABSPATH.WPINC.'/class-smtp.php';
	$mail             = new PHPMailer(); //new一个PHPMailer对象出来	
    $body             = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                       // 启用SMTP调试功能
    $mail->SMTPAuth   = true;                    // 启用 SMTP 验证功能
    $mail->SMTPSecure = "ssl";                   // 安全协议，可以注释掉
    $mail->Host       = 'mail.microuniver.com';  // SMTP 服务器
    $mail->Port       = 465;                     // SMTP服务器的端口号
    $mail->Username   = 'client@microuniver.com';// SMTP服务器用户名
    $mail->Password   = 'Microuniver668';        // SMTP服务器密码
    $mail->From       = "client@microuniver.com";//发件人地址
    $mail->FromName   = "MICROUNIVER";           //发件人姓名
    $mail->Subject    = 'Reservation form '.$name;
    $mail->MsgHTML($body);
    $address = 'client@microuniver.com';
    $mail->AddAddress($address, '');
    if(!$mail->Send()) {
        echo 'Mailer Error:'.$mail->ErrorInfo;
        exit;
    } else {
		//发邮件成功
    }

	/**** send sms end *****/

	echo '200';

} else {
	// 不是一个POST请求，设置一个403（禁止）响应代码
	http_response_code(403);
	echo "403";
}
 
?>