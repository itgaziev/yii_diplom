<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_kind".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Document[] $documents
 */
class DocumentKind extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_kind';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [                      
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['id_document_kind' => 'id']);
    }
}
