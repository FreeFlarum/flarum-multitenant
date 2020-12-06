// Locale configuration

;(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' && typeof require === 'function' ? factory(require('../moment')) : typeof define === 'function' && define.amd ? define(['../moment'], factory) : factory(global.moment)
}
(this, (function (moment) {
    'use strict';

     var vi = moment.defineLocale('vi-vn', {
         months : 'Tháng một_Tháng hai_Tháng ba_Tháng tư_Tháng năm_Tháng sáu_Tháng bảy_Tháng tám_Tháng chín_Tháng mười_Tháng mười một_Tháng mười hai'.split('_'),
         monthsShort : 'Tháng 1_Tháng 2_Tháng 3_Tháng 4_Tháng 5_Tháng 6_Tháng 7_Tháng 8_Tháng 9_Tháng 10_Tháng 11_Tháng 12'.split('_'),
         weekdays : 'Thứ hai_Thứ ba_Thứ tư_Thứ năm_Thứ sáu_Thứ bảy_Chủ nhật'.split('_'),
         weekdaysShort : 'Thứ 2_Thứ 3_Thứ 4_Thứ 5_Thứ 6_Thứ 7_Chủ nhật'.split('_'),
         weekdaysMin : 'T2_T2_T4_T5_T6_T7_CN'.split('_'),
         longDateFormat : {
             LT : 'HH:mm',
             LTS : 'HH:mm:ss',
             L : 'DD/MM/YYYY',
             LL : 'D MMMM YYYY',
             LLL : 'D MMMM YYYY HH:mm',
             LLLL : 'dddd, D MMMM YYYY HH:mm'
         },
         calendar : {
             sameDay : '[Hôm nay lúc] LT',
             nextDay : '[Ngày mai lúc] LT',
             nextWeek : 'dddd [lúc] LT',
             lastDay : '[Hôm qua lúc] LT',
             lastWeek : '[Mới nhất] dddd [lúc] LT',
             sameElse : 'L'
         },
         relativeTime : {
             future : 'in %s',
             past : '%s trước',
             s : 'vài giây',
             ss : '%d giây',
             m : '1 phút',
             mm : '%d phút',
             h : '1 giờ',
             hh : '%d giờ',
             d : '1 ngày',
             dd : '%d ngày',
             M : '1 tháng',
             MM : '%d tháng',
             y : '1 năm',
             yy : '%d năm'
         },
         dayOfMonthOrdinalParse: /\d{1,2}(st|nd|rd|th)/,
         ordinal : function (number) {
             var b = number % 10,
                 output = (~~(number % 100 / 10) === 1) ? 'th' :
                 (b === 1) ? 'st' :
                 (b === 2) ? 'nd' :
                 (b === 3) ? 'rd' : 'th';
             return number + output;
         },
         week : {
             dow : 1, // Monday is the first day of the week.
             doy : 4  // The week that contains Jan 4th is the first week of the year.
         }
     });
 
     return vi;
 
 })));