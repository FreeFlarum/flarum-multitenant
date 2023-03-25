/* Based on https://github.com/iamkun/dayjs/blob/e3777ed0f8189ad8f3a36001ecc583f74edd81df/src/locale/sk.js */

function plural(n) {
  return (n > 1) && (n < 5) && (~~(n / 10) !== 1) // eslint-disable-line
}

function translate(number, withoutSuffix, key, isFuture) {
  const result = `${number} `
  switch (key) {
    case 's':
      return (withoutSuffix || isFuture) ? 'pár sekúnd' : 'pár sekundami'
    case 'm':
      return withoutSuffix ? 'minúta' : (isFuture ? 'minútu' : 'minútou')
    case 'mm':
      if (withoutSuffix || isFuture) {
        return result + (plural(number) ? 'minúty' : 'minút')
      }
      return `${result}minútami`
    case 'h':
      return withoutSuffix ? 'hodina' : (isFuture ? 'hodinu' : 'hodinou')
    case 'hh':
      if (withoutSuffix || isFuture) {
        return result + (plural(number) ? 'hodiny' : 'hodín')
      }
      return `${result}hodinami`
    case 'd':
      return (withoutSuffix || isFuture) ? 'deň' : 'dňom'
    case 'dd':
      if (withoutSuffix || isFuture) {
        return result + (plural(number) ? 'dni' : 'dní')
      }
      return `${result}dňami`
    case 'M':
      return (withoutSuffix || isFuture) ? 'mesiac' : 'mesiacom'
    case 'MM':
      if (withoutSuffix || isFuture) {
        return result + (plural(number) ? 'mesiace' : 'mesiacov')
      }
      return `${result}mesiacmi`
    case 'y':
      return (withoutSuffix || isFuture) ? 'rok' : 'rokom'
    case 'yy':
      if (withoutSuffix || isFuture) {
        return result + (plural(number) ? 'roky' : 'rokov')
      }
      return `${result}rokmi`
  }
}
/* eslint-enable */
dayjs.locale({
  name: 'sk',
  weekdays: 'nedeľa_pondelok_utorok_streda_štvrtok_piatok_sobota'.split('_'),
  weekdaysShort: 'ne_po_ut_st_št_pi_so'.split('_'),
  weekdaysMin: 'ne_po_ut_st_št_pi_so'.split('_'),
  months: 'január_február_marec_apríl_máj_jún_júl_august_september_október_november_december'.split('_'),
  monthsShort: 'jan_feb_mar_apr_máj_jún_júl_aug_sep_okt_nov_dec'.split('_'),
  weekStart: 1,
  yearStart: 4,
  ordinal: n => `${n}.`,
  formats: {
    LT: 'H:mm',
    LTS: 'H:mm:ss',
    L: 'DD.MM.YYYY',
    LL: 'D. MMMM YYYY',
    LLL: 'D. MMMM YYYY H:mm',
    LLLL: 'dddd D. MMMM YYYY H:mm',
    l: 'D. M. YYYY'
  },
  relativeTime: {
    future: 'o %s',
    past: 'pred %s',
    s: translate,
    m: translate,
    mm: translate,
    h: translate,
    hh: translate,
    d: translate,
    dd: translate,
    M: translate,
    MM: translate,
    y: translate,
    yy: translate
  }
}, null, false)
