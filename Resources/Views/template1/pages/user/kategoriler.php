<?php 
    require __DIR__.'/../../layouts/html_head.php';
?>

<!-- sayfa head !-->

 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css"/>

  <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css" rel="stylesheet" />

   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />

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
  <div class="modal-dialog">
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
          action: function ( e, dt, node, config ) {}
        };

      //add  open modal property to added button
        $('body').on('init.dt', function() {
          $('.openModal_button_dt') 
                      .attr('data-toggle', 'modal')
                      .attr('data-target', '#userModal')
                      .attr('data-type1','itemAdd')
                      .attr('data-type2','user');  
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
            { "data": "user_name" },
            { "data": "user_email" },
            { "data": "role_name" },
            //{ "data": "actions",
              //render: function(data){
                //  return htmlDecode(data);
              //}
            //} 
          ]
  });
  

/*  $('#app_table').DataTable({  // ajax.php dosyasına POST isteği yolluyoruz.
        "processing": true,
        "serverSide": true,
        order:[],
        "ajax": {
          url:'',
          method:"POST",
          error: function(e){
               console.log(e);
           },
           success: function(e){
               console.log(e);
           },
          
        }
      });
    */

    //when click modal buttons 
      
    $('body').on('click','.openModal_button',function(){

      $('#userModal-body').html(""); //clear modal...

      var type1 = $(this).attr("data-type1"); //itemAdd,itemEdit
      var type2 = $(this).attr("data-type2"); //user,role

      if (type2 == 'userKey') {
          switch(type1) {

            case 'itemDelete':
                var url = "{{route('root.ajax.userKey.getUserKey', app()->getLocale())}}";
                var data = { 
                             _token: $('meta[name="csrf-token"]').attr('content'), 
                             id: $(this).attr('data-itemId')
                           }
                   getItemAjax(url,"post",data,function(e){
                      if(e.status == 200)
                      {//true
                        var Mbodyhtml = `
                          <div>`+e.msg+` Kaydı Silinsin mi? <br />
                          <button data-type1="itemDestroy" data-type2="userKey" data-itemId=`+e.itemId+` class="openModal_button btn btn-danger" role="button" aria-pressed="true">Sil</button>
                          </div>
                        `;
                        $('#userModal-body').html(Mbodyhtml);
                      }
                   });             
            break;

            case 'itemDestroy':
                var url = "{{route('root.ajax.userKey.destroy', app()->getLocale())}}";
                var data = { 
                             _token: $('meta[name="csrf-token"]').attr('content'), 
                             id: $(this).attr('data-itemId')
                           }
                   getItemAjax(url,"post",data,function(e){
                      if(e.status == 200)
                      {//true
                        var Mbodyhtml = `
                            <div class="alert alert-success">
                                <strong>Başarılı! </strong>`+e.message+`</div>`;
                        $('#userModal-body').html(Mbodyhtml);
                        $('#users_table').DataTable().ajax.reload();
                      }
                   });
            break;
          
          }
      }

      if (type2 == 'user') {
          switch(type1) {
            case 'itemAdd':
               $('#userModal-body').html(`@include("Admin.pages.Modals.userRegisterkeyAdd")`);
              break;
          }
      }


    });

   

    function destroyItem()
    {
      getItemAjax()
    }

    function addUserKey()
      {
        $('#userAdd-alerts').html();
             $.ajax({
                url: "{{route('root.ajax.userManagement.create', app()->getLocale())}}",
                type: "post",
                data:{
                  _token: $('meta[name="csrf-token"]').attr('content'),
                  email : $('#userKeyAdd_email').val(),
                  date :  $('#userKeyAdd_date').val(),
                  key:    '{{ session::get("userKey") }}'
                  } ,
                success: function (e) {
                    var html = `<div class="alert alert-success">
  <strong>Başarılı! </strong>`+e.message+`</div>`;
                    $('#userAdd-alerts').html(html);
                    $('#users_table').DataTable().ajax.reload();      

                },
                error: function(e) {
                   if(e.status === 422) {
                    console.log(e);
                    var errors = e.responseJSON;
                    var html = '';
                    $.each(e.responseJSON.errors, function (key, value) {
                    var error_html = `<div class="alert alert-danger">
  <strong>Hata! </strong>`+value+`</div>`;
                      html = html+error_html;
                    });
                    $('#userAdd-alerts').html(html);
                  } else {  console.log(e); }
                }


        });

      }

</script>

<!-- Sayfa Alt Script !-->


<!-- #end_sayfa Alt Script !-->

<?php require __DIR__.'/../../layouts/footer.php'; ?>