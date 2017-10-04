<?php
use yii\helpers\StringHelper;

$class = $generator->modelClass;
$pk = $class::primaryKey();
$nameAttribute = $generator->getNameAttribute();
if($nameAttribute == null)
	$nameAttribute = $pk[0];

echo "<?php\n";
?>
use yii\helpers\Html;
use yii\helpers\Url;
<?php
echo "?>\n";
?>

<div class="row">
	<div class="col-md-10">
    	<div class="row">
			<div class="col-md-4">
				<strong>
					<?= "<?="?> Html::button(Yii::t('app', '<?= StringHelper::basename($generator->modelClass);?>') .': ' .$data-><?=$nameAttribute?>, [
						'class' => 'btn btn-link', 
						'data-toggle' => 'modal', 
						'data-target' => '#modal', 
						'data-url' => Url::to(['view', 'id' => $data-><?= $pk[0]; ?>])
					]);<?="?>\n"?>
				</strong>
			</div>
		</div>
		<div class="row">
<?php
$count = 0;
$tableSchema = $generator->getTableSchema();

$columnsAmount = count($tableSchema->columns);
if($columnsAmount > 12)
	$columnsAmount = 12;
$bootstrapClass = 'col-md-' .(floor(12 / $columnsAmount));

foreach ($tableSchema->columns as $column)
{
    if(strcasecmp($column->name, 'IsActive') != 0)
    {
        $format = $generator->generateColumnFormat($column);
        ?>
<?= "\n"; ?>
        <?php if (++$count < 6):?>
	<?= "<div class=\"$bootstrapClass\"><strong><?= Yii::t('app', '$column->name');?>: </strong><?=\$data->$column->name ?></div>\n"; ?>
        <?php else:?>
	<?= "<?php /*\n <div class=\"$bootstrapClass\"><strong><?= Yii::t('app', '$column->name');?>: </strong><?=\$data->$column->name ?></div> \n*/?>\n"; ?>
        <?php endif;?>
        <?php
    }
}
?>
<?= "\n"; ?>
		</div>
	</div>
</div>
