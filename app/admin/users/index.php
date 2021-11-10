<?php session_start(); ?>

<!-- Including head -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/head.php'); ?>

<!-- Including users controller -->
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/controllers/users.php'); ?>

<body class="admin-body">

    <!-- Including the header -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/header.php'); ?>
    <?php redirectIfNotAdmin(); ?>
    
    <div class="admin-wrapper">

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/adminSideBar.php'); ?>

        <div class="container">

            <h1 class="add-post-title">Manage Users</h1>

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
                            <th>Username </th>
                            <th>Admin</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($users)):?>
                         
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?= $user['id'] ?> </td>
                                <td><?= $user['username'] ?></td>
                                <td>
                                    <?php if($user['admin']): ?>
                                        <?= "1" ?>
                                    <?php else: ?>
                                        <?= "0" ?>
                                    <?php endif; ?>
                                </td>
                                <td> 
                                    <a class="publish" href=<?= BASE_URL . "/app/controllers/manageUsers.php?switch-admin&id=".$user['id']?>>
                                        <?php if($user['admin']): ?>
                                            <?= "Unset Admin" ?>
                                        <?php else: ?>
                                            <?= "Set As Admin" ?>
                                        <?php endif; ?> 
                                    </a> 
                                    <a  <?= BASE_URL . "/app/controllers/manageUsers.php?delete-user&id=".$user['id']?> ><i class="far fa-trash-alt"></i></a> 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif;?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>

    <?php unset($_SESSION['success']); ?>
    <!-- Including the footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/Blog-native/app/includes/footer.php'); ?>

    <

</body>