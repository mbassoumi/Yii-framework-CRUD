<?php


namespace app\controllers;


use app\models\Contact;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;

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
        $buttonText = 'Create';
        $titleText = 'Create a New Contact';
        return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store'), 'buttonText' => $buttonText, 'titleText' => $titleText]);
    }

    public function actionEdit($id)
    {
        $contact = Contact::findOne($id);
        $buttonText = 'Update';
        $titleText = 'Update a an Exist Contact';
        return $this->render('edit', ['model' => $contact, 'submitLink' => Url::to("/contact/{$id}/update"), 'buttonText' => $buttonText, 'titleText' => $titleText]);
    }

    public function actionUpdate($id)
    {
        $model = Contact::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();

            return $this->redirect(Url::to(["contact/$id"]));
        } else {

            return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);
        }
    }

    public function actionStore()
    {
        $model = new Contact();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            $model->save();
            return $this->redirect(Url::to("/contact/{$model->id}"));
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);
        }
    }

}