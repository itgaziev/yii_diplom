<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partition".
 *
 * @property integer $id
 * @property string $title
 *
 * @property Folder[] $folders
 */
class Partition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partition';
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
    public function getFolders()
    {
        return $this->hasMany(Folder::className(), ['id_partition' => 'id']);
    }
}
