<?php

namespace app\controllers\url;

use app\models\url\Checktable;
use app\models\url\UrlForm;
use app\models\url\Urltable;
use yii\web\Controller;
use yii\httpclient\Client;

class UrlController extends Controller
{
    public function actionIndex()
    {
        $session = \Yii::$app->session;
        session_gc();
        if(!$session->has("userId"))
        {
            $session->set("userId", \Yii::$app->security->generateRandomString());
        }

        $urlForm = new UrlForm();
        $this->layout = '/url/mainLayout';
        $this->view->title = 'Сервис проверки доступности URL-ов';
        $this->view->registerMetaTag(['name' => 'description', 'content' => 'Сервис проверки доступности url-ов'], 'description');
        return $this->render('/url/mainView', compact('urlForm'));
    }

    public function actionCheck()
    {
        $request = \Yii::$app->request;
        $session = \Yii::$app->session;
        if($request->isAjax)
        {
            if($request->post('formData'))
            {
                $url = htmlspecialchars($request->post('formData')[1]["value"]);
                $frequency = htmlspecialchars($request->post('formData')[2]["value"]);
                $repeatCount = htmlspecialchars($request->post('formData')[3]["value"]);
                $session->set("attempt", $session->get("attempt") + 1);

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
                        $userId = $session->get("userId");
                        $flag = 0;

                        $errors = array(
                            200 => 'Access Granted',
                            404 => 'Page Not Found',
                            502 => 'Bad Gateway'
                        );

                        $respond = array(
                            'result_url' => "URL {$url} проверен",
                            'http_status' => $httpStatus . ' ' . $errors[$httpStatus],
                        );

                        $urlTableCheck = UrlTable::find()->where([
                            'user_id' => $userId,
                            'url' => $url
                        ])->all();

                        foreach($urlTableCheck as $result)
                        {
                            if($result)
                            {
                                $flag++;
                            }
                        }

                        if($flag === 0)
                        {
                            $urlTable = new Urltable();
                            $urlTable->user_id = $userId;
                            $urlTable->creation_date = date("Y.m.d");
                            $urlTable->url = $url;
                            $urlTable->frequency = $frequency;
                            $urlTable->repeat_count = $repeatCount;
                            $urlTable->save();
                        }

                        $checkTable = new Checktable();
                        $checkTable->check_date = date("Y.m.d");
                        $checkTable->url = $url;
                        $checkTable->url_id = 6;
                        $checkTable->http = $httpStatus;
                        $checkTable->attempt = $session->get("attempt");
                        $checkTable->save();

                        echo json_encode($respond);
                    }
                }
            }
        }
    }
}