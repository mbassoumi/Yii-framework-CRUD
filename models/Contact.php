<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

class Contact extends ActiveRecord
{

    public static function tableName()
    {
        return 'contacts';
    }

    public function rules()
    {
        return [
            [['first_name','last_name', 'email', 'marks', 'status', 'profile_picture'], 'required'],
            ['email', 'email'],
            ['marks', 'number'],
            [['profile_picture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }

    public function upload($id)
    {
        if ($this->validate()) {
            FileHelper::createDirectory("uploads/$id/", $mode = 0775, $recursive = true);

            $this->profile_picture->saveAs("uploads/$id/" . $this->profile_picture->baseName . '.' . $this->profile_picture->extension);
            return true;
        } else {
            return false;
        }
    }


}