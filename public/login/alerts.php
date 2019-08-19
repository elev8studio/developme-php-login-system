<!-- display error messages, if any exist -->
<?php if ($error) { ?>
    <div class="alert alert-danger" role="alert">
    <?php foreach($error_messages AS $error) {
        echo $error;
    } ?>
    </div>
<?php }

// display success messages, if any exist
if ($success) { ?>
    <div class="alert alert-success" role="alert">
    <?php foreach($success_messages AS $success) {
        echo $success;
    } ?>
    </div>
<?php } ?>
