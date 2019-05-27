<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="Public/js/bootstrap-datepicker.tr.js"></script>


<!-- #end_sayfa head !-->

<?php require __DIR__.'/../../layouts/header.php'; ?>

<!-- Content !-->
<div class="container-fluid">

  <div id="user-alerts">

    <?php if(isset($success) && count($success)> 0) : ?>

      <div class="alert alert-success">
        <strong>Başarılı!</strong> <?php echo $success[0]; ?>
      </div>

    <?php endif ?>

  </div>

   <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">Canlı Hayvan Dışı Satım</div>
              <div class="card-body">
                <form method="post" action="<?php echo APP_URL.'satim '?>">

                  <div class="form-group row">
                    <label for="text" class=" col-xs-12 col-md-2  col-form-label">Tarih</label>
                    <div class="col-10 col-xs-12 input-group">
                    <input type="text" class="datepicker form-control" name="tarih">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                  </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="text" class=" col-xs-12 col-md-2  col-form-label">Gelir Kategorisi Seçiniz</label>
                    <div class="col-xs-12 col-10 ">
                      <select class="js-example-basic-single-tag col-12" id="select_category" style="width:100%;" name="gelir_kategori">

                        <?php foreach($gelir_kategori as $r) : ?>
                          <option value="<?php echo $r->id; ?>"><?php echo $r->adi; ?></option>
                        <?php endforeach ?>

                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="text" class=" col-xs-12 col-md-2  col-form-label">Ürün/Hizmet Adı</label>
                    <div class="col-xs-12 col-10 ">
                      <select class="js-example-basic-single col-12" id="select_stok" style="width:100%;" name="stok_kodu" required>

                        <?php foreach($stoklar as $r) : ?>
                          <option value="<?php echo $r->stok_kodu; ?>"><?php echo $r->adi; ?></option>
                        <?php endforeach ?>

                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="miktar" class="col-4 col-form-label">Miktar</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-cubes"></i>
                          </div>
                        </div> 
                        <input id="miktar" name="miktar" type="number" step="0.5" min="0" class="form-control" required="required">
                      </div>
                    </div>
                  </div>
                  <hr>
                   <div class="form-group row">
                    <label for="birim" class="col-4 col-form-label">Alım Satım Birimi</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-cube"></i>
                          </div>
                        </div> 
                        <input id="alis_satis_birim" name="alis_satis_birim" type="text" class="form-control" disabled> 
                        <div class="input-group-append">
                          <div class="input-group-text">
                            /<i class="fa fa-try"></i>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="birim_satis_fiyat" class="col-4 col-form-label">Birim Satış Fiyatı</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-money"></i>
                          </div>
                        </div> 
                        <input id="birim_satis_fiyat" name="birim_satis_fiyat" type="text" class="form-control" disabled> 
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <i class="fa fa-turkish-lira"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="iskonto" class="col-4 col-form-label">İskonto</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-warning"></i>
                          </div>
                        </div> 
                        <input id="iskonto" name="iskonto" type="number" step="0.1" min="0" class="form-control">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            /<i class="fa fa-try"></i>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
                <hr >
                <div class="form-group row">
                    <label class="col-4">Stoktan Düş</label> 
                    <div class="col-8">
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input name="stok_dus" id="stok_takip_0" type="checkbox" class="custom-control-input" value="1" aria-describedby="stok_takipHelpBlock" checked="checked"> 
                        <label for="stok_takip_0" class="custom-control-label"></label>
                      </div> 
                      <span id="stok_takipHelpBlock" class="form-text text-muted">Geçmiş yılın verisi veya stok önemsiz ürünse tiki kaldırın.</span>
                    </div>
                  </div>
                  <hr>
                <div class="float-right ">
                  <i class="fa fa-plus fa-2x">Toplam = <span id="p_price"></span> </i> <i class="fa fa-try fa-2x"> </i>  vergiler Dahil.
                </div>
                <br />
                <br />
                <button type="sumbit" class="btn btn-primary col-12">Satımı Tamamla</button>

                </form>
              </div> 
              
            </div>
        </div>
    </div>




</div>
<!-- #end_Content !-->
<script type="text/javascript" src="public/js/getItemAjax.js"></script>

<?php require __DIR__.'/../../layouts/footer_script.php'; ?>


</script>
<script type="text/javascript">

  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    language: 'tr'
});
  
  $('.js-example-basic-single').select2();


  $('.js-example-basic-single-tag').select2({
      tags: true,
  });

  toplam_fiyat();


  $('body').on("change",":input[name=miktar],:input[name=iskonto]",function(){
    toplam_fiyat();
  });

  function toplam_fiyat(){
    var bsf = $(':input[name=birim_satis_fiyat]').val();
    var miktar = $(':input[name=miktar]').val();
    var iskonto = $(':input[name=iskonto]').val();

    if( miktar > 0){
       var f = String((bsf*miktar)-iskonto);
      $("i #p_price").html(f);
    }else{
      $("i #p_price").html("0,00");
    }
  }

  //urun change olursa cek
  $('body').on("change",":input[name=stok_kodu]",function(){
    var url = "<?php echo APP_URL.'ajax/satim/urun'; ?> ";
    var type = "post";
    var data = {
      stok_kodu : $(":input[name=stok_kodu]").val(),
    };

    getItemAjax(url,type,data,function(e){
     
      e = JSON.parse(e);
      if(e.status == 200){

          $(":input[name=birim_satis_fiyat]").val(e.urun.birim_satis_fiyat);
          $(":input[name=alis_satis_birim]").val(e.urun.alis_satis_birim);

      }else{

          $(":input[name=birim_satis_fiyat]").val("");
          $(":input[name=alis_satis_birim]").val("");
         
      }
      toplam_fiyat();
    });

  });
            

</script>

<!-- Sayfa Alt Script !-->


<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>