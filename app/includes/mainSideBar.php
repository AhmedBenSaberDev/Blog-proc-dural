

<!-- Including database connection -->
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/listAllTopics.php');?>

<div class="main-side-bar">
    <ul>
        <?php foreach($topics as $topic): ?>
            <li><?= $topic['name']?></li>
        <?php endforeach; ?>
    </ul>
</div>