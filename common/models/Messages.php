<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property integer $from_user
 * @property integer $to_user
 * @property string $message
 * @property string $date_created
 * @property integer $viewed
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    public function beforeSave($insert){
        $this->from_user = (int)Yii::$app->user->id;
        $this->date_created = (string)time();
        $this->viewed = 0;
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['to_user', 'message'], 'required'],
            [['from_user', 'to_user', 'viewed'], 'integer'],
            [['message'], 'string'],
            [['date_created'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_user' => Yii::t('app', 'From User'),
            'to_user' => Yii::t('app', 'To User'),
            'message' => Yii::t('app', 'Message'),
            'date_created' => Yii::t('app', 'Date Created'),
            'viewed' => Yii::t('app', 'Viewed'),
        ];
    }

    public function getSender(){
        return $this->hasOne(User::className(), ['id'=>'from_user']);
    }

    public function getReceiver(){
        return $this->hasOne(User::className(), ['id'=>'to_user']);
    }
}
