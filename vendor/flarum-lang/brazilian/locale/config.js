dayjs.locale({
	name: 'pt-BR',
	weekdays: "Domingo_Segunda-feira_Terça-feira_Quarta-feira_Quinta-feira_Sexta-feira_Sábado".split("_"),
  weekdaysShort: "Dom_Seg_Ter_Qua_Qui_Sex_Sáb".split("_"),
  weekdaysMin: "Do_2ª_3ª_4ª_5ª_6ª_Sá".split("_"),
	months: "Janeiro_Fevereiro_Março_Abril_Maio_Junho_Julho_Agosto_Setembro_Outubro_Novembro_Dezembro".split("_"),
	monthsShort: "Jan_Fev_Mar_Abr_Mai_Jun_Jul_Ago_Set_Out_Nov_Dez".split("_"),
	weekStart: 1,
 	yearStart: 4,
	formats: {
		LT : 'HH:mm',
		LTS : 'HH:mm:ss',
		L : 'DD/MM/YYYY',
		LL : 'D [de] MMMM [de] YYYY',
		LLL : 'D [de] MMMM [de] YYYY [as] HH:mm',
		LLLL : 'dddd, D [de] MMMM [de] YYYY [as] HH:mm'
	},
	calendar : {
		sameDay: '[Hoje as] LT',
		nextDay: '[Amanhã as] LT',
		nextWeek: 'dddd [em] LT',
		lastDay: '[Ontem as] LT',
		lastWeek: function () {
			return (this.day() === 0 || this.day() === 6) ?
			'[Ultimo] dddd [as] LT' : // Saturday + Sunday
			'[Ultima] dddd [as] LT'; // Monday - Friday
		},
		sameElse: 'L'
	},	
	relativeTime: {
		future : 'em %s',
		past : 'há %s',
		s : 'poucos segundos',
		m : 'um minuto',
		mm : '%d minutos',
		h : 'uma hora',
		hh : '%d horas',
		d : 'um dia',
		dd : '%d dias',
		M : 'um mês',
		MM : '%d meses',
		y : 'un ano',
		yy : '%d anos'
	},
 	ordinalParse: /\d{1,2}º/,
 	ordinal: n => `${n}.`	
})
