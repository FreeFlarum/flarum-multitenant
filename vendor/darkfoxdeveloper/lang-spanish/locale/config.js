dayjs.locale({
	name: 'es-ES',
	weekdays : 'Domingo_Lunes_Martes_Miércoles_Jueves_Viernes_Sábado'.split('_'),
	weekdaysShort: 'Dom_Lun_Mar_Mié_Jue_Vie_Sáb.'.split('_'),
	weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sá'.split('_'),
	months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
	monthsShort: 'Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sep_Oct_Nov_Dic'.split('_'),
	weekStart: 1,
 	yearStart: 4,
	formats: {
		LT : 'HH:mm',
		LTS : 'HH:mm:ss',
		L : 'DD/MM/YYYY',
		LL : 'D [de] MMMM [de] YYYY',
		LLL : 'D [de] MMMM [de] YYYY [a las] HH:mm',
		LLLL : 'dddd, D [de] MMMM [de] YYYY [a las] HH:mm'
	},
	calendar : {
		sameDay: '[Hoy a] LT',
		nextDay: '[Mañana a] LT',
		nextWeek: 'dddd [en] LT',
		lastDay: '[Ayer en] LT',
		lastWeek: function () {
			return (this.day() === 0 || this.day() === 6) ?
			'[Ultimo] dddd [a las] LT' : // Saturday + Sunday
			'[Ultima] dddd [a las] LT'; // Monday - Friday
		},
		sameElse: 'L'
	},	
	relativeTime: {
		future : 'en %s',
		past : 'hace %s',
		s : 'unos segundos',
		m : 'un minuto',
		mm : '%d minutos',
		h : 'una hora',
		hh : '%d horas',
		d : 'un día',
		dd : '%d días',
		M : 'un mes',
		MM : '%d meses',
		y : 'un año',
		yy : '%d años'
	},
 	ordinalParse: /\d{1,2}º/,
 	ordinal: n => `${n}.`	
})
