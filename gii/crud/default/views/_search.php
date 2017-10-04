<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
$nameAttribute = $generator->getNameAttribute();
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row" id="searchForm">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div role="tabpanel" class="tabpanel" id="searchPanel">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="search">
                    <?= "<?php " ?>$form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
                        'options' => ['class'=>'form-search form-search-planificacion'],
                    ]); ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-11">
                                    <?= "<?= " ?> $form->field($model, '<?= $nameAttribute;?>')->textInput(['type'=>'search','class'=>'form-control' ,'placeholder'=>Yii::t('app', 'Search by <?= $nameAttribute;?>...')])->label(false); ?> 
                                </div>

                                <div class="col-md-1">
                                    <span class="input-group-btn hidden-xs hidden-sm">
                                        <?= "<?= " ?> Html::submitButton("<img src='".Yii::$app->urlManager->baseUrl."/images/ico-search.png' alt='' / >".Yii::t('app', 'Search'), ['class' => 'btn btn-default find']) ?>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <a class="collapse-reclamo moreFilters" data-toggle="collapse" href="#<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-collapse" aria-expanded="false" aria-controls="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-collapse"><?= "<?="?>Yii::t('app', 'More Filters');?></a>
                                </div>

                                    <div class="col-md-12 collapse" id="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-collapse">
                                        <div class="row">
                                            <?php
                                                $count = 0;
                                                foreach ($generator->getColumnNames() as $attribute) {
                                                    if ($attribute != $nameAttribute) 
                                                    {
                                                        if (++$count < 6) {
                                                            ?>
                                                    <?="\n"?>
                                            <div class="col-md-3">
                                            <?= "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n";?>
                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                    <?="\n"?>
                                            <!-- <div class="col-md-3">-->
                                            <?= "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n";?>
                                            <!-- </div> -->
                                                    <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                            <?="\n"?>
                                        </div>
                                    </div>
                                <div class="col-xs-2 pull-right find">
                                    <span class="hidden-md hidden-lg">
                                        <?= "<?= " ?> Html::submitButton("<img src='".Yii::$app->urlManager->baseUrl."/images/ico-search.png' alt='' / >".Yii::t('app', 'Search'), ['class' => 'btn btn-default find']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>       
                    <?= "<?php " ?>ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
