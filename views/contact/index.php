<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Active Contacts'
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .pointer {
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Active Contacts</h2>

<table id="contacts-list">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Profile Picture</th>
        <th>Marks</th>
        <th>status</th>
    </tr>

    <?php foreach ($contacts as $contact): ?>
        <tr class="pointer" id="<?= $contact->id ?>">
            <td><?= Html::encode($contact->first_name) ?></td>
            <td><?= Html::encode($contact->last_name) ?></td>
            <td><?= Html::encode($contact->email) ?></td>
            <td>dummy profile pic</td>
            <td><?= $contact->marks ?></td>
            <td><?= $contact->status == 1 ? 'Active' : 'Inactive' ?></td>
        </tr>
    <?php endforeach; ?>


</table>
<?= LinkPager::widget(['pagination' => $pagination]) ?>


</body>
</html>

<script>
    $(document).ready(function () {

        $('#contacts-list tr.pointer').click(function () {
            var href = "<?= \yii\helpers\Url::to('/contact')   ?>/" + $(this).attr('id');
            console.log(href);
            if (href) {
                window.location = href;
            }
        });
    });
</script>