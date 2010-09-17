<?= $header; ?>

<div class="page">
    <div class="line">
        <div class="unit size2of3">

            <div id="posts">
            <? if (count($post) > 0): ?>
                <div class="post">
                    <? if (($post[0]->published) || ($post[0]->published == false && $this->session->userdata('isAdmin'))): ?>
                    <h1 class="post-title"><?=$post[0]->title;?></h1>
                    <div class="post-info"><?=$post[0]->dateline;?> | <a href="<?=base_url();?>post/<?=$post[0]->slug;?>#comments"><?=$post[0]->commentcount;?> Comment<? if($post[0]->commentcount > 1): ?>s<? endif;?></a></div>
                    <div class="post-body"><?=markdown($post[0]->body);?></div>
                    <div class="tag-list">Tags: <?=Post::getTagList($post[0]->id);?></div>
                    <div class="comments">
                    <h3 id="comments">Comments</h3>
                    <? if (count($comments) > 0): ?>
                    <? $c = 1; ?>
                    <? foreach($comments AS $comment): ?>
                    <div id="comment-<?=$c;?>" class="size1of2">
                        <div class="comment-info"><? if ($comment->website): ?><a href="<?=$comment->website;?>"><?= $comment->name; ?></a><? else: ?><?= $comment->name; ?><? endif;?> said on <?= date("d/m/Y H:i A", $comment->dateline); ?></div>
                        <div class="comment-box"><?= markdown($comment->body);?></div>
                    </div>
                    <hr align="left" style="margin-left: 1%;" size="1" width="400" />
                    <? $c++; ?>
                    <? endforeach; ?>
                    <? else: ?>
                    <div>No comments made for this post.</div>
                    <? endif; ?>

                    <h3>Leave a Response</h3>
                    <div class="comment-form">
                    No HTML allowed. You can use <a href="http://en.wikipedia.org/wiki/Markdown">markdown</a>.
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
                    <? if (!$this->session->userdata('isAdmin')): ?>
                    <div>Name*:</div>
                    <div><input class="input" type="text" name="name" /></div>
                    <div>E-Mail* (not published):</div>
                    <div><input class="input" type="text" name="email" /></div>
                    <div>Web site:</div>
                    <div><input class="input" type="text" name="website" /></div>
                    <? endif; ?>
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
