<?php if (!$reply['status']){ ?>
    <p class="error reply-error"><?= $reply['message'] ?></p>
<?php } else{ ?>
    <div id="reply-<?= $reply['result']['id'] ?>" class="reply">
        <span>Posted by <strong><?= $reply['result']['author'] ?></strong> at <strong> <?= $reply['result']['created_at'] ?></strong></span>
        <p><?= $reply['result']['content'] ?></p>
    </div>
<?php } ?>