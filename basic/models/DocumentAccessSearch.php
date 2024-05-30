<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocumentAccess;

/**
 * DocumentAccessSearch represents the model behind the search form about `app\models\DocumentAccess`.
 */
class DocumentAccessSearch extends DocumentAccess
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_document', 'id_user', 'id_department', 'id_user_type'], 'integer'],
            [['flag_view', 'flag_edit', 'flag_delete'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DocumentAccess::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_document' => $this->id_document,
            'id_user' => $this->id_user,
            'id_department' => $this->id_department,
            'id_user_type' => $this->id_user_type,
            'flag_view' => $this->flag_view,         
            'flag_edit' => $this->flag_edit,
            'flag_delete' => $this->flag_delete,
        ]);

        return $dataProvider;
    }
}
