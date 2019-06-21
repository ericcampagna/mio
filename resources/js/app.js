/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery'); 
require('bootstrap');
require('../vendor/jquery-easing/jquery.easing.min.js');
require('../vendor/datatables/jquery.dataTables.min.js');
require('../vendor/datatables/dataTables.bootstrap4.min.js');
require('./sb-admin-2.js');


window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('csv-importer', require('./components/CsvImporter.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 // window.addEventListener('load', function () {
	import axios from 'axios';

	const app = new Vue({
	    el: '#app',
	    data:{
	    	user: 'Eric Campagna',
	    	showDataForm: true,
	    	customer: {
	    		name: '',
	    		data: null,
	    		pricing: null,
	    		size: 'Medium',
	    		type: 'Change',
	    		error: {
	    			name: false
	    		}
	    	},
	    	mio: {

	    	}

	    },
	    methods:{
	    	loadAll: function(event){
				event.preventDefault();
				if(!this.customer.name){
					this.customer.error.name = true;
					return;
				}
				this.showDataForm = false;

				var count = Object.keys(this.customer.data).length;

				$.each(this.customer.data, function(key, data) {
					axios({
						method: 'post',
						url: '/interchange/get-part',
						contentType: 'application/json',
						data: {
							pn: data['Part Number']
						}
					})
						.then(function (response) {
							data['MTR PN'] = response.data.mtr_pn;
							console.log(response.data.mtr_pn);
						});
				});
	    	}
	    }
	});


// });