<?php session_start(); ?>
<!-- Including head -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/head.php'); ?>

<!-- Including topic controller -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/manageTopic.php'); ?>

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

            <h1 class="add-post-title">Manage topics</h1>

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
                            <th>NAME </th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($topics as $topic): ?>
                        <tr>
                            <td><?= $topic['id'] ?> </td>
                            <td><?= $topic['name'] ?></td>
                            <td> <a href=<?= BASE_URL . "/app/admin/topics/editTopic.php?id=".$topic['id']?>><i class="far fa-edit"></i></a> <a href= <?= BASE_URL . "/app/controllers/manageTopic.php?delete-topic&id=".$topic['id']?> ><i class="far fa-trash-alt"></i></a> </td>
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