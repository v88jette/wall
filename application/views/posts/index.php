<form action="" method="post" id="default-form" class="hidden" data-target="#">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <textarea name="form[content]"></textarea>
</form>
<div data-action="post" id="post-form" class="post-form" data-target="posts">
    <textarea placeholder="Say something nice"></textarea>
    <button>Post now</button>
</div>
<h3 id="posts">All Posts</h3>
<?php if (!$posts['status']){ 
    $posts['result'] = [];
}

foreach($posts['result'] as $post){ ?>
<div id="post-<?= $post['id'] ?>" class="post">
    <span>Posted by <strong><?= $post['author'] ?></strong> at <strong><?= $post['created_at'] ?></strong></span>
    <p><?= $post['content'] ?></p>
</div>
<?php   if ($post['replies'] === null){ 
            $replies = []; 
        } else{ 
            $replies = explode(',', $post['replies']);
        } 
      
        foreach($replies as $reply){
            $reply = explode('~~~', $reply); ?>
        <div id="reply-<?= $reply[3] ?>" class="reply">
            <span>Posted by <strong><?= $reply[0] ?></strong> at <strong><?= $reply[2] ?></strong></span>
            <p><?= $reply[1] ?></p>
        </div>
        <?php } ?>
<div data-action="reply/<?= $post['id'] ?>" id="reply-form" class="reply-form" data-target="reply-form-<?= $post['id'] ?>">
    <textarea placeholder="Say something nice"></textarea>
    <button>Reply</button>
</div>
<?php } ?>