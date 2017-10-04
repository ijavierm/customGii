En frontend/config/main-local.php configurar la nueva clase del gii

	$config['modules']['gii'] = [
            'class'      => 'yii\gii\Module',
            'generators' => [
            'crud'   => [
                'class' => 'customGii\gii\crud\Generator',
                'indexWidgetType' => 'grid',
            ]
        ]
    ];