<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\components\SaytController;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\{
    Users,
    Word,
    Cat
};

class SiteController extends SaytController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $id = Cat::getLast()['word_id'];
        $count = Word::getLast()['id'];
        if($id==$count){
            $model = "Tugadi";
            if(!Yii::$app->user->isGuest)
                $javob = "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".Users::findOne(Yii::$app->user->identity->id)['bal']."</b>";
        }else{
            $model = Word::getMassiv(Cat::getOne()['word_id']);
        }
        return $this->render('index',[
            'talaba' => \app\models\Users::getUch(),
            'talaba_umumiy' => \app\models\Users::getAll(),
            'model' => $model,
            'id' => $id+1,
            'user' => Yii::$app->user->identity,
            'count' => $count,
        ]);
    }
    
    public function actionTest($id=1)
    {

        $javob = false;
        $kount = false;
        $next = false;
        if(Yii::$app->request->isAjax){
            $model = Word::get($id);
            if(Cat::getTrueCount($model['id'])>0 && isset($_GET['id'])){
                $userbal = Users::findOne(Yii::$app->user->identity->id)['bal'];
                $kount = Cat::getWordCount($model['id']);
                $javob = "Siz ".Word::getSon($model['id'])." - savolga <b>".$kount."</b> urinishda to'g'ri javob topgansiz. Umumiy ballaringiz miqdori: <b>".$userbal."</b>";
                $next = true;
            }
            if($id == 1 && Cat::getTrueCount(1)){
                $userbal = Users::findOne(Yii::$app->user->identity->id)['bal'];
                $kount = Cat::getWordCount($model['id']);
                $javob = "Siz ".Word::getSon($model['id'])." - savolga <b>".$kount."</b> urinishda to'g'ri javob topgansiz. Umumiy ballaringiz miqdori: <b>".$userbal."</b>";
                $next = true;
            }
            // if(!$model){
            //     $model = "Tugadi";
            // }
            if(isset($_POST['word'])&&isset($_POST['ok'])){
                $model1 = Word::findOne($_POST['ok']);
                if($_POST['word']==$model1['work']){;
                    Users::plyus($model1['bal']);
                    $cat = new Cat;
                    $cat->user_id = Yii::$app->user->identity->id;
                    $cat->word_id = $_POST['ok'];
                    $cat->created_time = date("Y-m-d H:i:s");
                    $cat->bal = $model1['bal'];
                    $cat->save();
                    // echo "To'g'ri ".$model1->savol." =>".$model1->otvet." =".$_POST['ok'];
                    $model = Word::get($_POST['ok']);
                    $userbal = Users::findOne(Yii::$app->user->identity->id)['bal'];
                    $kount = Cat::getWordCount($model['id']);
                    $javob = "Javobingiz to'g'ri! Siz <b>".$kount."</b> urinishda to'g'ri javob topdingiz va sizga <b>".$model['bal']."</b> bal berildi. Umumiy ballaringiz miqdori: <b>".$userbal."</b>";
                    $next = true;
                    // if($_POST['ok']==Word::getLast()['id']){
                    //     return $this->renderAjax('test',[
                    //         'model' => $model,
                    //         'user' => Yii::$app->user->identity
                    //     ]);
                    // }
                }
                else{
                    $cat = new Cat;
                    $cat->user_id = Yii::$app->user->identity->id;
                    $cat->word_id = $_POST['ok'];
                    $cat->created_time = date("Y-m-d H:i:s");
                    $cat->bal = 0;
                    $cat->save();
                    $kount = Cat::getWordCount($_POST['ok']);
                    $javob = "Javobingiz noto'g'ri! Siz <b>$kount</b> urinishda to'g'ri javob topa olmadingiz. Yana bir bor urinib ko'ring!";
                    $model = Word::get($_POST['ok']);
                    $next = false;
                }
            }
            if(isset($_POST['next'])&&$_POST['next']){
                $model = ($_POST['next']!=Word::getLast()['id'])?Word::get(Word::getMassiv($_POST['next'])['id']):'Tugadi';
                // print_r($_POST['next']);
                if($_POST['next']==Word::getLast()['id']){
                    return $this->renderAjax('test',[
                        'model' => $model,
                        'javob' => "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".Users::findOne(Yii::$app->user->identity->id)['bal']."</b>",
                        'user' => Yii::$app->user->identity
                    ]);
                }
            }
            if($model=="Tugadi"){
                $ball = Users::findOne(Yii::$app->user->identity->id)['bal'];
                return $this->renderAjax('test',[
                    'model' => $model,
                    'javob' => "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".$ball."</b>",
                    'user' => Yii::$app->user->identity
                ]);
            }else{
                $work = $model['work'];
                $word = explode(',',$model['word']);
                $text = $work;
                for ($i=0; $i < count($word); $i++) { 
                   $work = str_replace($word[$i], "<span class='bir ikki' status='aktiv'>...</span>", $work);
                }
                for ($i=0; $i < count($word); $i++) { 
                   $text = str_replace($word[$i], md5($word[$i]), $text);
                }
                $sled = ($model['id']!=Word::getLast()['id'])?Word::getMassiv($model['id'])['id']:'Tugadi';
                if($id=="Tugadi"){
                    $ball = Users::findOne(Yii::$app->user->identity->id)['bal'];
                    $model = "Tugadi";
                    $javob = "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".$ball."</b>";
                }
                return $this->renderAjax('test',[
                    'model' => $model,
                    'javob' => $javob,
                    'sled' => $sled,
                    'next' => $next,
                    'son' => ($id!="Tugadi")?Word::getSon($model['id']):0,
                    'word' => $word,
                    'work' => $work,
                    'user' => Yii::$app->user->identity
                ]);
            }
        }
        // $catId = Cat::check($id);
        // $model = Word::get($id);

        // $kat = Cat::getLast()['word_id'];
        // $vord = Word::getLast()['id'];
        // if($kat==$vord){
        //         $model = "Tugadi";
        //         $javob = "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".Users::findOne(Yii::$app->user->identity->id)['bal']."</b>";
        // }elseif(Cat::getCount()==0){
        //     $model = Word::get($id);
        // }
        // elseif(Cat::getLast()['bal']!=0){
        //     $model = Word::getMassiv(Cat::getOne()['word_id']);
        // }elseif(Cat::getLast()['bal']==0){
        //     $model = Word::get(Cat::getLast()['word_id']);
        // }
        $model = Word::get($id);
        if(Cat::getTrueCount($model['id'])>0 && isset($_GET['id'])){
            $userbal = Users::findOne(Yii::$app->user->identity->id)['bal'];
            $kount = Cat::getWordCount($model['id']);
            $javob = "Siz ".Word::getSon($model['id'])." - savolga <b>".$kount."</b> urinishda to'g'ri javob topgansiz. Umumiy ballaringiz miqdori: <b>".$userbal."</b>";
            $next = true;
        }
        if($id == 1 && Cat::getTrueCount(1)){
            $userbal = Users::findOne(Yii::$app->user->identity->id)['bal'];
            $kount = Cat::getWordCount($model['id']);
            $javob = "Siz ".Word::getSon($model['id'])." - savolga <b>".$kount."</b> urinishda to'g'ri javob topgansiz. Umumiy ballaringiz miqdori: <b>".$userbal."</b>";
            $next = true;
        }
        // if(!$model){
        //     $model = "Tugadi";
        // }
        if(isset($_POST['word'])&&isset($_POST['ok'])){
            $model1 = Word::findOne($_POST['ok']);
            if($_POST['word']==$model1['work']){;
                Users::plyus($model1['bal']);
                $cat = new Cat;
                $cat->user_id = Yii::$app->user->identity->id;
                $cat->word_id = $_POST['ok'];
                $cat->created_time = date("Y-m-d H:i:s");
                $cat->bal = $model1['bal'];
                $cat->save();
                // echo "To'g'ri ".$model1->savol." =>".$model1->otvet." =".$_POST['ok'];
                $model = Word::get($_POST['ok']);
                $userbal = Users::findOne(Yii::$app->user->identity->id)['bal'];
                $kount = Cat::getWordCount($model['id']);
                $javob = "Javobingiz to'g'ri! Siz <b>".$kount."</b> urinishda to'g'ri javob topdingiz va sizga <b>".$model['bal']."</b> bal berildi. Umumiy ballaringiz miqdori: <b>".$userbal."</b>";
                $next = true;
                // if($_POST['ok']==Word::getLast()['id']){
                //     return $this->render('test',[
                //         'model' => $model,
                //         'user' => Yii::$app->user->identity
                //     ]);
                // }
            }
            else{
                $cat = new Cat;
                $cat->user_id = Yii::$app->user->identity->id;
                $cat->word_id = $_POST['ok'];
                $cat->created_time = date("Y-m-d H:i:s");
                $cat->bal = 0;
                $cat->save();
                $kount = Cat::getWordCount($model['id']);
                $javob = "Javobingiz noto'g'ri! Siz <b>$kount</b> urinishda to'g'ri javob topa olmadingiz. Yana bir bor urinib ko'ring!";
                $model = Word::get($_POST['ok']);
                $next = false;
            }
        }
        if(isset($_POST['next'])&&$_POST['next']){
            $model = ($_POST['next']!=Word::getLast()['id'])?Word::get(Word::getMassiv($_POST['next'])['id']):'Tugadi';
            // print_r($_POST['next']);
            if($_POST['next']==Word::getLast()['id']){
                return $this->render('test',[
                    'model' => $model,
                    'javob' => "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".Users::findOne(Yii::$app->user->identity->id)['bal']."</b>",
                    'user' => Yii::$app->user->identity
                ]);
            }
        }
        if($model=="Tugadi"){
            return $this->render('test',[
                'model' => $model,
                'javob' => "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".Users::findOne(Yii::$app->user->identity->id)['bal']."</b>",
                'user' => Yii::$app->user->identity
            ]);
        }else{
            $work = $model['work'];
            $word = explode(',',$model['word']);
            for ($i=0; $i < count($word); $i++) { 
               $work = str_replace($word[$i], "<span class='bir ikki' status='aktiv'>...</span>", $work);
            }
            $sled = ($model['id']!=Word::getLast()['id'])?Word::getMassiv($model['id'])['id']:'Tugadi';
            if($id=="Tugadi"){
                $model = "Tugadi";
                $javob = "Savollar tugadi! Siz <b>".Word::getCount()."</b> ta savolga <b>".Cat::getCountAll()."</b> ta urinishda <b>".Cat::getCount()."</b> ta to'g'ri javob topdingiz. Umumiy ballaringiz miqdori: <b>".Users::findOne(Yii::$app->user->identity->id)['bal']."</b>";
            }
            return $this->render('test',[
                'model' => $model,
                'javob' => $javob,
                'sled' => $sled,
                'next' => $next,
                'son' => ($model!="Tugadi")?Word::getSon($model['id']):0,
                'word' => $word,
                'work' => $work,
                'user' => Yii::$app->user->identity
            ]);
        }
    }
    public function actionProfil()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = \app\models\Users::findOne(Yii::$app->user->identity->id);
        if(isset($_GET['id']))
            $model = \app\models\Users::findOne($_GET['id']);
        if($model->load(Yii::$app->request->post())){
            if($_GET['edit']) {
                $uchir = $_POST['rasm'];
                $vaqt = date("dmYHsi");
                    if (\yii\web\UploadedFile::getInstance($model,'image')) {
                        $model->image = \yii\web\UploadedFile::getInstance($model,'image');
                        $model->image->saveAs('papka/uzer/'.$vaqt.'.'.$model->image->extension);
                        $rasm = "papka/uzer/".$vaqt.'.'.$model->image->extension;
                        if($uchir !="" && $uchir != 'dist/image/uzer.jpg'){
                        $massiv = explode('/', $uchir);
                            if(is_dir($massiv[0]))
                                chdir($massiv[0]);
                            if(is_dir($massiv[1]))
                                chdir($massiv[1]);
                            if(is_file($massiv[2]))
                                unlink($massiv[2]);
                        }
                    }else{
                        $rasm = $_POST['rasm'];
                    }
                // $javob = true;
                $yuser = \app\models\Users::findOne($model->id);
                $yuser->ism = $model->ism;
                $yuser->familiya = $model->familiya;
                $yuser->otchestvo = $model->otchestvo;
                // $yuser->vaqt = $_POST['vaqt'];
                $yuser->authKey = Yii::$app->security->generateRandomString();
                $yuser->accessToken = Yii::$app->security->generateRandomString();
                $yuser->image = $rasm;
                $yuser->jins = $model->jins;
                $yuser->save();
                if ($yuser->save())
                    return $this->redirect('profil');
                return $this->render('profil',[
                    'model' => $model,
                ]);
            }
        }
        if (isset($_GET["delete"]) && Yii::$app->user->identity->id==$_GET['delete']) {
            $yuser = \app\models\Users::findOne($_GET['delete']);
            $uchir = $yuser->image;
            if($uchir !="" && $uchir != 'dist/image/uzer.jpg'){
                $massiv = explode('/', $uchir);
                if(is_dir($massiv[0]))
                    chdir($massiv[0]);
                if(is_dir($massiv[1]))
                    chdir($massiv[1]);
                if(is_file($massiv[2]))
                    unlink($massiv[2]);
            }
            $yuser->delete();
            echo $_GET['delete'];
            if($yuser->delete())
                return $this->redirect("index");

            return $this->redirect("index");
        }
        return $this->render('profil',[
                'model' => $model,
            ]);
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionReg()
    {
        $model = new \app\models\Users();
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if(Yii::$app->request->isAjax){
            $bor = \app\models\Users::find()->where(['login'=>$_POST['bor']])->all();
            if ($bor) {
                echo "BOR";
            }else{
                echo "Yoq";
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->saqlash()) {
            return $this->redirect('index');
        } else {
            return $this->render('reg', [
            'model' => $model,
            'bor' => 'yoq'
            ]);
        }
    }
     public function actionReg1()
    {
        // Yii::$app->user->login(\app\models\Users::findByUsername("admin"),24);
        if(Yii::$app->request->isAjax){
            $bor = \app\models\Users::find()->where(['login'=>$_POST['bor']])->all();
            if ($bor) {
                echo "<div style='color:red;background:ivory;padding:5px'>Bu login mavjud,boshqa login tanlang</div><div style='display:none' id='javob'>1</div>";
            }else{
                echo "<div id='javob'><span style='font-size:20px'>&#10004;</span></div>";
            }
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
