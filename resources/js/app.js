require('./bootstrap');
import vue from 'vue'
import JQuery  from 'jquery'
import DataTable from 'datatables.net-bs4'
import Swal from 'sweetalert2'
window.Vue = vue;
window.$ = JQuery
window.Swal = Swal
window.DataTable = DataTable;

import App from './components/App.vue';

//importamos Axios
import VueAxios from 'vue-axios';
import axios from 'axios';

//Importamos y configuramos el Vue-router
import VueRouter from 'vue-router';
import {routes} from './routes';
import Vue from 'vue';
 
Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.prototype.$tablaGlobal = function(nombreTabla) {
	this.$nextTick(() => {		
    $(nombreTabla).DataTable({
      "order": [[ 0, 'desc' ]],
      dom: "<'row'<'col-sm-12 mb-3 text-center'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: [
        {
          "extend": "copyHtml5",
          "text": "<i class='fas fa-copy'></i> Copiar",
          "titleAttr": "Copiar",
          "className": "btn btn-secondary"
        },
        {
          "extend": "excelHtml5",
          "text": "<i class='fas fa-file-excel'></i> Excel",
          "titleAttr": "Esportar a Excel",
          "className": "btn btn-success"
        },
        {
          "extend": "pdfHtml5",
          "text": "<i class='fas fa-file-pdf'></i> PDF",
          "titleAttr": "Esportar a PDF",
          "className": "btn btn-danger"
        },
        {
          "extend": "csvHtml5",
          "text": "<i class='fas fa-file-csv'></i> CSV",
          "titleAttr": "Esportar a CSV",
          "className": "btn btn-info"
        },
        {
          "extend": "print",
          "text": "<i class='fas fa-file-csv'></i> Imprimir",
          "titleAttr": "Imprimir archivo",
          "className": "btn btn-secondary"
        }
      ]
    });
  });
}
 
const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 
//finalmente, definimos nuestra app de Vue
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});