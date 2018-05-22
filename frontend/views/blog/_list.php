<div class="site-index">
    <div class="container">
        <div class="row">
            <div class="col-md8 col-md-offset-1" style="margin-top: 10px;">
                <span><?=date('H:i:s d-m-y',$model->created_at)  ?></span>
                <h2><?= $model->title ?></h2>
                <div class="col-md-4">
                    <?= \yii\helpers\Html::img($model->getThumbUploadUrl('image'), ['class' => 'img-thumbnail']) ?>
                </div>
                <div class="col-md-8" style="padding-top: 10px;">
                    <?= $model->preview ?>
                    <span><a href="<?= \yii\helpers\Url::to(['blog/view','id'=>$model->slug]) ?>">MORE...</a></span>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
