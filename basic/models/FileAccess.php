<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "file_access".
 *
 * @property integer $id
 * @property integer $id_file
 * @property integer $id_rule_type
 * @property integer $id_user
 * @property integer $id_department
 * @property integer $id_user_type
 * @property boolean $flag_view
 * @property boolean $flag_edit
 * @property boolean $flag_delete
 *
 * @property Department $idDepartment
 * @property File $idFile
 * @property RuleType $idRuleType
 * @property User $idUser
 * @property UserType $idUserType
 */
class FileAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_access';
    }

	public function getTitle ()
	{
		return 'Правило #' . $this->id;		
	}
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_file', 'id_rule_type', 'id_user', 'id_department', 'id_user_type'], 'integer'],
            [['flag_view', 'flag_edit', 'flag_delete'], 'boolean'],
            [['id_department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['id_department' => 'id']],
            [['id_file'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['id_file' => 'id']],
            [['id_rule_type'], 'exist', 'skipOnError' => true, 'targetClass' => RuleType::className(), 'targetAttribute' => ['id_rule_type' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_user_type'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['id_user_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_file' => Yii::t('app', 'Id File'),
            'id_rule_type' => Yii::t('app', 'Id Rule Type'),
            'id_user' => Yii::t('app', 'Id User'),
            'id_department' => Yii::t('app', 'Id Department'),
            'id_user_type' => Yii::t('app', 'Id User Type'),
            'flag_view' => Yii::t('app', 'Flag View'),
            'flag_edit' => Yii::t('app', 'Flag Edit'),
            'flag_delete' => Yii::t('app', 'Flag Delete'),			
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'id_department']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFile()
    {
        return $this->hasOne(File::className(), ['id' => 'id_file']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRuleType()
    {
        return $this->hasOne(RuleType::className(), ['id' => 'id_rule_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUserType()
    {
        return $this->hasOne(UserType::className(), ['id' => 'id_user_type']);
    }
}
