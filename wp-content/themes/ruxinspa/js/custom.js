$(function(){

	//
	$('#myCarousel').carousel('pause');

	$('#myCarousel .item').hover(function(){
        $(this).find('.circular').addClass('carousel-hover');
        $(this).find('.circular .btn').fadeIn(500);
    },function(){
        $(this).find('.circular').removeClass('carousel-hover');
        $(this).find('.circular .btn').fadeOut(500);
    });

    $('.services li').hover(function(){
        $(this).find('.circular').addClass('carousel-hover');
    },function(){
        $(this).find('.circular').removeClass('carousel-hover');
    });

	//相册效果
    $('.gallery li').hover(function(){
        $(this).find('.title').fadeIn(500);
    },function(){
        $(this).find('.title').fadeOut(500);
    });

    $("#facebook_list").cxScroll();

    var form = $('#ajax-appointment');
	// 为表单创建事件监听
	$(form).submit(function(e) {

		//阻止浏览器直接提交表单
		e.preventDefault();

		//手机验证
		var mobile = document.getElementById("mdInputPhone");;
	    mobile.onblur = function(){
	        if(mobile.validity.patternMismatch){ 
	            mobile.setCustomValidity("cell phone number error.");
	        }
	    };

        //手机验证
        var robot = $("#mdCheckRot");
        if(robot.val() == '1'){
            $('.isrobot p i').attr('style','color:red');
            return false;
        }

        // 序列化表单数据 隐藏域无法获到值FUCK
        var formData = $(form).serialize();

        // 使用AJAX提交表单
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData,
            beforeSend: function ( xhr ) {
                $('.load-wrap').append('<img src="../wp-content/themes/ruxinspa/images/loading.gif" alt="" />');
                $('#submit').hide();
            }
        })
        .done(function(response) {

            $('#modalTip').modal();

            if(response == 200){

                $('#myModal').modal('hide');

                // 清除表单
                $('#mdInputName').val('');
                $('#mdInputPhone').val('');
                $('#mdCheckKnow').val('');
                $('#mdInputOthers').val('');
                $('.know i').attr("class","fa fa-square-o purple-font");
                $('.isrobot').find('i').attr("class","fa fa-square");
              
                $('#myModalLabel').html('<img src="../wp-content/themes/ruxinspa/images/icon_person.png" alt="" style="float:left;width:70px;"/>Thank You For <br/>Using Our Online Booking System.');

                $(formMessages).html('<img src="../wp-content/themes/ruxinspa/images/icon_tel.png" alt="" style="float:left;margin:-15px 10px 0 0;width:50px;"/>Our staff will contact you for confirmation shortly.');

            }else if(response == 500){
                $('#myModalLabel').text('Tip');
                $(formMessages).text('Internal Server Error.');
            }

            $('.load-warp img').remove();

            $('#submit').show();

        })
        .fail(function(data) {

            $('#modalTip').modal();

            $('#myModalLabel').text('Tip');

            // 设置消息文本
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('An error occurred and could not send.');
            }

            $('#submit').show();

            $('.load-warp img').remove();

        });
 
	});

});

//dialog
function showAppointment(value){
    $('#mdInputDate').val(value);
    $('#myModal').modal();
}

$('.know label').click(function(e){ 

    $(this).parent().siblings().find('i').attr("class","fa fa-square-o purple-font");

    $('#mdCheckKnow').val('');
    var class_style = $(this).find('i').attr("class");
    if(class_style == 'fa fa-square-o purple-font'){
        $(this).find('i').attr("class","fa fa-check-square purple-font");
        $('#mdCheckKnow').val($(this).parent().attr('data-value'));
    }else{
        $(this).find('i').attr("class","fa fa-square-o purple-font");
    }
    e.preventDefault(); //阻止元素的默认动作（如果存在） 
}); 

//来回切换
var num2 = 0; 
$('.isrobot').click(function(e){ 
    if(num2++ %2 == 0){ 
        $(this).find('i').attr("class","fa fa-check-square-o");
        $(this).find('i').removeAttr('style');
        $('#mdCheckRot').val(0);
    }else{ 
        $(this).find('i').attr("class","fa fa-square-o");
        $('#mdCheckRot').val(1);
    } 
    e.preventDefault(); //阻止元素的默认动作（如果存在） 
}); 
