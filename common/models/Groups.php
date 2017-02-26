<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $owner_id
 * @property string $date_created
 * @property string $candidates
 * @property string $members
 * @property integer $opened
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'groups';
    }

    public function beforeSave($insert){
        $this->owner_id = Yii::$app->user->id;
        $this->date_created = time();
        $this->candidates = '';
        $this->members = "['".Yii::$app->user->id."']";
        if($this->opened){
            $this->opened = '1';
        }else{
            $this->opened = "0";
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
   public function rules()
    {
        return [
            [['name', 'description', 'opened'], 'required'],
            [['description', 'candidates', 'members'], 'string'],
            [['opened', 'owner_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'owner_id' => Yii::t('app', 'Owner ID'),
            'date_created' => Yii::t('app', 'Date Created'),
            'candidates' => Yii::t('app', 'Candidates'),
            'members' => Yii::t('app', 'Members'),
            'opened' => Yii::t('app', 'Opened'),
        ];
    }

    public function getOwner(){
        return $this->hasOne(User::className(),['id'=>'owner_id']);
    }
}
