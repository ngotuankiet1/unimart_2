$(document).ready(function () {

    $(".show_hide").on("click", function () {
        $(".product-detail").removeClass("detail-hide");
        $(this).parent().hide();
    });

});
