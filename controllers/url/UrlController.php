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

        if($request->post('formData'))
        {
            $url = htmlspecialchars($request->post('formData')[1]["value"]);
            if($request->isAjax)
            {
                $client = new Client([
                    'transport' => 'yii\httpclient\CurlTransport'
                ]);

                $response = $client->createRequest()
                    ->setUrl($url)
                    ->setOptions([
                        CURLOPT_CONNECTTIMEOUT => 10, // тайм-аут подключения
                        CURLOPT_HEADER => true,
                        CURLOPT_NOBODY => true,
                        CURLOPT_RETURNTRANSFER => true
                    ])
                    ->send();

                if($response)
                {
                    echo 'Сайт доступен';
                }
                else
                {
                    echo 'Сайт не доступен';
                }
            }
        }
    }
}