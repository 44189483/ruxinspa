<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Ru_Xin_Spa
 * @since Ru Xin Spa 1.0
 */

get_header(); ?>

<div class="center banner white-font">
  <h1 class="pt50">Contact Us</h1>
  <p>Home | Contact Us</p>
</div>
<div class="grid-row">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="center">
          <h3 class="font-arizonia gray-font">Welcome to</h3>
          <h2>Ru Xin Spa</h2>
          <p class="ce_sub_title"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/icon/flower.png" alt=""></p>
          <p>
            <h3>Massage Promotes Quality Sleep!</h3>
            <span class="gray-font font16">Come to Envy Spa for all of your massage needs.</span>
          </p>
          <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.58551040133!2d103.84412771478333!3d1.4243617989612065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da14419395b365%3A0x57d8090a119fddc6!2s417+Yishun+Ave+11%2C+Singapore+760417!5e0!3m2!1sen!2ssg!4v1502861392155" width="1140" height="448" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
    <div class="row center">
      <div class="col-sm-4">
        <h3>Location</h3>
        <span class="gray-font font14">
          <a href="https://www.google.ro/maps/place/L.R.H.+Pte+Ltd/@1.4244896,103.8303206,17z/data=!3m1!4b1!4m5!3m4!1s0x31da14720ffe9c91:0x445e898898b8792b!8m2!3d1.4244896!4d103.8325093" target="_blank">
            Blk 417 Yishun Ave ll<br/>#01-323 Singapore 760417
          </a>
        </span>
      </div>
      <div class="col-sm-4">
        <h3>Opening Hour</h3>
        <span class="gray-font font14">Monday to Sunday<br/>10:00am - 4:00am</span>
      </div>
      <div class="col-sm-4">
        <h3>Contact</h3>
        <span class="gray-font font14">
          <a href="tel:62571829">+(65)6257 1829</a><br/>
          <a href="mailto:contact@ruxinspa.com">contact@ruxinspa.com</a>
        </span>
      </div>
    </div>
  </div>
</div>
<div class="grid-row-gray">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 center">
        <h3 class="font30"><strong>Contact Us By Email</strong></h3>
        <p class="gray-font">We welcome your suggestions.</p>
        <form method="POST" action="" class="contactForm">
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                <input type="text" id="username" name="username" placeholder="Name" required="required"/>
              </div>
              <div class="col-sm-4">
                <input type="email" id="useremail" name="useremail" placeholder="Email" required="required"/>
              </div>
              <div class="col-sm-4">
                <input type="tel" id="userphone" name="userphone" placeholder="Phone" required="required" pattern="^(8|9)\d{7}$"/>
              </div>
              <div class="col-sm-12">
                <textarea name="message" required="required">Messages</textarea>
                <button type="submit" name="submit" class="appointment gradient">SEND MESSAGES</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
  // POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $useremail = trim($_POST["useremail"]);
    $userphone = trim($_POST["userphone"]);
    $message = trim($_POST["message"]);

    /**** send email start *****/
    $body = "
      <h2>Reservation</h2>
      <p>Name: {$username}</p>
      <p>Email: {$useremail}</p>
      <p>Phone: {$userphone}</p>
    ";
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
    $mail->Username   = 'client@microuniver.com';// SMTP服务器用户名，PS：我乱打的
    $mail->Password   = 'Microuniver668';        // SMTP服务器密码
    $mail->From       = "client@microuniver.com";//发件人地址
    $mail->FromName   = "MICROUNIVER";           //发件人姓名
    $mail->Subject    = 'Reservation form '.$name;
    $mail->MsgHTML($body);
    $address = '44189483@qq.com';
    $mail->AddAddress($address, '');
    if(!$mail->Send()) {
      echo 'Mailer Error:'.$mail->ErrorInfo;
      exit;
    } else {
      //发邮件成功
    }

    /**** send email end *****/

}
?>
<?php get_footer(); ?>
