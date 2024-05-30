<?php

namespace app\models;

use Yii;
use yii\base\UserException;	

/**
 * This is the model class for table "document".
 *
 * @property integer $id
 * @property integer $id_folder
 * @property string $registration_date
 * @property string $number
 * @property string $title
 * @property string $description
 * @property integer $page_count
 * @property string $destination
 * @property integer $id_user
 * @property integer $id_document_status
 *
 * @property DocumentStatus $idDocumentStatus
 * @property Folder $idFolder
 * @property User $idUser
 * @property DocumentAccess[] $documentAccesses
 * @property File[] $files
 */
class Document extends \yii\db\ActiveRecord
{
	
	public function getLinks ()
	{
		$files = $this->files;		
		$s = '';		
		foreach ($files as $file)
		{		
			$url = Yii::$app->getUrlManager()->createAbsoluteUrl(['file/download','id'=>$file->id]);
			if ($s != '') $s .= ' ';
			$s .= $url;
		}		
		return $s;
	}
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }
	
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_folder', 'page_count', 'id_user', 'id_document_status', 'id_document_kind'], 'integer'],
            [['registration_date'], 'safe'],
            [['description'], 'string'],
            [['number', 'title', 'destination'], 'string', 'max' => 255],
            [['id_document_status'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentStatus::className(), 'targetAttribute' => ['id_document_status' => 'id']],
			[['id_document_kind'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentKind::className(), 'targetAttribute' => ['id_document_kind' => 'id']],
            [['id_folder'], 'exist', 'skipOnError' => true, 'targetClass' => Folder::className(), 'targetAttribute' => ['id_folder' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
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
            'registration_date' => Yii::t('app', 'Registration Date'),
            'number' => Yii::t('app', 'Number'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'page_count' => Yii::t('app', 'Page Count'),
            'destination' => Yii::t('app', 'Destination'),
            'id_user' => Yii::t('app', 'Id User'),
            'id_document_status' => Yii::t('app', 'Id Document Status'),
			'id_document_kind' =>  Yii::t('app', 'Id Document Kind'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocumentStatus()
    {
        return $this->hasOne(DocumentStatus::className(), ['id' => 'id_document_status']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDocumentKind()
    {
        return $this->hasOne(DocumentKind::className(), ['id' => 'id_document_kind']);
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
    public function getDocumentAccesses()
    {
        return $this->hasMany(DocumentAccess::className(), ['id_document' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id_document' => 'id']);
    }
	
	public function TestAccess ()
	{
		if (Yii::$app->user->identity->id_user_type != \app\models\User::USER_TYPE_ADMIN and Yii::$app->user->identity->id != $this->id_user)
		{
			throw new UserException(Yii::t('app', 'Access denied'));
		}
	}
	
	public function TestAccessByFlag ($flag)
	{
		if (Yii::$app->user->identity->id_user_type != \app\models\User::USER_TYPE_ADMIN and Yii::$app->user->identity->id != $this->id_user)
		{			
			// *****************************************************************************************************
			$id_user = Yii::$app->user->identity->id;				
			$id_user_type = Yii::$app->user->identity->id_user_type;				
			$id_department = Yii::$app->user->identity->id_department;		
			// *****************************************************************************************************
			$query = \app\models\DocumentAccess::find ();			
			// *****************************************************************************************************
			$value = null;		
			// *****************************************************************************************************
			$dataset = $query->Where(['id_document' => $this->id])->andWhere (['id_user' => $id_user])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}				
			if ($value == true)
				return;		
			// *****************************************************************************************************
			$dataset = $query->Where(['id_document' => $this->id])->andWhere (['id_user_type' => $id_user_type])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}		
			if ($value == true)
				return;	
			// *****************************************************************************************************
			$dataset = $query->Where(['id_document' => $this->id])->andWhere (['id_department' => $id_department])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}		
			if ($value == true)
				return;	
			// *****************************************************************************************************
			$dataset = $query->Where(['id_document' => $this->id])->andWhere ('isnull(id_user_type) and isnull(id_department) and isnull(id_user)')->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)	
					$value = true;
			}
			// *****************************************************************************************************
			if (empty ($value) == true)
				throw new UserException(Yii::t('app', 'Access denied'));
			
		}			
	}
}
