<template>
  <div class="container">
    <doughnut-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
  import DoughnutChart from '../Charts/DoughnutChart.js'

  export default {
    name: 'CallChart',
    components: { DoughnutChart },
    data: () => ({
     
      loaded: false,
      chartdata: null,
      options: {
        title: {
          display: false,
          position: 'top',
          text: 'Calls by Type',
        },
        responsive: false,
        maintainAspectRation: true,
      }
    }),
    async mounted () {
      this.loaded = false
      try{
          let response =  await fetch('data/loggedCalls/chart')
          let rData = await response.json()
          this.chartdata = rData
          this.loaded = true
      } catch (e) {
        console.error(e)
      }
    },

  }
</script>

<style>

</style>