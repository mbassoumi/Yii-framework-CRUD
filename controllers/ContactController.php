<?php


namespace app\controllers;


use app\models\Contact;
use app\models\UploadForm;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class ContactController extends Controller
{
    public function actionIndex()
    {
        $query = Contact::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $contacts = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'contacts' => $contacts,
            'pagination' => $pagination,
        ]);
    }

    public function actionActiveContact()
    {
        $query = Contact::find()->where('status = 1');

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $contacts = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'contacts' => $contacts,
            'pagination' => $pagination,
        ]);
    }


    public function actionShow($id)
    {
        $contact = Contact::findOne($id);
        return $this->render('show', ['contact' => $contact]);
    }

    public function actionCreate()
    {
        $model = new Contact();
        return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);
    }

    public function actionEdit($id)
    {
        $contact = Contact::findOne($id);
        return $this->render('edit', ['model' => $contact, 'submitLink' => Url::to("/contact/{$id}/update")]);
    }

    public function actionUpdate($id)
    {
        $model = Contact::findOne($id);

        $model->load(Yii::$app->request->post());
        $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
        if ($model->validate()) {

            $model->save();

            $model->upload($id);

            return $this->redirect(Url::to(["contact/$id"]));
        } else {

            return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);
        }
    }

    public function actionStore()
    {
        $model = new Contact();

        $model->load(Yii::$app->request->post());
        $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');

        if ($model->validate()) {
            $model->save();
            // valid data received in $model
            $model->upload($model->id);
            return $this->redirect(Url::to("/contact/{$model->id}"));
        }

        // either the page is initially displayed or there is some validation error
        return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);

    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload();
            var_dump($model->imageFile);

//            if ($model->upload()) {
            // file is uploaded successfully
//                return;
//            }
        }

//        return $this->render('uploadform', ['model' => $model]);
    }


}