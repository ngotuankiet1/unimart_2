$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });


    $(".suggestsearch").hide();
    $(".search_ajax").keyup(function(){
        var key = $(this).val();
        var data = {key: key};
        console.log(data);
        if(key != ''){
            $.ajax({
                type: "GET",
                url:"http://localhost:8080/unitop.vn/Laravel/unimark/admin/user/search",
                data: data,
                dataType: "json",
                success: function(data){
                    $(".suggestsearch").show(500);
                    $(".suggestsearch").html(data)
                }
            });
        }else{
            // $(".suggestsearch").html("");
            $(".suggestsearch").hide();
        }

    })

});
