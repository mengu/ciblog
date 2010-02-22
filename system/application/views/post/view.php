<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">

            <div id="posts">
            <? if (count($post) > 0): ?>
                <div class="post">
                    <? if ($post[0]->published): ?>
                    <h1 class="post-title"><?=$post[0]->title;?></h1>
                    <div class="post-info"><?=$post[0]->dateline;?> | <a href="<?=base_url();?>post/<?=$post[0]->slug;?>#comments"><?= $post[0]->commentcount; ?> Comment<? if(count($post[0]->commentcount) > 1): ?>s<? endif;?></a></div>
                    <div class="post-body"><?=markdown($post[0]->body);?></div>
                    <div class="tag-list">Tags: <?=Post::getTagList($post[0]->id);?></div>
                    <div class="comments">
                    <h3>Comments</h3>
                    <? if (count($comments) > 0): ?>
                    <? $c = 0; ?>
                    <? foreach($comments AS $comment): ?>
                    <div class="comment-box"><?= $comment->body;?></div>
                    <div class="comment-info">Posted by <? if ($comment->website): ?><a href="<?=$comment->website;?>"><?= $comment->name; ?></a><? else: ?><?= $comment->name; ?><? endif;?> on <?= date("d/m/Y H:i A", $comment->dateline); ?></div>
                    <hr align="left" style="margin-left: 2%;" size="1" width="500" />
                    <? endforeach; ?>
                    <? else: ?>
                    <div>No comments made for this post.</div>
                    <? endif; ?>

                    <h3>Leave a Response</h3>
                    <div class="comment-form">
                    <?php
                        echo form_open('/comments/create');
                        echo form_hidden('postid', $post[0]->id);
                    ?>
                    <? if ($this->session->flashdata('commentsaved')): ?>
                    <p><?= $this->session->flashdata('commentsaved'); ?></p>
                    <? endif; ?>
                    <? if ($error): ?>
                    <p><?= $error;?></p>
                    <? endif; ?>
                    <div>Name*:</div>
                    <div><input class="input" type="text" name="name" /></div>
                    <div>E-Mail* (not published):</div>
                    <div><input class="input" type="text" name="email" /></div>
                    <div>Web site:</div>
                    <div><input class="input" type="text" name="website" /></div>
                    <div>Response:</div>
                    <div><textarea name="body"></textarea></div>
                    <div><input type="submit" value="Submit Response" /></div>
                    </form>
                    </div>
                    </div>
                    <? else: ?>
                    <div class="posttitle">Sorry, couldn't find this post.</div>
                    <? endif; ?>
                </div>
            <? else: ?>
                <div class="post">
                <div class="posttitle">Sorry, couldn't find this post.</div>
                </div>
            <? endif; ?>
            </div>
        </div>
<?= $sidebar; ?>
    </div>
</div>

<?= $footer; ?>
