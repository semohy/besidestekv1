<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->
  
<script type="text/javascript" src="public/js/moment.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts" ></script>

<!-- #end_sayfa head !-->

<?php require __DIR__.'/../../layouts/header.php'; ?>

<!-- Content !-->
<div class="container-fluid ">
    
    <div class="col-12">
      <div class="row">
        <div class="card col-7 bg-light">
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

        <div class="card col-5 bg-light">
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




</script>

<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>