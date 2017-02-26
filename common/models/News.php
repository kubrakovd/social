<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $type
 * @property string $header
 * @property string $text
 * @property string $date_created
 * @property integer $active
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'header', 'text', 'date_created', 'active'], 'required'],
            [['text'], 'string'],
            [['active'], 'integer'],
            [['type'], 'string', 'max' => 25],
            [['header'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', 'Type'),
            'header' => Yii::t('app', 'Header'),
            'text' => Yii::t('app', 'Text'),
            'date_created' => Yii::t('app', 'Date Created'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
