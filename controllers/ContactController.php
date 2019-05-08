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
//        var_dump($contact);
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
            var_dump('yessss');
//            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);
        }
    }

}