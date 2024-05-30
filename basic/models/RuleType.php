<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rule_type".
 *
 * @property integer $id
 * @property string $title
 *
 * @property FileAccess[] $fileAccesses
 */
class RuleType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rule_type';
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
    public function getFileAccesses()
    {
        return $this->hasMany(FileAccess::className(), ['id_rule_type' => 'id']);
    }
}
