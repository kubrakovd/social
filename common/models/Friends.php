<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "friends".
 *
 * @property integer $user_id
 * @property string $accepted
 * @property string $income_requests
 * @property string $outcome_requests
 */
class Friends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['accepted', 'income_requests', 'outcome_requests'], 'string'],
            [['user_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'accepted' => Yii::t('app', 'Accepted'),
            'income_requests' => Yii::t('app', 'Income Requests'),
            'outcome_requests' => Yii::t('app', 'Outcome Requests'),
        ];
    }

    private static function getUserFriends(){
        $friends = self::find()->where(['user_id'=>Yii::$app->user->id])->one();
        return $friends;
    }
    public static function accepted(){
        $friends = self::getUserFriends();
        $accepted = User::getUserList(json_decode($friends->accepted));
        return $accepted;
    }
    public static function outcome(){
        $friends = self::getUserFriends();
        $outcome = User::getUserList(json_decode($friends->outcome_requests));
        return $outcome;
    }
    public static function income(){
        $friends = self::getUserFriends();
        $income = User::getUserList(json_decode($friends->income_requests));
        return $income;
    }
}
