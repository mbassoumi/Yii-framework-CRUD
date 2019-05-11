<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = $title
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

<h2><?= $title ?></h2>

<?php if (count($contacts) > 0) {
    ?>
    <table id="contacts-list">
        <tr>
            <th>Profile Picture</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Marks</th>
            <?php if ($withActions) {
                echo "<th>status</th>";
                echo "<th>Actions</th>";
            }
            ?>
        </tr>

        <?php foreach ($contacts as $contact): ?>
            <tr id="<?= $contact->id ?>">
                <td><img src="<?= "/uploads/$contact->id/$contact->profile_picture" ?>"
                         name="aboutme" width="40" height="40" class="img-circle"></td>
                <td><?= Html::encode($contact->first_name) ?></td>
                <td><?= Html::encode($contact->last_name) ?></td>
                <td><?= Html::encode($contact->email) ?></td>
                <td><?= $contact->marks ?></td>
                <?php if ($withActions) {
                    echo "<td>";
                    if ($contact->status == 1){
                        echo "<P style='color: green'>Active</P>";
                    }else{
                        echo "<p style='color: red'>Inactive</p>";
                    }
                    echo "</td>";
                    echo "
                    <td>
                        &nbsp;
                        <span data-id=$contact->id class=\"pointer delete-contact\" style=\"font-size: 1.5em; color: red; \"><i class=\"fas fa-trash\"></i></span>
                        &nbsp;
                        <span data-id=$contact->id class=\"pointer view-contact\"  style=\"font-size: 1.5em; color: blue; align-self: center\"><i class=\"fas fa-eye\"></i></span>
                        &nbsp;
                        <span data-id=$contact->id class=\"pointer update-contact\"  style=\"font-size: 1.5em; color: green; \"><i class=\"fas fa-pencil-alt\"></i></span>
                    </td>";
                }
                ?>
            </tr>
        <?php endforeach; ?>


    </table>
    <center>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </center>

    <?php
} else {
    ?>

    <div class="container">
        <div class="span3 well">

            <center>
                <h3>NO DATA TO BE DISPLAYED</h3>
            </center>

        </div>
    </div>

    <?php
}
?>


</body>
</html>

<script>
    $(document).ready(function () {
        $('.delete-contact').on('click', function (e) {
            e.preventDefault();
            var contact_id = this.getAttribute('data-id');

            var url = "/contact/" + contact_id;

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
            alert('delete');
        });
        $('.update-contact').on('click', function (e) {
            var contact_id = this.getAttribute('data-id');
            window.location.href = '/contact/' + contact_id + '/edit';
        });
        $('.view-contact').on('click', function (e) {
            var contact_id = this.getAttribute('data-id');
            window.location.href = '/contact/' + contact_id;
        });

    });
</script>