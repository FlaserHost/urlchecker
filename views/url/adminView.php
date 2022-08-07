<div class="content">
    <div class="leftPanel">
        <div class="btnBlock">
            <div class="panelTitle">
                <span>Меню</span>
            </div>
            <div class="btn" data-path="show-added-url">Добавленные URL</div>
            <div class="btn" data-path="show-checking-url">Проверки URL</div>
        </div>
        <button class="goToClient" id="goToClient">Перейти на клиентскую часть</button>
    </div>
    <div class="contentBody">
        <div class="tableArea" id="tableArea"></div>
    </div>
</div>
<?php
// Отключение стандартного тулбара от Yii2
if(class_exists('yii\debug\Module'))
{
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>