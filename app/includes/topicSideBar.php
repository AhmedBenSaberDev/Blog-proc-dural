<?php
// Including 
include_once($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/listAllTopics.php');

// Including topics controller 
include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/postNumberByTopics.php'); 
?>

<div class="topic-sidebar">
    <h2>Categories</h2>
    <ul>
        <?php foreach($topics as $topic):?>
            <li> <a class="topic-link" data-id= <?= $topic['id'] ?> href="#"> <?= $topic['name'] ?></a> <span> <?= getPostsNumberByTopic($topic['name'])?> </span> </li>
        <?php endforeach; ?>
    </ul>
</div>