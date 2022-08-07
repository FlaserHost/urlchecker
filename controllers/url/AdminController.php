<?php

namespace app\controllers\url;

use app\models\url\Checktable;
use app\models\url\Urltable;
use yii\web\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $this->layout = '/url/adminLayout';
        $this->view->title = 'Административная страница';
        $this->view->registerMetaTag(["name" => "description", "content" => "Страница администратора"], "description");
        return $this->render("/url/adminView");
    }

    public function actionShowAddedUrl()
    {
        $request = \Yii::$app->request;
        if($request->isAjax)
        {
            $urlTable = Urltable::find()->all();
            return $this->renderAjax("/url/urlView", compact("urlTable"));
        }
    }

    public function actionShowCheckingUrl()
    {
        $request = \Yii::$app->request;
        if($request->isAjax)
        {
            $checkTable = Checktable::find()->all();
            return $this->renderAjax("/url/checkView", compact("checkTable"));
        }
    }
}