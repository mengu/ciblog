<div id="sidebar">
	<div class="boxtitle" style="margin: 0;">Search The Blog</div>
	<div class="boxcontent">
	<?= form_open('posts/search');?>
	<input type="text" name="query" /> <input type="submit" value="Search" />
	</form>
	</div>
	
	<div class="boxtitle">Recent Posts</div>
	<div class="boxcontent">
	<? foreach ($recentPosts AS $recentPost): ?>
		<div><a href="<?=base_url();?>posts/view/<?=$recentPost->id;?>"><?=$recentPost->title;?></a></div>
	<? endforeach; ?>
	</div>
	
	<div class="boxtitle">Recent Comments</div>
	<div class="boxcontent">
	<? foreach ($recentComments AS $recentComment): ?>
		<div>On <a href="<?=base_url();?>posts/view/<?=$recentComment->postid;?>"><?=$recentComment->title;?></a> by <?=$recentComment->name;?></div>
	<? endforeach; ?>
	</div>
	
  </div>
