<?php session_start(); ?>
<!-- Including head -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/head.php'); ?>

<!-- Including post controller -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/managePosts.php'); ?>

<body class="admin-body">

    <!-- Including the header -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/header.php'); ?>
    <?php redirectIfNotAdmin(); ?>

    <div class="admin-wrapper">

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/adminSideBar.php'); ?>

        <div class="container">
            <div class="manage-topic-links">
                <a href=<?= BASE_URL . "/app/admin/posts/index.php" ?>>Add post</a>
                <a href=<?= BASE_URL . "/app/admin/posts/manage.php" ?>>Manage posts</a>
            </div>

            <h1 class="add-post-title">Manage posts</h1>

                <?php if(isset($_SESSION['success'])): ?>
                    <div class="success">
                        <p> <?= $_SESSION['success']  ?> </p>
                    </div>
                <?php endif; ?>

            <div class="table-wrapper">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>TITLE </th>
                            <th>AUTHOR</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($posts as $post): ?>
                        <tr>
                            <td><?= $post['id'] ?> </td>
                            <td><?= $post['title'] ?></td>
                            <td><?= $post['user_id'] ?></td>
                            <td> 
                                <a href=<?= BASE_URL . "/app/admin/posts/edit.php?id=".$post['id']?>><i class="far fa-edit"></i></a> 
                                <a href= <?= BASE_URL . "/app/controllers/managePosts.php?delete-post&id=".$post['id']?> ><i class="far fa-trash-alt"></i></a> 
                                <?php if($post['published']):?>
                                    <?= '<a class="publish" href=' .BASE_URL. "/app/controllers/publishPost.php?unpublish-post&id=".$post['id'] .' >Unpublish</a>'?>
                                <?php else: ?>
                                    <?= '<a class="publish" href=' .BASE_URL. "/app/controllers/publishPost.php?publish-post&id=".$post['id'] .' >Publish</a>'?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>

    <?php unset($_SESSION['success']); ?>
    <!-- Including the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/footer.php'); ?>


</body>