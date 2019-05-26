async function stokLog_chart(chart_datas,categories){

var formatted_categories = [];
$.each(categories,function(e){
  console.log(categories[e]);
  formatted_categories.push( moment(categories[e]).format('Do MMM YYYY') );
});

var series = [];

$.each(chart_datas,function(e){
  series.push(chart_datas[e]);
});

var options_stokLog = {
  chart: {
    height: 350,
    type: 'line',
    toolbar: {
          show: true,
          tools: {
            download: true,
            selection: true,
            zoom: true,
            zoomin: true,
            zoomout: true,
            pan: true,
            reset: true | '<img src="/static/icons/reset.png" width="20">',
            customIcons: []
          },
          autoSelected: 'zoom' 
        },
        zoom: {
        enabled: true,
        type: 'x',  
        zoomedArea: {
          fill: {
            color: '#90CAF9',
            opacity: 0.4
          },
          stroke: {
            color: '#0D47A1',
            opacity: 0.4,
            width: 1
          }
        }
    }
  },
  series: series,
  xaxis: {
    categories:  formatted_categories //dates
  },

}

var chart_stokLog = new ApexCharts(document.querySelector("#stokChart"), options_stokLog);

chart_stokLog.render();
}