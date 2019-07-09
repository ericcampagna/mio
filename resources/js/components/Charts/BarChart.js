/*=====================================================
=            Bar Chart Built from Chart.js            =
=====================================================*/

import { Bar, mixins } from 'vue-chartjs'
const { reativeProp } = mixins

	export default{
		extends: Bar,
		mixins: [reativeProp],
		props: ['options'],
		mounted () {
			 // this.chartData is created in the mixin.
    		// If you want to pass options please create a local options object
			this.renderChart(this.chartData, this.options)
		}


	}
