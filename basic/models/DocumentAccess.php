<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document_access".
 *
 * @property integer $id
 * @property integer $id_document
 * @property integer $id_user
 * @property integer $id_department
 * @property integer $id_user_type
 * @property boolean $flag_view
 * @property boolean $flag_add
 * @property boolean $flag_edit
 * @property boolean $flag_delete
 *
 * @property Department $idDepartment
 * @property Document $idDocument
 * @property User $idUser
 * @property UserType $idUserType
 */
class DocumentAccess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_access';
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
            [['id_document', 'id_user', 'id_department', 'id_user_type'], 'integer'],
            [['flag_view', 'flag_edit', 'flag_delete'], 'boolean'],
            [['id_department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['id_department' => 'id']],
            [['id_document'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['id_document' => 'id']],
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
            'id_document' => Yii::t('app', 'Id Document'),
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
    public function getIdDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'id_document']);
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
