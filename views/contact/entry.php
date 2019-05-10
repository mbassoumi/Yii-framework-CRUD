<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['action' => $submitLink]); ?>

    <div class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $titleText ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <?= $form->field($model, 'first_name')->label('First Name') ?>
                                        <!--                                    <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">-->
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <?= $form->field($model, 'last_name')->label('Last Name') ?>
                                        <!--                                        <input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">-->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <?= $form->field($model, 'email')->label('Email') ?>

                                <!--                                <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">-->
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <?= $form->field($model, 'marks')->input('number')->label('Marks') ?>

                                        <!--                                        <input type="number" name="password" id="password" class="form-control input-sm" placeholder="Password">-->
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <?= $form->field($model, 'status')->radioList([0 => 'Inactive', 1 => 'Active'])->label('Status') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= $form->field($model, 'profile_picture')->input('file')->label('Profile Picture') ?>
                            </div>

                            <?= Html::submitButton($buttonText, ['class' => 'btn btn-info btn-block']) ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>