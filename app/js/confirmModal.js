/**
 * Created by nikhi on 17-11-2016.
 */
$(document).ready(function ()
{
   $('#myBtn').click(function (event)
   {
       event.preventDefault();
       var selector = $('#myModal');
       selector.find('.alert-danger').addClass('hide');
       selector.find('#product_name').val('');
       selector.find('#description').val('');
       selector.find('#quantity').val('');
       $('#myModal').modal('show');
   });
    $('#submitForm').click(function(event)
    {
        event.preventDefault();
        var name = $('#product_name').val();
        var description = $('#description').val();
        var quantity = $('#quantity').val();

        if(name != '')
        {
            $.ajax({
               url: "submitFile.php",
                type: "post",
                data: {name:name, description:description, quantity:quantity},
                success:function (data) {
                    //console.log(data);
                       // $(this).html("ADDED");
                       window.location.reload();
                        //location.href('home.php');
                }
            });
        }
        else
        {
           $('#myModal').find('.alert-danger').removeClass('hide').text("please enter the required fields!!!");
            //alert('enter all the required fields');
        }
    });
});