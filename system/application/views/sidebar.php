<div id="sidebar">
	<div class="boxtitle" style="margin: 0;">Search The Blog</div>
	<div class="boxcontent">
	<?= form_open('posts/search');?>
	<input type="text" name="query" /> <input type="submit" value="Search" />
	</form>
	</div>

	<div class="boxtitle">About</div>
	<div class="boxcontent">
	    <div>Mengu, is a web developer with <a href="http://www.rubyonrails.org">Ruby on Rails</a>,
	    <a href="http://www.djangoproject.com">Django</a>, <a href="http://www.web2py.com">web2py</a>,
	    <a href="http://www.codeigniter.com">CodeIgniter</a> and <a href="http://www.jquery.com">jQuery</a>
	    in his tool box. Available for any kind of web development jobs.
	    </div>
	</div>

	<div class="boxtitle">Tag List</div>
	<div class="boxcontent">
		<div><?=$allTags;?></div>
	</div>

	<div class="boxtitle">Recent Posts</div>
	<div class="boxcontent">
	<? foreach ($recentPosts AS $recentPost): ?>
		<div><a href="<?=base_url();?>post/<?=$recentPost->slug;?>"><?=$recentPost->title;?></a></div>
	<? endforeach; ?>
	</div>

	<div class="boxtitle">Recent Comments</div>
	<div class="boxcontent">
	<? foreach ($recentComments AS $recentComment): ?>
		<div>On <a href="<?=base_url();?>post/<?=$recentComment->slug;?>"><?=$recentComment->title;?></a> by <?=$recentComment->name;?></div>
	<? endforeach; ?>
	</div>

	<div class="boxtitle">Recommended Links</div>
	<div class="boxcontent">
		<div><a href="http://www.ahmetkakici.com">Ahmet Kakıcı</a></div>
		<div><a href="http://www.codeigniter.gen.tr">CodeIgniter Türkiye</a></div>
		<div><a href="http://www.web2py.com">web2py</a></div>
		<div><a href="http://www.grails.org">Grails</a></div>
		<div><a href="http://www.rubyonrails.com">Ruby on Rails</a></div>
		<div><a href="http://www.djangoproject">Django</a></div>
		<div><a href="http://www.codeigniter.com">CodeIgniter</a></div>
		<div><a href="http://www.jquery.com">jQuery</a></div>
	</div>

	<div class="boxtitle">Archives</div>
	<div class="boxcontent">
	<? foreach ($blogArchives AS $blogArchive): ?>
	    <div><a href="<?=base_url();?>archives/view/<?=$blogArchive['link'];?>"><?=$blogArchive['display']?></a></div>
	<? endforeach; ?>
	</div>

	<? if ($this->session->userdata('isAdmin')): ?>
	<div class="boxtitle">Administration</div>
	<div class="boxcontent">
		<div><a href="<?=base_url();?>admin">Admin Panel</a></div>
		<div><a href="<?=base_url();?>users/logout">Logout</a></div>
	</div>
	<? endif; ?>

	<? if ($this->session->userdata('isAdmin')): ?>
	<div class="boxtitle">Comment Moderation</div>
	<div class="boxcontent">
	  <? foreach ($unapprovedComments AS $unapprovedComment): ?>
	    <div class="uc" id="uc_<?=$unapprovedComment->id;?>"><?= substr($unapprovedComment->body, 0, 100); ?> by <?= $unapprovedComment->name; ?>
	    <div>
	      <a href="#" onclick="moderateComment(<?=$unapprovedComment->id;?>, 'approve'); return false;">Approve</a> -
	      <a href="#" onclick="moderateComment(<?=$unapprovedComment->id;?>, 'delete'); return false;">Delete</a>
	    </div>
	    </div>
	  <? endforeach; ?>
	</div>
	<? endif; ?>

  </div>
