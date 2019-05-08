<?php


namespace app\controllers;


use app\models\Country;
use yii\data\Pagination;
use yii\web\Controller;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionShow($id)
    {
        $country = Country::find()->where("id = '$id'")->all();
        if (!empty($country)){
            $country = current($country);
        }
        var_dump($country->name);
    }

    public function actionEdit($id)
    {
        $country = Country::find()->where("id = '$id'")->all();
        if (!empty($country)){
            $country = current($country);
        }
        var_dump($country->id);
    }


}