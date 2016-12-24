/**
 * Created by nikhi on 18-11-2016.
 */
$(document).ready(function () {
    $('.add_data').on('click',function(event){
     event.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#boughtModal').find('#name').text(name);
        $('#boughtModal').data('id', id);
        $('#boughtModal').find('.alert-danger').addClass('hide');
        $('#boughtModal').find('#store').val(-1);
        $('#boughtModal').find('#price').val('');
        var url="http://localhost/to_do_list/views/store.php?redirect=addItem&key="+id;
        $('.storelink').attr("href",url);
        $('#boughtModal').modal('show');

    });
    $('#submit').click(function () {
        var store_id = $('#store').val();
        var id = $('#boughtModal').data('id');
        var price = $('#price').val();
        //console.log(id);
        if(store_id != -1 && price !='')
        {
            $.ajax({
                url: 'bought.php',
                method: 'POST',
                data: {store_id: store_id, price:price, id:id},
                success: function (data) {
                    if(data == 'success')
                    {
                        //console.log(data);
                        window.location.reload();
                    }
                    else
                    {
                        alert("not added");
                    }
                }
            });
        }
        else
        {
            $('#boughtModal').find('.alert-danger').removeClass('hide').text("please fill the fields!!!");
        }
    });
    /*var followup = window.location.href;
    var openFollowup = followup.substring(followup.indexOf("?") + 1);
    console.log(openFollowup);
    var a = 'openFollowup';
    console.log(a.substr(a.indexOf('='))[1]);*/

    var data = [];
    var string = "modal_id = 69";
    var data  = string.split("=");
   /* if(data[0] == 'modal_id')
    {
        console.log(data[0]);
        console.log(data[1]);

    }*/
   if(data.indexOf('modal_id') > -1) {
       console.log(data[0]);
       console.log(data[1]);
   }
 });