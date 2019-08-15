// Custom Dutch Moment.js Locale File
// Based on https://github.com/moment/moment/blob/develop/locale/nl.js

moment.locale('nl', {
  months : 'januari_februari_maart_april_mei_juni_juli_augustus_september_oktober_november_december'.split('_'),
  monthsShort : 'jan._feb._mar._apr._mei_jun._jul._aug._sep._okt._nov._dec.'.split('_'),
  weekdays : 'zondag_maandag_dinsdag_woensdag_donderdag_vrijdag_zaterdag'.split('_'),
  weekdaysShort : 'zo._ma._di._wo._do._vr._za.'.split('_'),
  weekdaysMin : 'Zo_Ma_Di_Wo_Do_Vr_Za'.split('_'),
  weekdaysParseExact: true,
  longDateFormat : {
    LT : 'HH:mm',
    LTS : 'HH:mm:ss',
    L : 'DD-MM-YYYY',
    LL : 'D MMMM YYYY',
    LLL : 'D MMMM YYYY HH:mm',
    LLLL : 'dddd D MMMM YYYY HH:mm'
  },
  calendar : {
    sameDay: '[Vandaag om] LT',
    nextDay: '[Morgen om] LT',
    nextWeek: 'dddd [om] LT',
    lastDay: '[Gisteren om] LT',
    lastWeek: 'dddd [om] LT',
    sameElse: 'L'
  },
  relativeTime : {
    future : 'over %s',
    past : '%s geleden',
    s : 'een paar seconden',
    m : 'één minuut',
    mm : '%d minuten',
    h : 'één uur',
    hh : '%d uur',
    d : 'één dag',
    dd : '%d dagen',
    M : 'één maand',
    MM : '%d maanden',
    y : 'één jaar',
    yy : '%d jaar'
  },
  ordinalParse: /\d{1,2}(ste|de)/,
  ordinal : function (number) {
    return number + ((number === 1 || number === 8 || number >= 20) ? 'ste' : 'de');
  },
  week : {
    dow : 1, // Monday is the first day of the week.
    doy : 4  // The week that contains Jan 4th is the first week of the year.
  }
});
