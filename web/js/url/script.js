$(document).ready(function(){
    $("#submitBtn").click(function(e){
        e.preventDefault();
        let formData = $("#urlForm").serializeArray();
console.log(formData);
        $.ajax({
            url: '/url/url/check',
            type: 'POST',
            data: ({formData: formData}),
            success: (res) => {
                alert(res);
            },
            error: (res) => {
                alert(res);
            }
        });
    });
});