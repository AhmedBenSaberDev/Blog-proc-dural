<?php session_start(); ?>

<!-- Including head -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/head.php'); ?>

<!-- Including topics controller -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/listAllTopics.php'); ?>

<body class="admin-body">

    <!-- Including the header -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/header.php'); ?>

    <?php redirectIfNotAdmin(); ?>
    <div class="admin-wrapper">

        <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/adminSideBar.php'); ?>

        <div class="container">
            <div class="manage-topic-links">
                <a href=<?= BASE_URL . "/app/admin/posts/index.php" ?>>Add post</a>
                <a href=<?= BASE_URL . "/app/admin/posts/manage.php" ?>>Manage post</a>
            </div>
            <!-- ***************************************************************************** -->

            <h1 class="add-post-title">Add Post</h1>
            <form class="form-width" enctype='multipart/form-data' method="POST" action=<?= BASE_URL . "/app/controllers/addPost.php" ?>>

                <?php if (checkIfTopicFormError("description") || checkIfTopicFormError("post-name")  || checkIfTopicFormError("image")) : ?>
                    <div class="errors">
                        <p> <?= checkIfTopicFormError("description")  ?> </p>
                        <p> <?= checkIfTopicFormError("post-name")  ?> </p>
                        <p> <?= checkIfTopicFormError("topic")  ?> </p>
                        <p> <?= checkIfTopicFormError("image")  ?> </p>
                    </div>
                <?php endif; ?>

                <div class="form-item">
                    <div class="flex">
                        
                        <span class="form-errors"> </span>
                    </div>
                    <input type="text" class="field" name="post-name" placeholder="Post title" value=<?= displayOldValuesAddForm("title") ?>>
                </div>
                <div class="form-item">
                    <div class="flex">

                    </div>
                    <textarea id="editor" class="field" name="post-description" placeholder="BODY"><?= displayOldValuesAddForm("description") ?></textarea>
                </div>

                <div class="form-item">
                    <div class="flex">

                    </div>
                    <input class="field" type="file" id="post-image" name="post-image" accept="image/png, image/jpeg">
                </div>

                <div class="form-item">
                    <div class="flex">

                    </div>
                    <select class=" field" name="topic" id="topic">
                        <option value="">Choose a topic</option>
                        <?php foreach ($topics as $topic) : ?>
                            <option value=<?= $topic['id'] ?>><?= $topic['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-item">
                    <button name="add-post" type="submit" class="signin-btn">Add Post</button>
                </div>
            </form>

            <?php unset($_SESSION['error']); ?>
            <?php unset($_SESSION['old-addPost-value-form']) ?>

        </div>
    </div>


    <!-- Including the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/footer.php'); ?>


    <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>

</body>