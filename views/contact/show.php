<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Profile'
?>

<div class="container">
    <div class="span3 well">

        <center>
            <img src="<?= "/uploads/$contact->id/$contact->profile_picture" ?>"
                 name="aboutme" width="140" height="140" class="img-circle">

            <h3><?= Html::encode("{$contact->first_name} {$contact->last_name}") ?></h3>
            <h4><?= $contact->status == 1 ? '<p style="color: green">Active</p>' : '<p style="color: red">Inactive</p>' ?></h4>
            <em><?= Html::encode($contact->email) ?></em>
            <br>
            <em>Marks: <?= $contact->marks ?></em>
            <br>

        </center>

        <br>
        <hr>
        <div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <a class="btn btn-info btn-block" href="<?= \yii\helpers\Url::to("/contact/$contact->id/edit") ?>">Edit</a>

                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <?= Html::button("DELETE", ['id' => 'delete-contact', 'class' => 'btn btn-danger btn-block', 'data-majd' => \yii\helpers\Url::to("/contact/$contact->id")]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#delete-contact").on('click', function (e) {
            e.preventDefault();
            var url = $("#delete-contact").data("majd");

            $.ajax({
                method: "DELETE",
                url: url,
                success: function (data) {
                    console.log(data.redirect);
                    window.location.href = data.redirect;
                    alert(data.message);
                },
                error: function (data) {
                    console.log(data);
                    alert(data.message);
                }
            })
            // console.log(url);
        })
    })
</script>