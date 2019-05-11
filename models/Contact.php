<?php


namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\FileHelper;

class Contact extends ActiveRecord
{

    /**
     * database table for contacts
     *
     * @return string
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * validations rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['first_name','last_name', 'email', 'marks', 'status', 'profile_picture'], 'required'],
            ['email', 'email'],
            ['marks', 'number'],
            [['profile_picture'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }


    /**
     * upload function for profile picture
     * store the uploaded picture in /uploads/{contact_id}/{profile picture name}
     *
     * @param $id
     * @return bool
     * @throws \yii\base\Exception
     */
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