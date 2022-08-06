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
        if($request->isAjax)
        {
            if($request->post('formData'))
            {
                $url = htmlspecialchars($request->post('formData')[1]["value"]);
                if(!filter_var($url, FILTER_VALIDATE_URL))
                {
                    return false;
                }
                else
                {
                    $client = new Client();
                    $response = $client->createRequest()
                        ->setUrl($url)
                        ->setOptions([
                            CURLOPT_CONNECTTIMEOUT => 10,
                            CURLOPT_HEADER => true,
                            CURLOPT_NOBODY => true,
                            CURLOPT_RETURNTRANSFER => true
                        ])
                        ->send();

                    if($response)
                    {
                        //$httpStatus = \Yii::$app->response->statusCode;
                        $httpStatus = $response->getStatusCode();
                        $respond = array(
                            'result_url' => "Сайт {$url} доступен",
                            'http_status' => $httpStatus
                        );
                        echo json_encode($respond);
                    }
                }
            }
        }
    }
}