$(document).ready(function(){
    $(".btn").click(function(){
        let path = $(this).data("path");

        if($(this).hasClass("clicked") === false)
        {
            $(".btn").removeClass("clicked");
            $(this).addClass("clicked");
        }

        $.ajax({
            url: `/url/admin/${path}`,
            success: (res) => {
                $("#tableArea").html(res);
            },
            error: (data) => {
                console.log(data);
            }
        });
    });

    $("#goToClient").click(function(){
        location.href = "/url/url/index";
    });
});