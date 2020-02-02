/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'

window.Vue = require('vue')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.config.productionTip = false
Vue.config.devtools = false
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// import './fontawesome-kit-pro.js'
import 'admin-lte/dist/js/adminlte.min.js'
import 'bootstrap-notify'
import 'select2'
import 'datatables.net-bs4'
import 'datatables.net-buttons-bs4'
import 'datatables.net-buttons/js/buttons.colVis.js'
import 'datatables.net-buttons/js/buttons.flash.js'
import 'datatables.net-buttons/js/buttons.html5.js'
import 'datatables.net-buttons/js/buttons.print.js'

import 'pace-js/pace.min.js'


window.swal = require('sweetalert2')
window.alertify = require('alertifyjs')


import './global.js'

import moment from 'moment'
import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin, { Draggable } from '@fullcalendar/interaction'
import resourceTimeGridPlugin from '@fullcalendar/resource-timegrid'
import resourceTimelinePlugin from '@fullcalendar/resource-timeline'


window.Calendar = Calendar
window.dayGridPlugin = dayGridPlugin
window.interactionPlugin = interactionPlugin
window.Draggable = Draggable
window.resourceTimeGridPlugin = resourceTimeGridPlugin
window.resourceTimelinePlugin = resourceTimelinePlugin
window.moment = moment

$(document).ready(function(){
    $('table:not(.no-datatable)').DataTable({
        dom: 'ftp',
        fnDrawCallback: function(oSettings) {
            if (oSettings._iDisplayLength > oSettings.fnRecordsDisplay()) {
                $(oSettings.nTableWrapper).find('.dataTables_paginate').hide()
            }
        }
    })
    $('select:not(.no-select2)').select2({
        theme: 'bootstrap4',
    })
    $('section.content').fadeIn('slow')
})

