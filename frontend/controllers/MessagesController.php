<?php

namespace frontend\controllers;

use Yii;
use common\models\Messages;
use common\models\User;
use yii\helpers\ArrayHelper;
use frontend\models\MessageForm;


class MessagesController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$senders = Messages::find()->where(['to_user'=>Yii::$app->user->id])->asArray()->all();
    	$smap = ArrayHelper::map($senders, 'id', 'from_user');

    	$receivers = Messages::find()->where(['from_user'=>Yii::$app->user->id])->asArray()->all();
    	$rmap = ArrayHelper::map($receivers, 'id', 'to_user');

    	$summary = array_unique(array_merge($smap, $rmap));

    	foreach ($summary as $item) {
    		$groups[$item] = User::findOne($item);
    	}

        return $this->render('index', ['groups'=>$groups]);
    }

    public function actionView($id)
    {
    	$model = new MessageForm();
    	if(isset($_POST['MessageForm']['message'])){
    		$message = new Messages();
    		$message->message = $_POST['MessageForm']['message'];
    		$message->to_user = (int)$id;
    		$message->save();
    	}


    	$message_list = Messages::find()->where(['from_user'=>Yii::$app->user->id, 'to_user'=>$id])->orWhere(['to_user'=>Yii::$app->user->id, 'from_user'=>$id])->orderBy('date_created ASC')->all();
        return $this->render('view',['message_list'=>$message_list, 'model'=>$model ]);

    }

}
