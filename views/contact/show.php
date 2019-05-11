<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Profile'
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="span3 well">
        <center>
            <img src="<?="/uploads/$contact->id/$contact->profile_picture" ?>"
                 name="aboutme" width="140" height="140" class="img-circle">

            <h3><?= Html::encode("{$contact->first_name} {$contact->last_name}") ?></h3>
            <h4><?= $contact->status == 1 ? '<p style="color: green">Active</p>' : '<p style="color: red">Inactive</p>' ?></h4>
            <em><?= Html::encode($contact->email) ?></em>
            <br>
            <em>Marks: <?= $contact->marks ?></em>
            <br>

        </center>
    </div>
</div>