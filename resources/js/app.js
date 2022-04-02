require('./bootstrap');
window.$ = window.jQuery = require('jquery')
require('bootstrap/dist/js/bootstrap.min')
window.toastr = require("toastr/toastr")
import dateRangePicker from 'daterangepicker'
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(()=>{
    const nowDate = new Date();
    const today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    new dateRangePicker($("#quiz-time"), {
        parentEl: '#create-quiz-modal',
        timePicker24Hour: true,
        timePicker: true,
        minDate: today,
        locale: {
            format: 'DD-MM-YYYY hh:mm A'
        }
    })
})
