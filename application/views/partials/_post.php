<?php if (!$post['status']){ ?>
    <p class="error reply-error"><?= $post['message'] ?></p>
<?php } else{ ?>
    <div id="post-<?= $post['result']['id'] ?>" class="post">
        <span>Posted by <strong><?= $post['result']['author'] ?></strong> at <strong> <?= $post['result']['created_at'] ?></strong></span>
        <p><?= $post['result']['content'] ?></p>
    </div>
    <div data-action="reply/<?= $post['result']['id'] ?>" id="reply-form" class="reply-form" data-target="reply-form-<?= $post['result']['id'] ?>">
            <textarea placeholder="Say something nice"></textarea>
            <button>Reply</button>
        </div>
<?php } ?>