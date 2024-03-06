<?php

function display_error($message)
{
    ?>

    <div class="alert alert-danger"
         role="alert">
        <?php echo $message ?>
    </div>

    <?php
}