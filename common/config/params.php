<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	'gender' => [
		'0'=>Yii::t('app','Male'),
		'1'=>Yii::t('app','Female'),
		'2'=>Yii::t('app','Thailand')
	],
	'education_type'=>[
		'0'=>Yii::t('app','No education'),
		'1'=>Yii::t('app','School'),
		'2'=>Yii::t('app','Colledge'),
		'3'=>Yii::t('app','Higher'),
		'4'=>Yii::t('app','God of knowledge')
	],
	'marriage_status'=>[
		'0'=>Yii::t('app','Single'),
		'1'=>Yii::t('app','Married'),
		'2'=>Yii::t('app','In relationships'),
		'3'=>Yii::t('app','In have hamster!')
	],
	'religion'=>[
		'0'=>Yii::t('app','Christian'),
		'1'=>Yii::t('app','Buddism'),
		'2'=>Yii::t('app','Muslim'),
		'3'=>Yii::t('app','Ateism'),
		'4'=>Yii::t('app','Other')
	],
	'news_type'=>[
		'service' => Yii::t('app','Service news'),
		'general' => Yii::t('app','General news'),
		'info' => Yii::t('app','Information')

	]
];



