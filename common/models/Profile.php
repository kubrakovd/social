<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property string $birthdate
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $gender
 * @property string $phone
 * @property string $address
 * @property string $hobby
 * @property integer $education_type
 * @property string $education_info
 * @property integer $marriage_status
 * @property integer $has_children
 * @property string $skype
 * @property string $website
 * @property string $workplace
 * @property integer $religion
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }
    public function beforeSave($insert){
        $this->birthdate = strtotime($this->birthdate);
        return parent::beforeSave($insert);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'firstname', 'lastname', 'middlename', 'birthdate', 'country_id', 'region_id', 'city_id', 'education_type', 'marriage_status', 'has_children', 'religion'], 'required'],
            [['user_id', 'country_id', 'region_id', 'city_id', 'gender', 'education_type', 'marriage_status', 'has_children', 'religion'], 'integer'],
            [['address', 'hobby', 'education_info', 'workplace'], 'string'],
            [['firstname', 'lastname', 'middlename', 'skype'], 'string', 'max' => 50],
            [['birthdate'], 'string', 'max' => 12],
            [['phone'], 'string', 'max' => 25],
            [['website'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'middlename' => Yii::t('app', 'Middlename'),
            'birthdate' => Yii::t('app', 'Birthdate'),
            'country_id' => Yii::t('app', 'Country ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'gender' => Yii::t('app', 'Gender'),
            'phone' => Yii::t('app', 'Phone'),
            'address' => Yii::t('app', 'Address'),
            'hobby' => Yii::t('app', 'Hobby'),
            'education_type' => Yii::t('app', 'Education Type'),
            'education_info' => Yii::t('app', 'Education Info'),
            'marriage_status' => Yii::t('app', 'Marriage Status'),
            'has_children' => Yii::t('app', 'Has Children'),
            'skype' => Yii::t('app', 'Skype'),
            'website' => Yii::t('app', 'Website'),
            'workplace' => Yii::t('app', 'Workplace'),
            'religion' => Yii::t('app', 'Religion'),
        ];
    }
}
