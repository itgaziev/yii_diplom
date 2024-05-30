<?php

namespace app\models;

use Yii;
use yii\base\UserException;	

/**
 * This is the model class for table "file".
 *
 * @property integer $id
 * @property integer $id_document
 * @property string $registration_date
 * @property string $number
 * @property string $title
 * @property string $filename
 * @property integer $size
 * @property integer $id_user
 *
 * @property User $idUser
 * @property Document $idDocument
 * @property FileAccess[] $fileAccesses
 */
class File extends \yii\db\ActiveRecord
{
	
	public $ffile = null;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_document', 'size', 'id_user'], 'integer'],
            [['registration_date'], 'safe'],
            [['number', 'title', 'filename'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_document'], 'exist', 'skipOnError' => true, 'targetClass' => Document::className(), 'targetAttribute' => ['id_document' => 'id']],
			
			['ffile', 'file', 'skipOnEmpty' => true /*, 'extensions' => '*.*', 'maxFiles' => 1*/],
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
            'registration_date' => Yii::t('app', 'Registration Date'),
            'number' => Yii::t('app', 'Number'),
            'title' => Yii::t('app', 'Title'),
            'filename' => Yii::t('app', 'Filename'),
            'size' => Yii::t('app', 'Size'),
            'id_user' => Yii::t('app', 'Id User'),
        ];
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
    public function getIdDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'id_document']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFileAccesses()
    {
        return $this->hasMany(FileAccess::className(), ['id_file' => 'id']);
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
			$query = \app\models\FileAccess::find ();			
			// *****************************************************************************************************
			$value = null;		
			// *****************************************************************************************************
			$dataset = $query->Where(['id_file' => $this->id])->andWhere (['id_user' => $id_user])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}				
			if ($value == true)
				return;		
			// *****************************************************************************************************
			$dataset = $query->Where(['id_file' => $this->id])->andWhere (['id_user_type' => $id_user_type])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}		
			if ($value == true)
				return;	
			// *****************************************************************************************************
			$dataset = $query->Where(['id_file' => $this->id])->andWhere (['id_department' => $id_department])->all();					
			foreach ($dataset as $data)
			{
				if (empty ($data[$flag]) == false)
					$value = true;						
			}		
			if ($value == true)
				return;	
			// *****************************************************************************************************
			$dataset = $query->Where(['id_file' => $this->id])->andWhere ('isnull(id_user_type) and isnull(id_department) and isnull(id_user)')->all();					
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
