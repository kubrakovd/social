<?php

namespace frontend\controllers;

use common\models\News;

class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$news = News::find()->all();
        return $this->render('index', ['news'=>$news]);
    }

    public function actionView($id)
    {
    	$news = News::findOne($id);
        return $this->render('view', ['news'=>$news]);
    }

}
