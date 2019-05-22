<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->

 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"/>

  <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css" rel="stylesheet" />

   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />

   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<!-- #end_sayfa head !-->

<?php require __DIR__.'/../../layouts/header.php'; ?>

<!-- Content !-->

  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">Anahtarlar</div>
              <div class="card-body">
                   
                   <table id="app_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                      <thead>
                        <tr>
                          <th>Kategori Kodu</th>
                          <th>Üst Kategori Kodu</th>  
                          <th>Kategori Adı</th>
                          <th></th>
                        </tr>
                      </thead>
                   </table>

              </div> 
              
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="userModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">İşlem</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div id="userModal-body" class="modal-body">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
      </div>

    </div>
  </div>
</div>


<!-- #end_Content !-->

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script src="https:////cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.tr.min.js"></script>

<script type="text/javascript" src="public/js/datatableHtmlRender.js"></script>
<script type="text/javascript" src="public/js/getItemAjax.js"></script>

<?php require __DIR__.'/../../layouts/footer_script.php'; ?>


</script>
<script type="text/javascript">

    //set button add record datatable
        $.fn.dataTable.ext.buttons.addnewrecord = {
          text: 'Yeni Kategori Ekle',
          className: 'btn btn-info openModal_button  openModal_button_dt',
          
          
        };

      //add  open modal property to added button
        $('body').on('init.dt', function() {
          $('.openModal_button_dt') 
                      .attr('data-toggle', 'modal')
                      .attr('data-target', '#userModal')
                      .attr('data-type1','itemAdd')
        });

        //datatable init
        $('#app_table').DataTable({
          "responsive": true,
          "processing": true,
          "serverSide": true,
          'dom': 'Blfrtip',
          'buttons': ['csv', 'excel', 'pdf','addnewrecord'],
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json"
        },
          "ajax": {
              url: '<?php echo APP_URL."ajax/kategoriler"; ?>',
              type : 'post',
              error: function(e){
               console.log(e);
           },
           

          },
          //'order':[],
          "columns": [
            { "data": "kategori_id" },
            { "data": "ust_kategori_id" },
            { "data": "kategori_adi" },
            { "data": "actions"} 
          ]
  });
  

         
    //when click modal buttons 
      
    $('body').on('click','.openModal_button',function(){

      $('#userModal-body').html(""); //clear modal...

      var type1 = $(this).attr("data-type1"); //itemAdd,itemEdit

          switch(type1) {

            case 'itemAdd':

              var url = '<?php echo APP_URL."ajax/kategoriler/all";?>';
              var type = 'post';
              var data = {};
              getItemAjax(url,type,data,function(e){
                
                var e = e.split('add_data');
                var e = $.parseJSON('{"data'+e[1]);
                

                $('#userModal-body').html(`<?php include __DIR__.'/_Modals/KategoriAdd.php'; ?>`);

                var html= "<option value='0'>Yok</option>";
                $.each( e.data, function( key, value ) {
                  console.log(value);
                  html += `<option value="`+value.ust_kategori_id+'.'+value.kategori_id+`">`+value.ust_kategori_id+'.'+value.kategori_id+value.kategori_adi+`</option>`;
                });

                $('#select_category').html(html);
                $('.js-example-basic-single').select2();
              });
                              
              break;

            case 'itemDelete':
                     
            break;

            case 'itemDestroy':
              
            break;
          
          }


 

    });

    function itemStore()
    {   
        var url = '<?php echo APP_URL."kategoriler/store";?>';  
        var data= {
            ust_cat  : $("select[name='ust_cat']").val(),
            cat_name : $("input[name='catname']").val(),
        }
        getItemAjax(url,"post",data,function(e){
          var  e= $.parseJSON(e);
          if(e.status == 200){
            $('#user-alerts').html(`<div class="alert alert-success"><strong>Başarılı! </strong>`+e.message+`</div>`);
          }else{
            $('#user-alerts').html(`<div class="alert alert-danger"><strong>Hata! </strong>`+e.message+`</div>`);
          }
        });
                   
    }

</script>

<!-- Sayfa Alt Script !-->


<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>