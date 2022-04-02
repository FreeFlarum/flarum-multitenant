// Romanian [ro]

const locale = {
  name: 'ro',
  weekdays: 'duminică_luni_marți_miercuri_joi_vineri_sâmbătă'.split('_'),
  weekdaysShort: 'dum._lun._mar._mie._joi._vin._sâm.'.split('_'),
  weekdaysMin: 'Du_Lu_Ma_Mi_Jo_Vi_Sâ'.split('_'),
  weekdaysParseExact : true,
  months: 'ianuarie_februarie_martie_aprilie_mai_iunie_iulie_august_septembrie_octombrie_noiembrie_decembrie'.split('_'),
  monthsShort: 'ian._feb._mar_apr._mai_iun_iul._aug_sep._oct._noi._dec.'.split('_'),
  monthsParseExact : true,
  weekStart: 1,
  formats: {
    LT: 'HH:mm',
    LTS: 'HH:mm:ss',
    L: 'DD.MM.YYYY',
    LL: 'D MMMM YYYY',
    LLL: 'D MMMM YYYY HH:mm',
    LLLL: 'dddd D MMMM YYYY HH:mm'
  },
  relativeTime: {
    future: 'în %s',
    past: 'acum %s',
    s: 'câteva secunde',
    m: 'un minut',
    mm: '%d minute',
    h: 'o oră',
    hh: '%d ore',
    d: 'o zi',
    dd: '%d zile',
    M: 'o lună',
    MM: '%d luni',
    y: 'un an',
    yy: '%d ani'
  },
  ordinalParse: /\d{1,2}(ul|e)/,
  ordinal: function (number) {
    return number + (number === 1 ? 'ul' : 'a');
  }
}

dayjs.locale(locale, null, false)