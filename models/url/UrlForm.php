<?php

namespace app\models\url;

use yii\base\Model;

class UrlForm extends Model
{
    public $url;
    public $frequency;
    public $repeat_count;

    public function rules()
    {
        return [
            [['url', 'frequency', 'repeat_count'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'url' => 'URL',
            'frequency' => 'Частота',
            'repeat_count' => 'Повторы'
        ];
    }
}