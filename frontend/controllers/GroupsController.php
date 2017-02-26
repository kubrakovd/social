<?php

namespace frontend\controllers;

use Yii;
use yii\data\Pagination;
use common\models\Groups;
use common\models\GroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use persianyii\image\Resize;


/**
 * GroupsController implements the CRUD actions for Groups model.
 */
class GroupsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Groups models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Groups::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount'=>$count]);

        echo "<pre>";
        print_r($pagination);
        echo "</pre>";

        $groups = $query->offset($pagination->offset)
                        ->limit($pagination->limit)
                        ->all();

        return $this->render('index', ['pagination'=>$pagination,'groups'=>$groups]);
    }

    /**
     * Displays a single Groups model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionMember($id){
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Creates a new Groups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Groups();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if(!empty($_FILES)){
            switch ($_FILES['Groups']['type']['image']) {
                case 'image/jpeg':
                   $ext = 'png';
                    break;
                case 'image/jpg':
                   $ext = 'jpg';
                    break;
                case 'image/png':
                   $ext = 'png';
                    break;
                case 'image/gif':
                   $ext = 'gif';
                    break;
            }
            $newname = md5($_FILES['Groups']['name']['image'].time()). '.' . $ext;
            $file = move_uploaded_file($_FILES['Groups']['tmp_name']['image'], $_SERVER['DOCUMENT_ROOT'].Yii::getAlias('@web') . '/uploads/groups/' . $newname);
            $resize = new Resize($_SERVER['DOCUMENT_ROOT'].Yii::getAlias('@web') . '/uploads/groups/' . $newname);
            $resize->resizeTo(250, 250);
            $resize->saveImage($_SERVER['DOCUMENT_ROOT'].Yii::getAlias('@web') . '/uploads/groups/' . $newname);
            if($file){
                $record = Groups::findOne($model->id);
                $record->image = $newname;
                $record->save();
            }

        }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Groups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Groups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Groups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Groups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Groups::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
