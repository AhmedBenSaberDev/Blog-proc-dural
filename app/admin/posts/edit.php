<?php session_start(); ?>

<!-- Including head -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/head.php'); ?>

<!-- Including edit post controller -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/editPost.php'); ?>

<!-- Including list all topics controller -->
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
                <a href=<?= BASE_URL . "/app/admin/posts/manage.php" ?>>Manage posts</a>
            </div>

            <form enctype="multipart/form-data" method="POST" class="form-width" action= <?= BASE_URL . "/app/controllers/editPost.php" ?> >
                
                <h1 class="add-post-title">Edit post</h1>
                    <?php if(isset($_SESSION['error'])):?>
                    <div class="errors">
                        <p> <?= checkIfTopicFormError("body")  ?> </p>
                        <p> <?= checkIfTopicFormError("post-name")  ?> </p>
                        <p> <?= checkIfTopicFormError("image")  ?> </p>
                        <p> <?= checkIfTopicFormError("topic")  ?> </p>
                    </div>
                    <?php endif; ?>
                    
                    <div class="form-item">
                        <input class="field" name="post-name" type="text" id="post-name" placeholder="TITLE" value = "<?= displayPostToEdit($post,"title")?>" >
                    </div>
                    <div class="form-item">
                        <textarea id="editor" class="field"  name="post-description" placeholder="BODY"><?= displayPostToEdit($post,"body") ?></textarea>
                    </div>
                   <div class="form-item">
                        <input class="field" type="file"  id="post-image" name="post-image"  accept="image/png, image/jpeg">
                    </div>
                    <div class="form-item">    
                        <select class=" field" name="topic" id="topic">
                            <option value="">Choose a topic</option>
                            <?php foreach($topics as $topic): ?>
                                <option value= <?= $topic['id'] ?> ><?= $topic['name'] ?></option>
                            <?php endforeach;?>
                        </select>    
                    </div>
                    
                    <div class="form-item">
                        <input clas="field" name="id" type="hidden" value = <?= displayPostToEdit($post,"id") ?> >
                    </div>
                    <button class="signin-btn" name="edit-post" type="submit">Edit post</button>   
                    
            </form>
        </div>
    </div>
    
    <?php unset($_SESSION['error']) ;?>

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