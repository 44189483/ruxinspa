// 关于月份： 在设置时要-1，使用时要+1
$(function () {

  $('#calendar').calendar({
    ifSwitch: true, // 是否切换月份
    hoverDate: true, // hover是否显示当天信息
    backToday: false, // 是否返回当天
    choseBtn: false,//是否使用上下月按钮
    monthText: 'January,February,March,April,May,June,July,August,September,October,November,December',
    weekText: 'SUN,MON,TUE,WEB,THU,FRI,SAT',
    pre:'<div data-icon="<"></div>',
    next:'<div data-icon="="></div>',
    cha: 3
  });

});

;(function ($, window, document, undefined) {

  var Calendar = function (elem, options) {
    this.$calendar = elem;

    this.defaults = {
      ifSwitch: true,
      hoverDate: false,
      backToday: false,
      choseBtn: true,
      monthText: '一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月',
      weekText: '日,一,二,三,四,五,六',
      pre:'<',
      next:'>',
      cha: 0
    };

    this.opts = $.extend({}, this.defaults, options);

    // console.log(this.opts);
  };

  var _monthArr = new Array(); //月文字数组

  var _weekArr = new Array(); //星期文字数组

  var curDate = new Date();

  Calendar.prototype = {

    /*
    showHoverInfo: function (obj) { // hover 时显示当天信息
      var _dateStr = $(obj).attr('data');
      var offset_t = $(obj).offset().top + (this.$calendar_today.height() - $(obj).height()) / 2;
      var offset_l = $(obj).offset().left + $(obj).width();
      var changeStr = _dateStr.substr(0, 4) + '-' + _dateStr.substr(4, 2) + '-' + _dateStr.substring(6);
      var _week = changingStr(changeStr).getDay();
      var _weekStr = '';

      this.$calendar_today.show();

      this.$calendar_today
            .css({left: offset_l + 30, top: offset_t})
            .stop()
            .animate({left: offset_l + 16, top: offset_t, opacity: 1});

      _weekArr = this.opts.weekText.split(",");

      _weekStr = _weekArr[_week];

      switch(_week) {
        case 0:
          _weekStr = _weekArr[];
        break;
        case 1:
          _weekStr = 'MON';
        break;
        case 2:
          _weekStr = 'TUE';
        break;
        case 3:
          _weekStr = 'WEB';
        break;
        case 4:
          _weekStr = 'THU';
        break;
        case 5:
          _weekStr = 'FRI';
        break;
        case 6:
          _weekStr = 'SAT';
        break;
      }

      this.$calendarToday_date.text(changeStr);
      this.$calendarToday_week.text(_weekStr);
    },
    */

    showCalendar: function () { // 输入数据并显示
      var self = this;
      var year = dateObj.getDate().getFullYear();
      var month = dateObj.getDate().getMonth();
      var dateStr = returnDateStr(dateObj.getDate());
      var firstDay = new Date(year, month, 1); // 当前月的第一天
      var _month;
      
      _monthArr = this.opts.monthText.split(",");

      _month = _monthArr[month];

      this.$calendarTitle_text.text(_month + ' ' + year);

      var cha = this.opts.cha;

      _weekArr = this.opts.weekText.split(",");

      this.$calendarDate_item.each(function (i) {
        // allDay: 得到当前列表显示的所有天数
        var allDay = new Date(year, month, i + 1 - firstDay.getDay());
        var allDay_str = returnDateStr(allDay);

        $(this).text(allDay.getDate()).attr('data', allDay_str);

        var c = allDay_str.substr(6, 2) - curDate.getDate();            

        if (c >= 0 && c < cha) {

          $(this).attr('class', 'item item-curDay');

          //添加点击事件
          $(this).bind('click', function () {

            var panel = $('.appointment-panel');

            panel.remove();

            $('li.item').removeClass('circular-bg');

            if(panel.attr('id') == i){
              $('#'+i).remove();
            }else{

              $(this).addClass('circular-bg');

              var j = 0,rowIndex = 0;
              var s,e,t1,t2,str,tH1,tH2;
              var _dateStr = $(this).attr('data');
              var changeStr = _dateStr.substr(0, 4) + '-' + _dateStr.substr(4, 2) + '-' + _dateStr.substring(6);
              var _week = changingStr(changeStr).getDay();
              _weekStr = _weekArr[_week];

              //当前为今天
              if($(this).attr('data') == returnDateStr(new Date)){
                tH1 = tH2 = curDate.getHours();
              }else{
                tH1 = 0;
                tH2 = 10;
              }
              
              str += '<li class="appointment-panel" id="'+i+'"><h3>AVAILABLE APPOINTMENT</h3><ul>';

              if(tH1 < 3){

                for (var k = tH1; k < 3; k++) {

                  j = k + 1;

                  str += '<li><span class="time"><i class="fa fa-clock-o"></i> '+k+':00 AM - '+j+':00 AM</span><span class="date">'+_dateStr.substring(6)+' '+_month+' '+year+'('+_weekStr+')</span><span class="btn gradient" onclick="showAppointment(\''+_dateStr.substring(6)+' '+_month+' '+year+' at '+k+':00 AM - '+j+':00 AM\')">BOOK APPOINTMENT</span></li>';

                };

              }

              for (var k = tH2; k < 24; k++) {

                if(k == 12){
                  t1 = 'AM';
                  t2 = 'PM';
                  s = 12;
                }else if(k < 12){
                  t1 = 'AM';
                  t2 = 'AM';
                  s = k;
                }else{
                  t1 = t2 = 'PM';
                  s = k - 12;
                }

                e = s + 1;

                str += '<li><span class="time"><i class="fa fa-clock-o"></i> '+s+':00 '+t1+' - '+e+':00 '+t2+'</span><span class="date">'+_dateStr.substring(6)+' '+_month+' '+year+'('+_weekStr+')</span><span class="btn gradient" onclick="showAppointment(\''+_dateStr.substring(6)+' '+_month+' '+year+' at '+s+':00 '+t1+' - '+e+':00 '+t2+'\')">BOOK APPOINTMENT</span></li>';
                
              };

              str += '</ul></li>';

              //计算行位
              if(i < 7){
                rowIndex = 6;
              }else if(i >= 7 && i < 14){
                rowIndex = 13;
              }else if(i >= 14 && i < 21){
                rowIndex = 20;
              }else if(i >= 21 && i < 28){
                rowIndex = 27;
              }else if(i >= 28 && i < 35){
                rowIndex = 34;
              }else{
                rowIndex = 41;
              }

              $(".calendar-date li").eq(rowIndex).after(str.replace('undefined',''));

            }

          });

        //} else if (returnDateStr(firstDay).substr(0, 6) === allDay_str.substr(0, 6)) {
          //$(this).attr('class', 'item item-curMonth');
        } else {
          $(this).attr('class', 'item');
        }

      });
    },

    renderDOM: function () { // 渲染DOM
      this.$calendar_title = $('<div class="calendar-title"></div>');
      this.$calendar_week = $('<ul class="calendar-week"></ul>');
      this.$calendar_date = $('<ul class="calendar-date"></ul>');
      this.$calendar_today = $('<div class="calendar-today"></div>');

      _weekArr = this.opts.weekText.split(",");

      var _titleStr = '<a href="#" class="title"></a>'+
                      '<a href="javascript:;" id="backToday">T</a>'+
                      '<div class="arrow">'+
                        '<span class="arrow-prev">'+ this.opts.pre +'</span>'+
                        '<span class="arrow-next">'+ this.opts.next +'</span>'+
                      '</div>';
      var _weekStr = '<li class="item">'+ _weekArr[0] +'</li>'+
                      '<li class="item">'+ _weekArr[1] +'</li>'+
                      '<li class="item">'+ _weekArr[2] +'</li>'+
                      '<li class="item">'+ _weekArr[3] +'</li>'+
                      '<li class="item">'+ _weekArr[4] +'</li>'+
                      '<li class="item">'+ _weekArr[5] +'</li>'+
                      '<li class="item">'+ _weekArr[6] +'</li>';
      var _dateStr = '';
      var _dayStr = '<i class="triangle"></i>'+
                    '<p class="date"></p>'+
                    '<p class="week"></p>';

      for (var i = 0; i < 6; i++) {
        _dateStr += '<li class="item">26</li>'+
                    '<li class="item">26</li>'+
                    '<li class="item">26</li>'+
                    '<li class="item">26</li>'+
                    '<li class="item">26</li>'+
                    '<li class="item">26</li>'+
                    '<li class="item">26</li>';
      }

      this.$calendar_title.html(_titleStr);
      this.$calendar_week.html(_weekStr);
      this.$calendar_date.html(_dateStr);
      this.$calendar_today.html(_dayStr);

      this.$calendar.append(this.$calendar_title, this.$calendar_week, this.$calendar_date, this.$calendar_today);
      this.$calendar.show();
    },

    inital: function () { // 初始化
      var self = this;

      this.renderDOM();

      this.$calendarTitle_text = this.$calendar_title.find('.title');
      this.$backToday = $('#backToday');
      this.$arrow_prev = this.$calendar_title.find('.arrow-prev');
      this.$arrow_next = this.$calendar_title.find('.arrow-next');
      this.$calendarDate_item = this.$calendar_date.find('.item');
      this.$calendarToday_date = this.$calendar_today.find('.date');
      this.$calendarToday_week = this.$calendar_today.find('.week');

      this.showCalendar();

      if (this.opts.ifSwitch) {
        this.$arrow_prev.bind('click', function () {
          var _date = dateObj.getDate();

          dateObj.setDate(new Date(_date.getFullYear(), _date.getMonth() - 1, 1));

          self.showCalendar();
        });

        this.$arrow_next.bind('click', function () {
          var _date = dateObj.getDate();

          dateObj.setDate(new Date(_date.getFullYear(), _date.getMonth() + 1, 1));

          self.showCalendar();
        });
      }

      if(!this.opts.choseBtn){
        $("#calendar .arrow").remove();
      }

      if (this.opts.backToday) {
        this.$backToday.bind('click', function () {
          if (!self.$calendarDate_item.hasClass('item-curDay')) {
            dateObj.setDate(new Date());

            self.showCalendar();
          }
        });
      }else{
        $("#backToday").remove();
      }

      /*
      this.$calendarDate_item.hover(function () {
        self.showHoverInfo($(this));
      }, function () {
        self.$calendar_today.css({left: 0, top: 0}).hide();
      });
      */

    },

    constructor: Calendar
  };

  $.fn.calendar = function (options) {
    var calendar = new Calendar(this, options);
    return calendar.inital();
  };


  // ========== 使用到的方法 ==========

  var dateObj = (function () {
    var _date = new Date();

    return {
      getDate: function () {
        return _date;
      },

      setDate: function (date) {
        _date = date;
      }
    }
  })();

  function returnDateStr(date) { // 日期转字符串
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();

    month = month < 9 ? ('0' + month) : ('' + month);
    day = day < 9 ? ('0' + day) : ('' + day);

    return year + month + day;
  };

  function changingStr(fDate) { // 字符串转日期
    var fullDate = fDate.split("-");
    return new Date(fullDate[0], fullDate[1] - 1, fullDate[2]); 
  };

})(jQuery, window, document);