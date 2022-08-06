<?php
    use yii\bootstrap4\ActiveForm;
    use yii\helpers\Html;

    /** @var $urlForm */
?>
<div class="content">
    <div class="centerSquare">
        <div class="leftSide">
            <?php $inputForm = ActiveForm::begin([
                    'id' => 'urlForm'
            ]) ?>
            <div class="fieldSet">
                <?= $inputForm->field($urlForm, 'url')->textInput(['name' => 'url', 'placeholder' => 'Введите URL для проверки']) ?>
                <?= $inputForm->field($urlForm, 'frequency')->input('number', ['name' => 'frequency', 'placeholder' => 'Введите частоту проверки']) ?>
                <?= $inputForm->field($urlForm, 'repeat_count')->input('number', ['name' => 'repeat_count', 'placeholder' => 'Введите количество повторов при ошибке']) ?>
                <?= Html::submitButton('Проверить', ['class' => 'btn btn-primary btn-block', 'id' => 'submitBtn']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
        <div class="rightSide">
            <div class="console">
                <div class="consoleTitle">
                    <span>Console</span>
                    <span>UrlChecker</span>
                </div>
                <div id="consoleBody" class="consoleBody"></div>
            </div>
        </div>
    </div>
</div>
<?php
    // Отключение стандартного тулбара от Yii2
    if(class_exists('yii\debug\Module'))
    {
        $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
    }
?>