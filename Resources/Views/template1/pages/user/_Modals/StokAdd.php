<div class="user-alerts">
  
</div>

<div class="form-group row">
    <label for="adi" class="col-4 col-form-label">Ürün/Hizmet Adı</label> 
    <div class="col-8">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <i class="fa fa-address-card"></i>
          </div>
        </div> 
        <input id="adi" name="adi" type="text" class="form-control" required="required">
      </div>
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
<hr >
  <div class="form-group row">
    <div class=" col-12">
      <button  type="button" class="btn btn-primary col-12" onclick="itemStore();">Kaydet</button>
    </div>
  </div>