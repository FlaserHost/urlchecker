<?php

namespace app\controllers\url;

use app\models\url\UrlForm;
use yii\web\Controller;

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
}