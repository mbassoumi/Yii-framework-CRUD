<?php


namespace app\controllers;


use app\models\Contact;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ContactController extends Controller
{

    /**
     * route: GET /contact
     * return all contacts in the database [active and inactive]
     *
     * @return string
     */
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

        $title = 'All Contacts';
        return $this->render('index', [
            'contacts' => $contacts,
            'pagination' => $pagination,
            'withActions' => true,
            'title' => $title
        ]);
    }

    /**
     * route: GET /contact/active-contact
     * return just the active contacts from the database
     *
     * @return string
     */
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

        $title = 'Active Contacts';
        return $this->render('index', [
            'contacts' => $contacts,
            'pagination' => $pagination,
            'withActions' => false,
            'title' => $title
        ]);
    }


    /**
     * route: GET /contact/{contact_id}
     * return contact information
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShow($id)
    {
        $contact = Contact::findOne($id);
        if (is_null($contact)){
            throw new NotFoundHttpException();
        }
        return $this->render('show', ['contact' => $contact]);
    }

    /**
     * route: GET /contact/create
     * return create contact view
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Contact();
        return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);
    }

    /**
     * route: GET /contact/{contact_id}/edit
     * return edit view with contact information filled inside it
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionEdit($id)
    {
        $contact = Contact::findOne($id);
        if (is_null($contact)){
            throw new NotFoundHttpException();
        }
        return $this->render('edit', ['model' => $contact, 'submitLink' => Url::to("/contact/{$id}")]);
    }

    /**
     * route: POST /contact/{contact_id}
     * update the contact in database
     *
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $model = Contact::findOne($id);

        $model->load(Yii::$app->request->post());
        $model->profile_picture = UploadedFile::getInstance($model, 'profile_picture');
        if ($model->validate()) {

            $model->save();

            $model->upload($id);

            return $this->redirect(Url::to(["/contact/$id"]));
        } else {

            return $this->render('create', ['model' => $model, 'submitLink' => Url::to('/contact/store')]);
        }
    }

    /**
     * route: POST /contact/store
     * store the new contact in database
     *
     * @return string|\yii\web\Response
     */
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

    /**
     * route: DELETE /contact/{contact_id}
     * delete contact from database
     *
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDestroy($id)
    {
        try {
            $contact = Contact::findOne($id);
            if (is_null($contact)){
                throw new \Exception("contact not found");
            }
            Contact::deleteAll("id = $id");
            return $this->asJson(['message' => "$contact->first_name $contact->last_name has been deleted", 'redirect' => Url::to('/contact')]);
        }catch (\Exception $exception){
            return $this->asJson(['message' => $exception->getMessage()])->setStatusCode(500);
        }
    }

}