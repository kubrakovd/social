<?php

namespace frontend\controllers;

use Yii;
use frontend\models\SearchForm;
use common\models\Profile;
use common\models\Friends;
use common\models\User;
use yii\helpers\ArrayHelper;


class UserController extends \yii\web\Controller
{
	public function actionFriends()
	{
			return $this->render('friends', [
				'accepted'=> Friends::accepted(),
				'income'=>Friends::income(),
				'outcome'=>Friends::outcome()
				]);
	}


   public function actionSearch()
    {
        $search = [];
        if(!empty($_POST['SearchForm']['search'])){
            $query = $_POST['SearchForm']['search'];
            $search = Profile::find()
                ->where('`firstname` LIKE "%'.$query.'%" OR `lastname` LIKE "%'.$query.'%"')
                ->all();


        }

        $model = new SearchForm();

        $data = Profile::find()->all();
//        $data_array = ArrayHelper::map($data,'user_id','firstname');

        foreach ($data as $d){
            $data_array[] = $d->firstname." ".$d->lastname;
        }

        return $this->render('search',[
            'model'=>$model,
            'search'=>$search,
            'data'=>$data_array
        ]);
    }

    public function actionAddfriend($id){
    	$user = Yii::$app->user->identity->friends;
    	$friend = Friends::findOne($id);
    	if(!$user){
    		// ADD NEW RECORD TO DATABASE
    		$friends = new Friends();
    		$friends->user_id = Yii::$app->user->id;
    		$friends->income_requests = NULL;
    		$friends->outcome_requests = json_encode(array((string)$id)) ;
    		$friends->accepted = NULL;
    		if(!$friends->save()){
    			print_r($friends->errors);
    		};

    	}else{
			// UPDATE RECORD AT DATABASE
    		$me= Friends::findOne(Yii::$app->user->id);
			$array_of_friends = json_decode($me->outcome_requests);
			$array_of_friends[] = (string)$id;
			$me->outcome_requests =json_encode( $array_of_friends);
			if(!$me->save(false)){
				print_r($me->errors);
			};
    	}

    	if(!$friend){
    		// ADD NEW RECORD TO DATABASE
    		$friends = new Friends();
    		$friends->user_id = $id;
    		$friends->income_requests = json_encode(array((string)Yii::$app->user->id));
			print_r($friends);
			if(!$friends->save()){
    			print_r($friends->errors);
			};
    	}else{
    		// UPDATE RECORD AT DATABASE
    		$him= Friends::findOne($id);
			$array_of_friends = json_decode($him->income_requests);
			$array_of_friends[] = (string)Yii::$app->user->id;
			$him ->income_requests =json_encode($array_of_friends);
			if(!$him->save()){
				print_r($him->errors);
			};
		}
		$this->redirect(Yii::$app->request->referrer);
    }

}
