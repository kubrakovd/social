<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use common\models\Friends;

class FriendsController extends Controller{
	private function Friendship($my_id, $friends_id, $action){
		$user_friendship = Friends::find()->where(['user_id'=>$my_id])->one();
		$my_friend = Friends::find()->where(['user_id'=>$friends_id])->one();

		$accept = json_decode($user_friendship->accepted, true);
		$income = json_decode($user_friendship->income_requests, true);
			// $outcome = json_decode($user_friendship->outcome_requests, true);

		$friends_accept = json_decode($my_friend->accepted, true);
			// $friends_income = json_decode($my_friend->income_requests, true);
		$friends_outcome = json_decode($my_friend->outcome_requests, true);

			// Remove from incoming friends
		$key = array_search($friends_id, $income);
		unset($income[$key]);

			// Put to real friends
		$accept[] = (string)$friends_id;
		$friends_accept[]= (string)$my_id;

			// Remove from outcoming of incomer
		$key = array_search($my_id, $friends_outcome);
		unset($friends_outcome[$key]);

			// print_r($accept)
		if($action =='accept') $user_friendship->accepted = json_encode($accept);
		$user_friendship->income_requests = json_encode(array_values($income));
			// if($action =='outcome')$user_friendship->outcome_requests = json_encode(array_values($outcome));

		if($action =='accept') $my_friend->accepted = json_encode($friends_accept);
			// $my_friend->income_requests = json_encode(array_values($friends_income));
		$my_friend->outcome_requests = json_encode(array_values($friends_outcome));

		$user_friendship->save();
		$my_friend->save();
	}
	public function actionDecision($id, $action, $reverse=false){
		if($reverse){
			$this->friendship($id, Yii::$app->user->id, $action);

		}else{
			$this->friendship(Yii::$app->user->id, $id, $action);
		}
		return $this->redirect(Yii::$app->request->referrer);
	}

	public function actionRemove($id){
		$me = Friends::find()->where(['user_id'=>Yii::$app->user->id])->one();
		$friend = Friends::find()->where(['user_id'=>$id])->one();

		$me->accepted = $this->jsonInOut($me->accepted,$id);
		$friend->accepted = $this->jsonInOut($friend->accepted,Yii::$app->user->id);

		$me->save();
		$friend->save();

		return $this->redirect(Yii::$app->request->referrer);
	}

	private function jsonInOut($json_arrray, $id){
		$array = json_decode($json_arrray);
		$key = array_search($id, $array);
		unset($array[$key]);

		return $array = json_encode(array_values($array));
	}
}

?>
