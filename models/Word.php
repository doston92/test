<?php

namespace app\models;

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
            [['work', 'word', 'bal', 'view', 'created_time', 'status'], 'required'],
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
    // public static function get($id){  
    //   return static::findOne($id);  
    // }
    public static function get($id){
        // if(\app\models\Cat::check($id)!=0){
        //     $id = static::getMassiv($id);
        //     return static::findOne($id);
        // }else{  
        return static::findOne($id);
        // }  
    }
    public static function getLast(){
        return static::find()->orderBy(['id'=>SORT_DESC])
            ->limit(1)
            ->one();
    }
    public static function getMassiv($id){
        $posts = static::find()->orderBy(['id'=>SORT_ASC])->all();
        $data = \yii\helpers\ArrayHelper::toArray($posts, [
            'app\models\Word' => [
                'id',
                'work',
                'word',
                'bal',
            ],
        ]);
        // for ($i=0; $i < count($data); $i++) { 
        //     if ($data[$i]['id'] == $id) {
        //         return static::get($data[$i+1]['id']);
        //     }
        // }
        $count = count($data)-1;
        $nomer = 0;
        for ($i=0; $i <= $count; $i++) { 
           if($data[$i]["id"]==$id){
            $nomer = $i;
           }
        }
        $son2 = ($nomer+1>$count) ? $count : $nomer+1;
        // $prev = $data[$son];
        // $son2 = $nomer+1;
        return $data[$son2];
    }
    public static function getSon($id){
        $posts = static::find()->orderBy(['id'=>SORT_ASC])->all();
        $data = \yii\helpers\ArrayHelper::toArray($posts, [
            'app\models\Word' => [
                'id',
                'work',
                'word',
                'bal',
            ],
        ]);
        // for ($i=0; $i < count($data); $i++) { 
        //     if ($data[$i]['id'] == $id) {
        //         return static::get($data[$i+1]['id']);
        //     }
        // }
        $count = count($data)-1;
        $nomer = 0;
        for ($i=0; $i <= $count; $i++) { 
           if($data[$i]["id"]==$id){
            $nomer = $i;
           }
        }
        return $nomer+1;
    }
    public static function getCount(){
        return static::find()
           ->where(['status'=>'faol'])->count();
    }
    // public static function getUxshash($ux){
    //     return static::find()->orderBy(['id'=>SORT_DESC])->where(["like","title_uz", $ux])->limit(9)->all();
    // }
    //public static function pag($tur){
       //  if (isset($_GET["id"])) {
       //    $id = $_GET["id"];
       //    $model = static::find()->where(["rukn_id" => $id,"tur" => $tur])->orderBy(["id"=>SORT_DESC]);
       //    return new \yii\data\Pagination([
       //         'defaultPageSize' => 12,
       //         'totalCount' => $model->count()
       //    ]);
       //  }
       //  $model = static::find()->where(["tur" => $tur])->orderBy(["id"=>SORT_DESC]);
       //  return new \yii\data\Pagination([
       //       'defaultPageSize' => 12,
       //       'totalCount' => $model->count()
       //  ]);
       // }
       // public static function getTur($tur){
       //  if (isset($_GET["id"])) {
       //    $id = $_GET["id"];
       //    return static::find()->where(["rukn_id" => $id,"tur" => $tur])->orderBy(["id"=>SORT_DESC])->offset(static::pag($id,$tur)->offset)
       //    ->limit(static::pag($id,$tur)->limit)
       //    ->all();
       //  }
       //  return static::find()->where(["tur" => $tur])->orderBy(["id"=>SORT_DESC])->offset(static::pag($tur)->offset)
       //    ->limit(static::pag($tur)->limit)
       //    ->all();
       // }
    //public static function getRuk($id,$of,$lim){
    //    return static::find()->orderBy(['id'=>SORT_DESC])
    //        ->offset($of)
    //        ->where(['rukn_id'=>$id])
    //        ->limit($lim)
    //        ->all();
    // }
    // public static function getIkki($id){
    //    return static::find()->orderBy(['id'=>SORT_DESC])
    //        ->where(['rukn_id'=>$id])
    //        ->limit(2)
    //        ->all();
    // }
    // public static function getUch($id){
    //   return static::find()->orderBy(['id'=>SORT_DESC])
    //        ->where(['rukn_id'=>$id])
    //        ->limit(3)
    //        ->all();
    // }
   
    // public static function getKop($id){
    //   return static::find()->orderBy(['view'=>SORT_DESC])
    //        ->where(['rukn_id'=>$id])
    //        ->limit(3)
    //        ->all();
    // }
}
