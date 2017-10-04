<?php
$class = $generator->modelClass;
$pk = $class::primaryKey();
?>
<?= "<?php "?>
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?= "<?php "?> if(isset($ok)): ?>
	<div class="alert alert-success"><?= Yii::t('app', 'The item was deleted succesfully.');?></div>
<?= "<?php "?> else: ?>
	<div class="alert alert-warning"><?= Yii::t('app', 'Are you sure you want to delete this item?');?></div>
	<?= "<?php "?> $form = ActiveForm::begin(['id' => 'itemForm']); ?>
		<div style="display:none;">
			<?= "<?php "?> $form->field($model, '<?= $pk[0]?>')->hiddenInput() ?>
		</div>
		<div class="container-planificacion">
		    <div class="row">
		        <div class="form-group">
		            <?= "<?= "?> Html::submitButton(Yii::t('app', 'Yes'), ['class' => 'btn btn-primary ']) ?>
					<button type="button" class="btn btn-gray " data-dismiss="modal"> <?= "<?= "?> Yii::t('app', 'Cancel');  ?> </button>
		        </div>
		    </div>
		</div>
	<?= "<?php "?> ActiveForm::end(); ?>
<?= "<?php "?> endif; ?>