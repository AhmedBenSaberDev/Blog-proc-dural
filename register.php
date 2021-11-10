
<?php session_start();?>

<!-- Including users controller -->
<?php include(dirname(__FILE__) . '/app/controllers/register.php'); ?>

<!-- Including head -->
<?php include(dirname(__FILE__) . '/app/includes/head.php'); ?>


<body>
    
    <!-- Include the header -->
    <?php include(dirname(__FILE__) . '/app/includes/header.php'); ?>

    <section>
        <div class="form">

            <!-- Sign up / Registration Form -->

            <div class="register">
                <h1>Join Now</h1>
                <p class="accounta">Already have an account ? <a class="ancer" href=<?= BASE_URL . "/login.php" ?>>Sign In</a></p>

                <form action="" method="post">

                    <div class="form-item">
                        <div class="flex">
                            <label class="username-error" for="input">Username</label>
                            <span class="form-errors"> <?= displayError($errors,"username") ?> </span>
                        </div>
                        <input type="text" class="field <?= checkError($errors,"username") ?>" name="username" placeholder="Username"  value=<?php if(checkIfSubmit()):?> <?=displayLastFormValue("username")?>  <?php endif;?> >
                    </div>

                    <div class="form-item">
                        <div class="flex">
                            <label for="input">email address</label>
                            <span class="form-errors"> <?= displayError($errors,"email") ?> </span>
                        </div>
                        <input type="email" class="field <?= checkError($errors,"email") ?>" name="email" placeholder="someone@someone.com" value=<?php if(checkIfSubmit()):?> <?=displayLastFormValue("email")?>  <?php endif;?> >
                        
                    </div>
                    <div class="form-item">
                        <div class="flex">
                            <label for="input">password</label>
                            <span class="form-errors"> <?= displayError($errors,"password") ?> </span>
                        </div>
                        <input type="password" id="password" class="field <?= checkError($errors,"password") ?>" name="password" placeholder="password" value >
                    </div>
                    <div class="form-item">
                        <label for="input">confirm password</label>
                        <input type="password" id="confirm-password" class="field <?= checkError($errors,"password") ?>" name="confirm-password" placeholder="confirm password" value >
                    </div>
                    <div class="form-item">
                        <button type="submit" name="register-btn" class="reg-btn">Sign up</button>
                    </div>

                </form>
            </div>
                 
        </div>

    </section>
    
    <?php $errors = []; ?>

    <?php unset($_SESSION['lastFormValue']);?>

    <!-- Including the footer -->
    <?php include(dirname(__FILE__) . '/app/includes/footer.php'); ?>

</body>

</html>