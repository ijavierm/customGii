<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveForm::begin(['id' => 'itemForm', 'enableAjaxValidation' => true, 'enableClientScript' => true]); ?>

    <div class="container-planificacion">
        <div class="row">
<?php foreach ($generator->getColumnNames() as $attribute) 
{
    if (in_array($attribute, $safeAttributes)) 
    {
        if(strcasecmp($attribute, 'IsActive') != 0)
        {
            echo "\n";
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php
            echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n";
            ?>
            </div>
            <?php
        }
    }
} 
echo "\n";
?>
            <div class="form-group">
                <?= "<?= " ?>Html::submitButton($model->isNewRecord ? <?= $generator->generateString('Create') ?> : <?= $generator->generateString('Update') ?>, ['class' => 'btn btn-primary ']) ?>
                <?php /*
                <?= "<?= " ?>Html::a(<?= $generator->generateString('Cancel', ['modelClass' => Inflector::camel2words(StringHelper::basename($generator->modelClass))]) ?>, ['index'], ['class' => 'btn btn-gray ']) ?>
                */?>
<button type="button" class="btn btn-gray " data-dismiss="modal"> <?= "<?= " ?> Yii::t('app', 'Cancel');  <?= "?> " ?></button>
            </div>
        </div>
    </div>

    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
