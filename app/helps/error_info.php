
<?php if(count($error_message) > 0) : ?>
    <?php foreach($error_message as $error) : ?>
        <li class="text-danger p-3"><?= $error?></li>
    <?php endforeach; ?>
<?php endif; ?>    


