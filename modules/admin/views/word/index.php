<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\models\SavolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Savollar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="word-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Yangi Savol qo`shish'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

            'emptyText' => 'Bu bo`limda hozircha ma`lumotlar mavjud emas',
            'summary' => 'Ko`rsatilyapti: <strong>{begin}-{end}</strong>, Jami: <strong>{totalCount}</strong>',
            'tableOptions' => [
                'class' => 'table table-bordered table-condensed table-hover',
            ],
            'rowOptions' => function($model){
                if($model->status == 'nofaol')
                    return [
                        'class' => 'danger'
                    ];
            },
            'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'work:ntext',
            'word',
            'bal',
            'view',
            // 'created_time',
            'status',
            // 'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {faollashtir}',
                'buttons' => [
                    'view' => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$url,['title'=>'Ko`rish']);
                    },
                    'update' => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',$url,['title'=>'Tahrirlash']);
                    },
                    'delete' => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>',$url,[
                                'title'=>'O`chirish',
                                'data' => [
                                    'confirm' => 'Siz rostdan ham ushbu ma`lumotni o`chirib tashlamoqchimisiz?',
                                    'method'=>'post'
                                ]
                                ]);
                    },
                    'faollashtir' => function($url,$model,$key){
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>',$url,['title'=>'Faollashtirish']);
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
