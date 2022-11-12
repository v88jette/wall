<?php if (!$reply['status']){ ?>
    <p class="error reply-error"><?= $reply['message'] ?></p>
<?php } else{ ?>
    <div id="reply-<?= ?>" class="reply">
        <span>Posted by <strong><?= 'name' ?></strong> at <strong> <?= 'name' ?></strong></span>
        <p><?= 'content' ?></p>
    </div>
<?php } ?>