<?php session_start(); ?>

<!-- Including head -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/head.php'); ?>

<!-- Including edit topic controller -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/editTopic.php'); ?>

<body class="admin-body">

    <!-- Including the header -->
    <!-- Including the header -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/header.php'); ?>
    <?php redirectIfNotAdmin(); ?>
    <div class="admin-wrapper">

        <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/adminSideBar.php'); ?>

        <div class="container">
            <div class="manage-topic-links">
                <a href=<?= BASE_URL . "/app/admin/topics/index.php" ?>>Add topic</a>
                <a href=<?= BASE_URL . "/app/admin/topics/manage.php" ?>>Manage topic</a>
            </div>

            <form method="POST" class="form-width" action= <?= BASE_URL . "/app/controllers/editTopic.php" ?> >
                
                <h1 class="add-post-title">Edit topic</h1>
                    <?php if(isset($_SESSION['error'])):?>
                    <div class="errors">
                        <p> <?= checkIfTopicFormError("description")  ?> </p>
                        <p> <?= checkIfTopicFormError("topic-name")  ?> </p>
                    </div>
                    <?php endif; ?>
                    
                    <div class="form-field">
                        <input class="field" name="topic-name" type="text" id="topic-name" placeholder="NAME" value = '<?= displayTopicToEdit($topic,"name")?>'>
                    </div>
                    <div class="form-field">
                        <textarea class="field"  name="description" placeholder="DESCRIPTION" ><?= displayTopicToEdit($topic,"description") ?> </textarea>
                    </div>
                    <div class="form-field">
                        <input class="field" name="id" type="hidden" value = <?= displayTopicToEdit($topic,"id") ?> >
                    </div>
                    
                    <button class="signin-btn" name="edit-topic-form" type="submit">Edit topic</button>          
                    
            </form>
        </div>
    </div>
    
    <?php unset($_SESSION['error']) ;?>

    <!-- Including the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/footer.php'); ?>


</body>