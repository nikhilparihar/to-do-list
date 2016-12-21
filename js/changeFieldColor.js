/**
 * Created by nikhi on 16-11-2016.
 */
$(':text').focusin(function ()
{
    $(this).css('backgroundColor', 'gray');
});

$(':text').blur(function ()
{
    $(this).css('backgroundColor', '#fff');
});