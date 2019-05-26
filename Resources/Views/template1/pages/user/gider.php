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

    <?php if(isset($success) > 0) : ?>

      <div class="alert alert-success">
        <strong>Başarılı!</strong> <?php echo $success[0]; ?>
      </div>

    <?php endif ?>

  </div>

   <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">Alım Dışı Gider Ekleme</div>
              <div class="card-body">
                <form method="post" action="<?php echo APP_URL.'gider';?>">

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
                    <label for="text" class=" col-xs-12 col-md-2  col-form-label">Gider Kategorisi Seçiniz</label>
                    <div class="col-xs-12 col-10 ">
                      <select class="js-example-basic-single col-12" id="select_category" style="width:100%;" name="giderKategori_id">

                        <?php foreach($gider_kategori as $r) : ?>
                          <option value="<?php echo $r->id; ?>"><?php echo $r->name; ?></option>
                        <?php endforeach ?>

                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="text" class=" col-xs-12 col-md-2  col-form-label">Ürün/Hizmet Adı</label>
                    <div class="col-xs-12 col-10 ">
                      <input type="text" name="adi" class="form-control" required="required">
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
                    <label for="birim" class="col-4 col-form-label">Birim</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-cube"></i>
                          </div>
                        </div> 
                        <input id="birim" name="birim" type="text" class="form-control" required="required">
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="birim_alis_fiyat" class="col-4 col-form-label">Birim Alış Fiyatı</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-money"></i>
                          </div>
                        </div> 
                        <input id="birim_alis_fiyat" name="birim_alis_fiyat" type="number" step="0.01" min="0" class="form-control" required="required" aria-describedby="birim_alis_fiyat"> 
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <i class="fa fa-turkish-lira"></i>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
                <hr >
                <div class="float-right ">
                  <i class="fa fa-plus fa-2x">Toplam = <span id="p_price"></span> </i> <i class="fa fa-try fa-2x"> </i>  vergiler Dahil.
                </div>
                <br />
                <br />
                <button type="sumbit" class="btn btn-primary col-12">Ekle</button>

                </form>
              </div> 
              
            </div>
        </div>
    </div>

<form>


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

  $('.js-example-basic-single').select2({
      tags: true,
  });

  toplam_fiyat();

  $('body').on("change",":input[name=birim_alis_fiyat],:input[name=miktar]",function(){
    toplam_fiyat();
  });

  function toplam_fiyat(){
    var baf = $(':input[name=birim_alis_fiyat]').val();
    var birim = $(':input[name=birim]').val();
    var miktar = $(':input[name=miktar]').val();
    if(baf > 0   && miktar > 0){
       var f = String(baf*miktar);
      $("i #p_price").html(f);
    }else{
      $("i #p_price").html("0,00");
    }
  }
      

</script>

<!-- Sayfa Alt Script !-->


<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>