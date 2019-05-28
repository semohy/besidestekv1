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

        <div class="card col-md-8 col-sm-12 bg-light dashboardCard">
                <div class="card-header">Stok Hareketleri</div>
                <div class="card-body">
                    <div class="col-12">
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

          <div class="card col-md-3 col-sm-12 bg-light dashboardCard">
                  <div class="card-header">Gelir Gider Dengesi</div>
                  <div class="card-body">

                    <div id="ggline">
                      <div class="col-12">
                            <select id="select" name="sure" class="custom-select">
                              <option value="6" selected> 6 ay</option>
                              <option value="12">1 yıl</option>
                            </select>
                          </div>
                    </div>

                    <div id="gelirGiderChart"></div>

                    <button class="btn btn-primary col-12" id="giderGelir_expand" type="button" data-toggle="collapse" data-target="#collapsegiderGelir" aria-expanded="false" aria-controls="collapseExample">Genişlet</button>

                  </div>
          </div>
      </div>

      <div class="row collapse"  id="collapsegiderGelir">
        <div class="card col-md-11 col-sm-12 bg-light  ">
                <div class="card-header">Gelir Gider Expand <button class="btn btn-danger float-right" type="button" data-toggle="collapse" data-target="#collapsegiderGelir" aria-expanded="false" aria-controls="collapseExample">Kapat</button></div>
                
                <div class="card-body">
                  <div class="row">
                    <div id="gg_expand_line">
                      <div class="col-12">
                            <select id="select" name="sure" class="custom-select">
                              <option value="6" selected> 6 ay</option>
                              <option value="12">1 yıl</option>
                            </select>
                          </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-sm-12 col-md-3">
                        <h5>Gelirler</h5>
                        <div class="chart1"></div>
                    </div>

                    <div class="col-sm-12 col-md-3">
                        <h5>Giderler</h5>
                        <div class="chart2"></div>
                    </div>

                    <div class="col-sm-12 col-md-6" style="overflow-x: auto;">
                        <h5>Zamana Göre</h5>
                        <div class="chart3"></div>
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
    //console.log(e);
    var e = JSON.parse(e);

    var stokLog_chart_datas = e.seriler;
    var stokLog_categories = e.x;
    stokLog_chart(stokLog_chart_datas,stokLog_categories);

  });
}

stok_chart1();

$('body').on('change','#ggline  :input[name=sure] ',function(){
    $('#gelirGiderChart').empty();
    gelirGiderChart();
  });

function gelirGiderChart(){
  var sure = $('#ggline :input[name=sure]').val();
  var url = "<?php echo APP_URL.'ajax/dashboardCharts/chartsgelirgider'; ?>";
  var data = {
    tarih : moment().subtract({'months':sure}).format('YYYY-MM-DD')
  };

  getItemAjax(url,"post",data,function(e){
    //console.log(e);
    var e = JSON.parse(e);

    var seriler = e.seriler;
    var labels = e.labels;
    
    ApexPie("#gelirGiderChart",350,labels,seriler,"top");
    });
}

gelirGiderChart();

//expamd gelir -gider
$('body').on('click','#giderGelir_expand ',function(){
    gelirlerChart();
    giderlerChart();
   // gelirGiderDate();
   // ApexColumn(dom_selector,width,seriler,kategoriler,text)
  });
$('body').on('change','#gg_expand_line  :input[name=sure] ',function(){
   gelirlerChart();
   giderlerChart();
   gelirGiderDate();
  });


function gelirlerChart(){
  $('#collapsegiderGelir .chart1').empty();
  var sure = $('#gg_expand_line :input[name=sure]').val();
  var url = "<?php echo APP_URL.'ajax/dashboardCharts/chartsgelirler'; ?>";
  var data = {
    tarih : moment().subtract({'months':sure}).format('YYYY-MM-DD')
  };

  getItemAjax(url,"post",data,function(e){
    //console.log(e);
    var e = JSON.parse(e);

    var seriler = e.seriler;
    var labels = e.labels;
    
    ApexPie("#collapsegiderGelir .chart1",280,labels,seriler,"top");
    });
}

function giderlerChart(){
  $('#collapsegiderGelir .chart2').empty();
  var sure = $('#gg_expand_line :input[name=sure]').val();
  var url = "<?php echo APP_URL.'ajax/dashboardCharts/chartsgiderler'; ?>";
  var data = {
    tarih : moment().subtract({'months':sure}).format('YYYY-MM-DD')
  };

  getItemAjax(url,"post",data,function(e){
    //console.log(e);
    var e = JSON.parse(e);

    var seriler = e.seriler;
    var labels = e.labels;
    
    ApexPie("#collapsegiderGelir .chart2",280,labels,seriler,"top");
    });
}

function gelirGiderDate(){
  $('#collapsegiderGelir .chart3').empty();
  var sure = $('#gg_expand_line :input[name=sure]').val();
  var url = "<?php echo APP_URL.'ajax/dashboardCharts/chartsgelirGiderDate'; ?>";
  var data = {
    tarih : moment().subtract({'months':sure}).format('YYYY-MM-DD')
  };

  getItemAjax(url,"post",data,function(e){
    console.log(e);
    var e = JSON.parse(e);
    
    var seriler=[{
      name : 'Gelir',
      type : 'column',
      data : e["gelir"]
    },{
      name : 'Gider',
      type : 'column',
      data : e["gider"]
    }];

    var kategoriler = e["aylar_kategori"];
    
    ApexColumn("#collapsegiderGelir .chart3",650,seriler,kategoriler,"TL");
    });
}
gelirGiderDate();



</script>

<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>