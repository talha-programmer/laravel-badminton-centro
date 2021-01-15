require('./bootstrap');

/*Bootbox dependency for displaying alerts*/
global.bootbox = require('bootbox/dist/bootbox.min');

// Bootstrap DateTime Picker
require('pc-bootstrap4-datetimepicker/build/js/bootstrap-datetimepicker.min');

// Set icons for DateTime Picker
$.extend(true, $.fn.datetimepicker.defaults, {
    icons: {
        time: 'fas fa-clock',
        date: 'fas fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'far fa-times-circle'
    }
});

// Select 2
require('select2/dist/js/select2.min')