<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "{{%word}}".
 *
 * @property integer $id
 * @property string $work
 * @property string $word
 * @property integer $bal
 * @property integer $view
 * @property string $created_time
 * @property string $status
 */
class Word extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%word}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work'], 'required'],
            [['work', 'status'], 'string'],
            [['bal', 'view'], 'integer'],
            [['created_time'], 'safe'],
            [['word'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'work' => Yii::t('app', 'Work'),
            'word' => Yii::t('app', 'Word'),
            'bal' => Yii::t('app', 'Bal'),
            'view' => Yii::t('app', 'View'),
            'created_time' => Yii::t('app', 'Created Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    public static function get($id){
        return Word::findOne($id);
    }
    public static function getAll(){
        if (isset($_GET["id"])) {
          $id = $_GET["id"];
            return static::find()->where(["rukn_id" => $id])->orderBy(["id"=>SORT_DESC])
            ->all();
        }
        return static::find()->orderBy(["id"=>SORT_ASC])
            ->all();
    }
}
