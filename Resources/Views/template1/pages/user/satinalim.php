<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>


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
              <div class="card-header">Satın Alım</div>
              <div class="card-body">
                <form method="post" action="<?php echo APP_URL.'satinalim '?>">

                  <div class="form-group row">
                    <label for="text" class=" col-xs-12 col-md-2  col-form-label">Gider Kategorisi Seçiniz</label>
                    <div class="col-xs-12 col-10 ">
                      <select class="js-example-basic-single col-12" id="select_category" style="width:100%;" name="gider_kategori">

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
                      <select class="js-example-basic-single col-12" id="select_stok" style="width:100%;" name="adi" required>

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
                        <input id="birim_alis_fiyat" name="birim_alis_fiyat" type="number" step="0.1" min="0" class="form-control" required="required" aria-describedby="birim_alis_fiyatHelpBlock"> 
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <i class="fa fa-turkish-lira"></i>
                          </div>
                        </div>
                      </div> 
                      <span id="birim_alis_fiyatHelpBlock" class="form-text text-muted">Geliş fiyatı yoksa 0 yazınız</span>
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
                        <input id="birim_satis_fiyat" name="birim_satis_fiyat" type="number" step="0.1" min="0" class="form-control" required="required"> 
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
                    <label for="birim" class="col-4 col-form-label">Alım Satım Birimi</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-cube"></i>
                          </div>
                        </div> 
                        <input id="birim" name="alis_satis_birim" type="text" class="form-control" required="required">
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
                    <label class="col-4">Stok Takibi Yapılsın</label> 
                    <div class="col-8">
                      <div class="custom-control custom-checkbox custom-control-inline">
                        <input name="stok_takip" id="stok_takip_0" type="checkbox" class="custom-control-input" value="1" aria-describedby="stok_takipHelpBlock" checked="checked"> 
                        <label for="stok_takip_0" class="custom-control-label"></label>
                      </div> 
                      <span id="stok_takipHelpBlock" class="form-text text-muted">Stok miktarı azalınca sistem uyarı verecektir.</span>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="kritik_stok_miktar" class="col-4 col-form-label">Kritik Stok Miktar Sınırı</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-warning"></i>
                          </div>
                        </div> 
                        <input id="kritik_stok_miktar" name="kritik_stok_miktar" type="number" step="0.5" min="0" class="form-control" aria-describedby="kritik_stok_miktarHelpBlock">
                      </div> 
                      <span id="kritik_stok_miktarHelpBlock" class="form-text text-muted">Stok takibi yapılıyorsa gereklidir...</span>
                    </div>
                  </div>
                  <div id="toplam_price"></div>
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
  
  $('.js-example-basic-single').select2({
      tags: true,
  });

  toplam_fiyat();

  $(':input[name=alis_satis_birim], :input[name=birim]').keyup(function(){
    alis_satis_birim_kontrol();
  });

  $('body').on("change",":input[name=alis_satis_birim],:input[name=toplam_fiyat], :input[name=birim_alis_fiyat],:input[name=miktar]",function(){
    toplam_fiyat();
  });

  function toplam_fiyat(){
    var tf = $(':input[name=toplam_fiyat]').val();
    var baf = $(':input[name=birim_alis_fiyat]').val();
    var asb = $(':input[name=alis_satis_birim]').val();
    var birim = $(':input[name=birim]').val();
    var miktar = $(':input[name=miktar]').val();
    if (tf > 0 && miktar > 0){
      $("i #p_price").html(tf);
    }else if(baf > 0 && asb == birim  && miktar > 0){
       var f = String(baf*miktar);
      $("i #p_price").html(f);
    }else{
      $("i #p_price").html("0,00");
    }
  }

  function alis_satis_birim_kontrol(){
    var birim = $(':input[name=birim]').val();
    if( $(':input[name=alis_satis_birim]').val() != birim){
      var html = `<div class="form-group row">
                    <label for="toplam_fiyat" class="col-4 col-form-label">Toplam Fiyat</label> 
                    <div class="col-8">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            <i class="fa fa-plus"></i>
                          </div>
                        </div> 
                        <input id="toplam_fiyat" name="toplam_fiyat" type="number" step="0.5" min="0" class="form-control" aria-describedby="kritik_stok_miktarHelpBlock" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <i class="fa fa-try"></i>
                          </div>
                        </div> 
                      </div> 
                      <span id="kritik_stok_miktarHelpBlock" class="form-text text-muted">Alış ile satış birimi farklı olan ürün toplam giderini belirtmek için kullanılır.</span>
                    </div>
                  </div> `;
      $("#toplam_price").html(html);
    }else{
      $("#toplam_price").html("");
    }
  }

  //urun change olursa cek
  $('body').on("change",":input[name=adi]",function(){
    var url = "<?php echo APP_URL.'ajax/satinalim/urun'; ?> ";
    var type = "post";
    var data = {
      stok_kodu : $(":input[name=adi]").val(),
    };

    getItemAjax(url,type,data,function(e){
      e = JSON.parse(e);
      if(e.status == 200){
          $(":input[name=birim]").val(e.urun.birim);
          $(":input[name=birim_alis_fiyat]").val(e.urun.birim_alis_fiyat);
          $(":input[name=birim_satis_fiyat]").val(e.urun.birim_satis_fiyat);
          $(":input[name=alis_satis_birim]").val(e.urun.alis_satis_birim);
          
          if(e.urun.stok_takip == 1){
            $(":input[name=stok_takip]").attr('checked', true);
          }else{
            $(":input[name=stok_takip]").attr('checked', false);
          }

          if (e.urun.kritik_stok_miktar != null) {
            $(":input[name=kritik_stok_miktar]").val(e.urun.kritik_stok_miktar);
          }
          
      }else{
          $(":input[name=birim]").val("");
          $(":input[name=birim_alis_fiyat]").val("");
          $(":input[name=birim_satis_fiyat]").val("");
          $(":input[name=alis_satis_birim]").val("");
          $(":input[name=stok_takip]").attr('checked', true);
          $(":input[name=kritik_stok_miktar]").val("");
      }
      alis_satis_birim_kontrol();
      toplam_fiyat();
    });

  });
            

</script>

<!-- Sayfa Alt Script !-->


<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>