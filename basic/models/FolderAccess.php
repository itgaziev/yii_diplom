<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "folder_access".
 *
 * @property integer $id
 * @property integer $id_folder
 * @property integer $id_user
 * @property integer $id_department
 * @property integer $id_user_type
 * @property boolean $flag_view
 * @property boolean $flag_edit
 * @property boolean $flag_delete
 *
 * @property Department $idDepartment
 * @property Folder $idFolder
 * @property User $idUser
 * @property UserType $idUserType
 */
class FolderAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folder_access';
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
            [['id_folder', 'id_user', 'id_department', 'id_user_type'], 'integer'],
            [['flag_view', 'flag_edit', 'flag_delete'], 'boolean'],
            [['id_department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['id_department' => 'id']],
            [['id_folder'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['id_folder' => 'id']],
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
            'id_folder' => Yii::t('app', 'Id Folder'),
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
    public function getIdFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'id_folder']);
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
