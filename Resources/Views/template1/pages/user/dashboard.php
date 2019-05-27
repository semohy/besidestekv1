<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->
<style type="text/css">
  .dashboardCard{
    margin: 5px;
  }
</style>

<script type="text/javascript" src="public/js/moment.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts" ></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

<!-- #end_sayfa head !-->

<?php require __DIR__.'/../../layouts/header.php'; ?>

<!-- Content !-->
<div class="container-fluid ">
    
    <div class="col-12">
      
      <div class="row">
        <div class="card col-6 bg-light dashboardCard">
                <div class="card-header">Stok Hareketleri</div>
                <div class="card-body">
                    <div class="col-md-12">
                      <div>
                        </div>
                      <div class=" bg-light ">
                        <div id="stokChart"></div>
                      </div>
                    </div>
                </div>
        </div>
          <div class="card col-5 bg-light dashboardCard">
                  <div class="card-header">g2</div>
                  <div class="card-body">
                      <div class="col-md-12">
                        <div>
                          </div>
                        <div class=" bg-light ">
                          <canvas id="myChart"></canvas>
                        </div>
                      </div>
                  </div>
          </div>
      </div>
  

  </div>

</div>
<!-- #end_Content !-->

<?php require __DIR__.'/../../layouts/footer_script.php'; ?>
</script>
<!-- Sayfa Alt Script !-->

<script type="text/javascript" src="public/js/getItemAjax.js"></script>
<script type="text/javascript" src="public/js/charts/dashboardCharts.js"></script>


<script>

function  stok_chart1(){
  var url = "<?php echo APP_URL.'ajax/dashboardCharts/stoklogs'; ?>";
  var data = {
    updated_at : moment().subtract({'months':6}).format('YYYY-MM-DD')
  };
  getItemAjax(url,"post",data,function(e){
    var e = JSON.parse(e);

    var stokLog_chart_datas = e.seriler;
    var stokLog_categories = e.x;
    stokLog_chart(stokLog_chart_datas,stokLog_categories);

  });
}

//stok_chart1();

//sdadddddddddddddddddddd

var datasets=[];

var url = "<?php echo APP_URL.'ajax/dashboardCharts/stoklogs_c2'; ?>";
  var data = {
    updated_at : moment().subtract({'months':6}).format('YYYY-MM-DD')
  };
  var that = this;
  getItemAjax(url,"post",data,function(e){
    console.log(e);
    /*var e = JSON.parse(e);
    $.each(e,function(e){

      var dataset = {
        label: e.label,
        data:e.data
      };

      datasets.push([label])

    });*/
    
    
  });


var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'line',
  data: { datasets: datasets },
  options: {
    scales: {
      xAxes: [{
        type: 'time'
      }]
    }
  }
});




</script>

<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>