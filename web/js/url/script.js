$(document).ready(function(){
    function UrlChecker(dataSet, inter)
    {
        for(i = 0; i < dataSet[3].value; i++)
        {
            $.ajax({
                url: '/url/url/check',
                type: 'POST',
                dataType: 'JSON',
                data: ({formData: dataSet}),
                success: (data) => {
                    console.log(`${data.result_url}\nHTTP код: ${data.http_status}`);
                },
                error: (data) => {
                    clearInterval(inter);
                    console.log("Неизвестный URL");
                    console.log(data.responseText);
                }
            });
        }
    }

    $("#submitBtn").click(function(e){
        e.preventDefault();
        let formData = $("#urlForm").serializeArray();
        let idInterval;

        UrlChecker(formData);
        idInterval = setInterval(() => { UrlChecker(formData, idInterval) }, formData[2].value * 1000);
    });
});