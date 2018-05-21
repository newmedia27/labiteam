<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchBlog */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';

?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php \yii\bootstrap\Modal::begin([
        'id' => 'page-create',
        'header' => '<span class="h3">Новая страница</span>',
        'size' => Modal::SIZE_LARGE,
    ]) ?>
    <?= $this->render('_form', [
        'model' => new \common\models\Blog(),
        'action' => ['/create'],
    ]); ?>
    <?php Modal::end() ?>



    <?= GridView::widget([
        'id' => 'page-grid',
        'dataProvider' => $dataProvider,


        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-book"></i> ' . $this->title,
        ],

        'responsive' => true,
        'striped' => true,
        'hover' => true,
        'pjax' => true,
        'persistResize' => false,
        'pjaxSettings' => [
            'neverTimeout' => true,
        ],

        'floatHeader' => true,
        'floatHeaderOptions' => [
            'position' => 'auto',
        ],

        'toolbar' => [
            ['content' =>
                '<div class="btn-group">' . Html::button('Выводить по ' . Yii::$app->request->get('per-page', 20) . ' <span class="caret"></span>', [
                    'class' => 'btn btn-default dropdown-toggle',
                    'data-toggle' => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false'
                ]) .
                Html::ul([
                    Html::a('20', \yii\helpers\BaseUrl::current(['per-page' => 20])),
                    Html::a('50', \yii\helpers\BaseUrl::current(['per-page' => 50])),
                    Html::a('100', \yii\helpers\BaseUrl::current(['per-page' => 100])),
                    Html::a('500', \yii\helpers\BaseUrl::current(['per-page' => 500])),
                ], [
                    'class' => 'dropdown-menu',
                    'encode' => false,
                ])
                . '</div>&nbsp;' .
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => 'create', 'class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#page-create'])
//                Html::button('<i class="glyphicon glyphicon-filter"></i>', ['type' => 'button', 'title' => 'Фильтр', 'class' => 'btn btn-info', 'data-toggle' => 'modal', 'data-target' => '#page-filter']) . ' ' .
//                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Сбросить фильтр'])
            ],
            '{toggleData}',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'title',
                'value' => function ($data) {
                    return Html::a($data->title, \yii\helpers\Url::to(['/blog/view/' . $data->id]));
                },
                'format' => 'raw'
            ],
            'slug',

            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('H:i:s d-m-y', $data->created_at);
                },
                'format' => 'raw'
            ],

            [
                'attribute' => 'updated_at',
                'value' => function ($data) {
                    return date('H:i:s d-m-y', $data->updated_at);
                },
                'format' => 'raw'
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',],
        ],
    ]); ?>


    <!--    --><?php //echo GridView::widget([
    //        'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,
    //        'columns' => [
    //            ['class' => 'yii\grid\SerialColumn'],
    //
    //            'id',
    //            'title',
    //            'slug',
    //            'preview:ntext',
    //            'text:ntext',
    //            //'image',
    //            //'user_id',
    //            //'create_at',
    //            //'update_at',
    //
    //            ['class' => 'yii\grid\ActionColumn'],
    //        ],
    //    ]); ?>
</div>
