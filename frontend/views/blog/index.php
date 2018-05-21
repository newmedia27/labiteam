<?php

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */

$this->title = "My blog";
?>



<?php

$dataProvider = new ActiveDataProvider([
    'query' => $blog,
    'pagination' => [
        'pageSize' => 5,
    ],
]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list',
    'summary' => false
]);

?>