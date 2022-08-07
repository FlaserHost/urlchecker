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
                    let statusColor = '';
                    let access = '';

                    if(data.http_code == 200)
                    {
                        statusColor = 'good';
                        access = 'доступен';
                    }
                    else
                    {
                        statusColor = 'bad';
                        access = 'не доступен';
                    }

                    $("#consoleBody").append(`
                        <div class="checkResult">
                            <span>URL ${data.result_url} проверен</span>
                            <span>URL: <span class="${statusColor}">${access}</span></span>
                            <span>HTTP код: <span class="${statusColor}">${data.http_status}</span></span>
                        </div>
                    `);
                },
                error: (data) => {
                    clearInterval(inter);
                    console.log(`Неизвестный URL или иная ошибка\n${data.responseText}`);
                    $("#consoleBody").append(`
                        <div class="checkResult">
                            <span class="bad">Неизвестный URL или иная ошибка</span>
                            <pre>
                                ${data.responseText}
                            </pre>
                        </div>
                    `);
                }
            });
        }
    }

    $("#submitBtn").click(function(e){
        e.preventDefault();
        let formData = $("#urlForm").serializeArray();
        let idInterval;

        UrlChecker(formData);
        idInterval = setInterval(() => { UrlChecker(formData, idInterval) }, formData[2].value * 60000);
    });

    $("#goToAdmin").click(function(){
        location.href = "/url/admin/index";
    });
});