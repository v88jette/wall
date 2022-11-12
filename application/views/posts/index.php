<form action="" method="post" id="default-form" class="hidden" data-target="#">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <textarea name="form[content]"></textarea>
</form>
<div data-action="post" id="post-form" class="post-form" data-target="posts">
    <textarea placeholder="Say something nice"></textarea>
    <button>Post now</button>
</div>
<h3 id="posts">All Posts</h3>
<div id="post-n" class="post">
    <span>Posted by <strong>name</strong> at <strong>date</strong></span>
    <p>Content</p>
</div>
<div id="reply-n" class="reply">
    <span>Posted by <strong>name</strong> at <strong>date</strong></span>
    <p>Content</p>
</div>
<div data-action="reply/post_id" id="reply-form" class="reply-form" data-target="#">
    <textarea placeholder="Say something nice"></textarea>
    <button>Reply</button>
</div>