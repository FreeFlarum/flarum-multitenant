moment.locale('ja', {
    months: '一月_二月_三月_四月_五月_六月_七月_八月_九月_十月_十一月_十二月'.split('_'),
    monthsShort: '1 月_2月_3 月_4 月_5 月_6 月_7 月_8 月_9 月_10 月_11 月_12 月'.split('_'),
    weekdays: '日曜日_月曜日_火曜日_水曜日_木曜日_金曜日_土曜日'.split('_'),
    weekdaysShort: '日曜_月曜_火曜_水曜_木曜_金曜_土曜'.split('_'),
    weekdaysMin: '日_月_火_水_木_金_土'.split('_'),
    longDateFormat: {
      LT: 'HH:mm',
      LTS: 'HH:mm:ss',
      L: 'M 月 D 日',
      LL: 'YYYY 年 M 月 DD 日',
      LLL: 'YYYY-MM-DD HH:mm',
      LLLL: 'YYYY-MM-DD HH:mm:ss',
      l: 'M/D',
      ll: 'YY/M/D',
      lll: 'YYYY-MM-DD HH:mm',
      llll: 'YYYY-MM-DD HH:mm:ss'
    },
    calendar: {
      sameDay: function () {
        return this.minutes() === 0 ? '[今日] h [時]' : '[明日] LT';
      },
      nextDay: function () {
        return this.minutes() === 0 ? '[明日] h [時]' : '[明日] LT';
      },
      lastDay: function () {
        return this.minutes() === 0 ? '[昨日] h [時]' : '[昨日] LT';
      },
      nextWeek: function () {
        var startOfWeek, prefix;
        startOfWeek = moment().startOf('week');
        prefix = this.unix() - startOfWeek.unix() >= 7 * 24 * 3600 ? '[下]' : '[本]';
        return this.minutes() === 0 ? prefix + 'ddd h 時' : prefix + 'ddd h 时 mm';
      },
      lastWeek: function () {
        var startOfWeek, prefix;
        startOfWeek = moment().startOf('week');
        prefix = this.unix() < startOfWeek.unix() ? '[上]' : '[本]';
        return this.minutes() === 0 ? prefix + 'ddd h 時' : prefix + 'ddd h 时 mm';
      },
      sameElse: 'LL'
    },
    ordinalParse: /\d{1,2}(日|月|週)/,
    ordinal: function (number, period) {
      switch (period) {
        case 'd':
        case 'D':
        case 'DDD':
          return number + '日';
        case 'M':
          return number + '月';
        case 'w':
        case 'W':
          return number + '週';
        default:
          return number;
      }
    },
    relativeTime: {
      future: '%s以内',
      past: '%s前',
      s: '数秒',
      m: '1 分',
      mm: '%d 分',
      h: '1 時間',
      hh: '%d 時間',
      d: '1 日',
      dd: '%d 日',
      M: '1 ヶ月',
      MM: '%d ヶ月',
      y: '1 年',
      yy: '%d 年'
    },
    week: {
      // GB/T 7408-1994《数据元和交换格式·信息交换·日期和时间表示法》与ISO 8601:1988等效
      dow: 0, // Sunday is the first day of the week.
      doy: 4  // The week that contains Jan 4th is the first week of the year.
    }
  });