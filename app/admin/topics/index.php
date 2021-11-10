<?php session_start(); ?>

<!-- Including head -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/head.php'); ?>

<body class="admin-body">

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

            <form class="form-width" method="POST"  action= <?= BASE_URL . "/app/controllers/addTopic.php" ?> >
                
                <h1 class="add-post-title">Add topic</h1>

                    <?php if(checkIfTopicFormError("description") || checkIfTopicFormError("name")): ?>
                        <div class="errors">
                            <p> <?= checkIfTopicFormError("description")  ?> </p>
                            <p> <?= checkIfTopicFormError("topic-name")  ?> </p>
                        </div>
                    <?php endif; ?>
                        
                    <div class="form-item">
                        <input class="field" name="topic-name" type="text" id="topic-name" placeholder="NAME" value = <?= displayOldValuesAddForm("name") ?>>
                    </div>
                    
                    <div class="for-item">
                        <textarea class="field"  name="description" placeholder="DESCRIPTION"><?= displayOldValuesAddForm("description") ?></textarea>
                    </div>
                   
                    
                    <button class="signin-btn" name="add-topic" type="submit">Add topic</button>   
            </form>

        </div>

    </div>
    
    <?php unset($_SESSION['error']) ;?>
    <?php unset($_SESSION['old-addPost-value-form']) ?>

    <!-- Including the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/footer.php'); ?>

</body>