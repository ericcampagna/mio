import {Line} from 'vue-chartjs';

export default ({
	components: { Line },
	mounted () {
		this.renderChart({
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June'],
			datasets: [
				{label: 'Sales', backgroundColor: '#333', data: [40,39,31,11,45,50]}
			]
		}, {responsive: true})
	}
}) 