(function(win,doc){
    'use strict';

    let calendarEl = doc.querySelector('.calendario');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        buttonText:{
            today: 'hoje'
        },
        events:
        [
            {
                title: 'Javascript 1',
                start: '2022-12-20',
                end: '2022-12-20'
            }
        ]
    });

    calendar.render();

})(window,document);