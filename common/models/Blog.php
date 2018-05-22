<?php

namespace common\models;

use mohorev\file\UploadBehavior;
use mohorev\file\UploadImageBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $preview
 * @property string $text
 * @property string $image
 * @property int $user_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug'], 'required'],
            [['preview', 'text'], 'string'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 150],
            ['image', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['insert', 'update']],

            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'title',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ],
            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'image',
                'scenarios' => ['insert', 'update'],
                'placeholder' => '@frontend/web/upload/No-image-available.jpg',
                'path' => '@frontend/web/upload/blog/{id}',
                'url' => '/upload/blog/{id}',
                'thumbs' => [
                    'thumb' => ['width' => 500, 'quality' => 90],
                    'preview' => ['width' => 350, 'height' => 350],
                    'sm' => ['width' => 100, 'height' => 100, 'bg_color' => '000'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'preview' => 'Preview',
            'text' => 'Text',
//            'image' => 'Image',
//            'user_id' => 'User ID',
//            'created_at' => 'Create At',
//            'updated_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
