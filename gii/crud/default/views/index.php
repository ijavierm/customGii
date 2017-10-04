<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
echo "<?php\n";
// if($generator->withModal == 0)
//     $generator->indexWidgetType = 'grid';
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1><?= "<?= " ?>Html::encode($this->title) ?></h1>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <?php if ($generator->withModal): ?>
            <?= "<?= " ?> Html::button(Yii::t('app', 'Create {modelClass}', ['modelClass' => Yii::t('app', '<?=StringHelper::basename($generator->modelClass)?>'),]), [
                'class' => 'btn btn-primary btn-nuevo-reclamo pull-right btn-nuevo-create',
                'data-toggle' => 'modal',
                'data-target' => '#modal',
                'data-url' => Url::to('create')
            ]);<?= "?>\n " ?>
            <?php else:?>
            
            <?= "<?=" ?> Html::a(Yii::t('app', 'Add Trials', ['modelClass' => Yii::t('app', '<?=StringHelper::basename($generator->modelClass)?>'),]), ['create'], ['class' => 'btn btn-primary btn-nuevo-reclamo pull-right btn-nuevo-create']) ?>
            
            <?php endif;?>
        </div>
    </div>

<?php if(!empty($generator->searchModelClass)): ?>
<?php //echo "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>
<?= "<?php " ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>
    <?php /*
    <?= "<?= " ?>Html::a(<?= $generator->generateString('Create {modelClass}', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?>, ['create'], ['class' => 'btn btn-primary btn-nuevo-reclamo']) ?>
    */?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?php " ?> Pjax::begin(['id' => 'itemList']);<?= "?> " ?>
    <?= "<?= " ?>GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-condensed table-reclamos table-con-link'],
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
            // ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'frontend\widgets\RowLinkColumn'],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        if(strcasecmp($column->name, 'IsActive') != 0)
        {
            $format = $generator->generateColumnFormat($column);
            if (++$count < 6) {
                echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            } else {
                echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
            }
        }
    }
}
?>

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?= "<?php " ?> Pjax::end();<?= "?> " ?>
<?php else: ?>
    <?= "<?php " ?> Pjax::begin(['id' => 'itemList']);<?= "?> " ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'options'=>[
            'tag' => 'ul',
            'class' => 'list-group',   
        ],
        'itemOptions' => ['tag' => 'li', 'class' => 'list-group-item',],
        'itemView'  =>  function ($data) 
         {                                      
           return $this->render('_item', ['data' => $data]) ;  
         },   
    ]) ?>
    <?= "<?php " ?> Pjax::end();<?= "?> " ?>
<?php endif; ?>

            </div>
        </div>
    </div>
</div>
