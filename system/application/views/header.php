<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <title><? if($title): echo $title; else: echo "Mengu.net"; endif; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="description" content="<?= $description; ?>" />
  <meta name="keywords" content="<?=$keywords; ?>" />
  <meta name="google-site-verification" content="EYVj8EmuXzJP9X6kgW2cEHHyn3k6r4DTZBNaHf1Jyno" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/libraries.css" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/grids.css" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/style.css" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/github.css" />
  <script type="text/javascript" src="<?=base_url();?>static/highlight.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/highlight.pack.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery.cookie.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery.corner.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery.client.js"></script>
  <script type="text/javascript">
      $(document).ready(function(){
        var ref = document.referrer;
        var match = ref.match(/q=[\w+]+/);
        if (match != null)
        {
            var query = match[0].replace("q=", "");
            var query_strings = query.split("+");
            var query_string = query.replace("+", " ");
            var html = $(".sidebar").html();
            $.each(query_strings, function(index, query_str){
              $(".sidebar a[href*='"+query_str+"']").css({'background':'#F2F5A9', 'color':'#000'});
            });
            $(".sidebar a[href*='"+query_string+"']").css({'background':'#F2F5A9', 'color':'#000'});
        }
        $(".current").corner("tl br 5px");
        $(".box-title").corner("tr tl 5px");
        $(".sidebar").corner("5px");
        /*$('img:not([class="more"])').css({'width': '400px', 'max-width': '400px', 'cursor': 'pointer'}).click(function() { window.open(this.src); });*/
        $('a:not([href^="http://www.mengu.net/"])').each(function(i) {
            if (!$(this).attr('target'))
            {
                $(this).attr('target', '_blank');
            }
        });
        $(".rest").corner("bevel tr br");
        perpage = <?=$perPage;?>;
        postcount = <?=$postCount;?>;
        if (postcount <= perpage)
        {
            $("#more").css('display', 'none');
        }
        $.cookie('page', null);
        $("#more").click(function() {
            var page = $.cookie('page') ? $.cookie('page') : 2;
            var limit = (page - 1)*perpage;
            limit = limit == 0 ? 1 : limit;
            $.getJSON("<?=base_url();?>posts/more/"+limit,
            function(data) {
                $.each(data, function(i,item) {
                    var result = '<div class="post">';
                    result += '<div class="post-title"><a href="<?=base_url();?>post/'+item.slug+'">'+item.title+'</a></div>';
                    var commentText = item.commentcount > 1 ? 'Comments' : 'Comment';
                    result += '<div class="post-info">'+item.dateline+' | <a href="<?=base_url();?>post/'+item.slug+'#comments">'+item.commentcount+' '+commentText+'</a></div>';
				    result += '<div class="post-body">'+item.description+'</div>';
				    result += '<div class="tag-list">Tags: '+item.taglist+'</div>';
                    result += '</div>';
				    $("#posts").append(result);
                });
		    });
		    $.cookie('page', parseInt(page)+1);
	    });
	    $("#searchButton").click(function() {
         if ($("#searchQuery").val().length < 3)
         {
            alert("I'd prefer something with or longer than 3 characters.");
         }
      });
      if ($.client.os == "Windows")
      {
          $(".post").css('font-family', 'Lucida Sans Unicode, sans-serif');
          $(".box-title").css('font-family', 'Lucida Sans Unicode, sans-serif');
      }
      $(".tag").each(function(){
          $(this).attr('onclick', "_gaq.push(['_trackEvent', 'Tag Links', 'Tag', '"+$(this).html()+"']);");
      });
      $(".recent-post a").each(function(){
          $(this).attr('onclick', "_gaq.push(['_trackEvent', 'Recent Posts', 'Recent Post', '"+$(this).html()+"']);");
      });
    });
    </script>
  <script type="text/javascript">hljs.initHighlightingOnLoad();</script>
</head>
<body>

<div class="line">

    <div class="unit size1of1 lastUnit">

        <div class="header">
            <div class="logo"><a href="http://www.mengu.net/">mengu.net</a></div>
            <div class="description">mengu on web programming.</div>
        </div>

        <div class="navigation">
            <ul class="unit size1of2">
                <li><a <?php if ($current == 'home'): ?>class="current"<? endif; ?> href="<?=base_url();?>">Home</a></li>
                <li><a <?php if ($current == 'about'): ?>class="current"<? endif; ?> href="<?=base_url();?>pages/about">About</a></li>
                <li><a <?php if ($current == 'projects'): ?>class="current"<? endif; ?> href="<?=base_url();?>pages/projects">Projects</a></li>
                <li><a <?php if ($current == 'services'): ?>class="current"<? endif; ?> href="<?=base_url();?>pages/services">Services</a></li>
                <li><a <?php if ($current == 'contact'): ?>class="current"<? endif; ?> href="<?=base_url();?>pages/contact">Contact</a></li>
            </ul>
            <div style="float: right;">
                <a href="http://www.mengu.net/feed"><img src="<?=base_url();?>static/subscribe.png" style="outline: none;" border="0" /></a>
            </div>
            <div style="clear: right">&nbsp;</div>
        </div>
