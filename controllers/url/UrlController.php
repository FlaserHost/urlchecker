<?php

namespace app\controllers\url;

use app\models\url\UrlForm;
use yii\web\Controller;
use yii\httpclient\Client;

class UrlController extends Controller
{
    public function actionIndex()
    {
        $urlForm = new UrlForm();
        $this->layout = '/url/mainLayout';
        $this->view->title = 'Сервис проверки доступности URL-ов';
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Сервис проверки доступности url-ов'], 'description');
        return $this->render('/url/mainView', compact('urlForm'));
    }

    public function actionCheck()
    {
        $request = \Yii::$app->request;
        if($request->post("url") && $request->post("frequency") && $request->post("repeat_count"))
        {
            if($request->isAjax)
            {
                $url = $request->post("url");





                /*$client = new Client([
                    'transport' => 'yii\httpclient\CurlTransport'
                ]);

                $response = $client->createRequest()
                    ->setMethod('POST')
                    ->setUrl('http://domain.com/api/1.0/users')
                    ->setData(['name' => 'John Doe', 'email' => 'johndoe@domain.com'])
                    ->setOptions([
                        CURLOPT_CONNECTTIMEOUT => 10, // тайм-аут подключения
                        CURLOPT_TIMEOUT => 10, // тайм-аут получения данных
                    ])
                    ->send();*/

            }
        }
    }
}