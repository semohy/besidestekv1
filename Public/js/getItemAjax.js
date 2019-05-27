 function getItemAjax(url,type,data,rslt)
    { 
             $.ajax({
             // async: true,
                url: url,
                type: type,
                data: data ,
                success: function (e) {
                    rslt(e);
                  },
                error: function(e) {
                   console.log(e);
                   rslt(e);
                }
        });
    }