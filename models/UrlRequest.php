<?php

namespace app\models;

use LevNevinitsin\Service\UrlService;

/**
 * This is the model class for table "urlRequest".
 *
 * @property int $id
 * @property string $sourceUrl
 * @property string $shortUrl
 * @property int $usesCount
 * @property string $dateCreated
 */
class UrlRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'urlRequest';
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            do {
                $this->shortUrl = UrlService::getRandomString();
            } while (UrlRequest::find()->where(['shortUrl' => $this->shortUrl])->exists());
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sourceUrl', 'shortUrl'], 'required'],
            [['usesCount'], 'integer'],
            [['dateCreated'], 'safe'],
            [['sourceUrl'], 'string', 'max' => 2083],
            [['shortUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sourceUrl' => 'Source URL',
            'shortUrl' => 'Short Url',
            'usesCount' => 'Uses Count',
            'dateCreated' => 'Date Created',
        ];
    }
}
