<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;


/* @var $this yii\web\View */
/* @var $model common\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>
<?php


?>
<div class="blog-form">

    <?php $form = ActiveForm::begin([
        'action' => $model->isNewRecord ? ['create'] : ['update', 'id' => $model->id],
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->widget(\kartik\file\FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>
    <?= $form->field($model, 'preview')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>


    <?= $form->field($model, 'text')->widget(CKEditor::className(), [

        'editorOptions' => ElFinder::ckeditorOptions('elfinder', []),

    ]); ?>

    <?= $form->field($model, 'user_id')->textInput(['value' => Yii::$app->user->id, 'type' => 'hidden',])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
