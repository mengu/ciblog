<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{=T.accepted_language or 'en'}}">
<head>
  <title>Mengu.net</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/style.css" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/github.css" />
  <script src="<?=base_url();?>static/highlight.js"></script>
  <script src="<?=base_url();?>static/highlight.pack.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery.cookie.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
	  $.cookie('page', null);
	  $("#more").click(function() {
		  var page = $.cookie('page') ? $.cookie('page') : 2;
		  var perpage = <?=$perPage;?>;
		  var postcount = <?=$postCount;?>;
		  var limit = (page - 1)*perpage;
		  limit = limit == 0 ? 1 : limit;
		  $.getJSON("<?=base_url();?>posts/more/"+limit,
			function(data){
			$.each(data, function(i,item){
				var result = '<div class="posttitle"><a href="/ciblog/posts/view/'+item.id+'">'+item.title+'</a></div>';
				result += '<div class="postdate">'+item.dateline+'</div>';
				result += '<div class="commentinfo">'+item.commentcount+' Comments</div>';
				result += '<div class="description">'+item.description+'</div>';
				$("#posts").append(result);
          });
		});
		$.cookie('page', parseInt(page)+1); 
	  });
  });
  </script>
  <script>hljs.initHighlightingOnLoad();</script>
  
</head>
<body>

<h2 style="margin: 0; border: 0; font-size:40pt;"><a href="<?=base_url();?>">Mengu.net</a></h2>
<div>mengu's weblog on web programming.</div>
