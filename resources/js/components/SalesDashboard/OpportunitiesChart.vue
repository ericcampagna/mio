<template>
  <div class="container">
    <bar-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
  import BarChart from '../Charts/BarChart.js'
  function float2dollar(value) {
        return "$ " + (value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
      }
  export default {
    name: 'OpportunitiesChart',
    components: { BarChart },
    data: () => ({
     
      loaded: false,
      chartdata: null,
      options: {
        legend: {
          display: false
        },
        title: {
          display: true,
          position: 'top',
          text: 'Total Amount in Dollars',
        },
        responsive: false,
        maintainAspectRation: true,
        tooltips: {
          callbacks: {
            label: function(tooltipItems, data) {
              return "$" + tooltipItems.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            }
          },     
        },
        scales: {
            yAxes: [{
                ticks: {
                  beginAtZero: true,
                  callback: function(value, index, values) {
                    return float2dollar(value)
                  }
                }
            }]
          },
      }
    }),
    async mounted () {
      this.loaded = false
      try{
          let response =  await fetch('data/opportunities')
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