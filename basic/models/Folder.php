<?php

namespace app\models;

use Yii;
use yii\base\UserException;	

/**
 * This is the model class for table "folder".
 *
 * @property integer $id
 * @property integer $id_partition
 * @property string $registration_date
 * @property string $number
 * @property string $title
 * @property integer $id_user
 *
 * @property Document[] $documents
 * @property Partition $idPartition
 * @property User $idUser
 * @property FolderAccess[] $folderAccesses
 */
class Folder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'folder';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_partition', 'id_user'], 'integer'],
            [['registration_date'], 'safe'],
            [['number', 'title'], 'string', 'max' => 255],
            [['id_partition'], 'exist', 'skipOnError' => true, 'targetClass' => Partition::className(), 'targetAttribute' => ['id_partition' => 'id']],
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
            'id_partition' => Yii::t('app', 'Id Partition'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'number' => Yii::t('app', 'Number'),
            'title' => Yii::t('app', 'Title'),
            'id_user' => Yii::t('app', 'Id User'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['id_folder' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPartition()
    {
        return $this->hasOne(Partition::className(), ['id' => 'id_partition']);
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
    public function getFolderAccesses()
    {
        return $this->hasMany(FolderAccess::className(), ['id_folder' => 'id']);
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
			$query = \app\models\FolderAccess::find ();			
			// *****************************************************************************************************
			$value = null;		
			// *****************************************************************************************************
			$dataset = $query->Where(['id_folder' => $this->id])->andWhere (['id_user' => $id_user])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}				
			if ($value == true)
				return;		
			// *****************************************************************************************************
			$dataset = $query->Where(['id_folder' => $this->id])->andWhere (['id_user_type' => $id_user_type])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}		
			if ($value == true)
				return;	
			// *****************************************************************************************************
			$dataset = $query->Where(['id_folder' => $this->id])->andWhere (['id_department' => $id_department])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}		
			if ($value == true)
				return;	
			// *****************************************************************************************************
			$dataset = $query->Where(['id_folder' => $this->id])->andWhere ('isnull(id_user_type) and isnull(id_department) and isnull(id_user)')->all();					
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
