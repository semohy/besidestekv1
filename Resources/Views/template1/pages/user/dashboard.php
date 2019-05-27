<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->
<style type="text/css">
  .dashboardCard{
    margin: 5px;
  }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

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
                      <div class="bg-light ">
                        <div id="stokline" class="row">
                          <div class="col-md-6 col-xs-12">
                            <select class="js-example-basic-single custom-select col-md-6 col-xs-12" id="select_stok" style="width:100%;" name="stok_kodu" " required>
                        <?php  $stok_select_counter = 0; ?>
                        <?php foreach($stoklar as $r) : ?>
                          <?php if($stok_select_counter == 0): ?>
                            <option value="<?php echo $r->stok_kodu; ?>" selected><?php echo $r->adi; ?></option>
                          <?php else: ?>
                            <option value="<?php echo $r->stok_kodu; ?>"><?php echo $r->adi; ?></option>
                          <?php endif ?>
                          <?php  $stok_select_counter = 1; ?> 
                        <?php endforeach ?>

                      </select>
                          </div>
                          <div class="col-md-6 col-xs-12">
                            <select id="select" name="sure" class="js-example-basic-single col-md-6 col-xs-12">
                              <option value="6" selected> 6 ay</option>
                              <option value="12">1 yıl</option>
                            </select>
                          </div>
                        </div>
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
  $('.js-example-basic-single').select2();

  $('body').on('change','#stokline  :input[name=sure] , #stokline :input[name=stok_kodu]',function(){
    $('#stokChart').empty();
    stok_chart1();
  });

function  stok_chart1(){
  var sure = $('#stokline :input[name=sure]').val();
  var url = "<?php echo APP_URL.'ajax/dashboardCharts/stoklogs'; ?>";
  var data = {
    stok: $('#stokline :input[name=stok_kodu]').val(),
    updated_at : moment().subtract({'months':sure}).format('YYYY-MM-DD')
  };
  getItemAjax(url,"post",data,function(e){
    var e = JSON.parse(e);

    var stokLog_chart_datas = e.seriler;
    var stokLog_categories = e.x;
    stokLog_chart(stokLog_chart_datas,stokLog_categories);

  });
}

stok_chart1();

//sdadddddddddddddddddddd
/*
var datasets=[]

var url2 = "<?php echo APP_URL.'ajax/dashboardCharts/chartjs/stoklogs'; ?>";
  var data = {
    updated_at : moment().subtract({'months':6}).format('YYYY-MM-DD')
  };
  
  getItemAjax(url2,"post",data,function(e){

    var e = JSON.parse(e);
    $.each(e,function(x){
        
      var dataset = {
        'label': x,
        'data':e[x].dataset,

      };
      datasets.data.push(dataset);
      
    });
  });

console.log(datasets.data[0]);

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

*/


</script>

<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>