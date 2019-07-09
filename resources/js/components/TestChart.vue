<template>
  <div class="container">
    <line-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
  import LineChart from './Charts/LineChart.js'

  export default {
    name: 'LineChartContainer',
    components: { LineChart },
    data: () => ({
      loaded: false,
      chartdata: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
        datasets: [
          {
            label: 'Numbers',
            backgroundColor: '#f87979',
            data: null
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRation: false
      }
    }),
    async mounted () {
      this.loaded = false
      try{
          let response =  await fetch('chart/testapi')
          let rData = await response.json()
          this.chartdata.datasets[0].data = rData
          this.loaded = true
      } catch (e) {
        console.error(e)
      }
    }
  }
</script>

<style>

</style>