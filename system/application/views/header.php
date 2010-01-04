<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{=T.accepted_language or 'en'}}">
<head>
  <title>Mengu.net </title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/reset.css" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/960.css" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/text.css" />
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>static/style.css" />
  <link rel="stylesheet" title="GitHub" type="text/css" href="<?=base_url();?>static/github.css" />
  <script src="<?=base_url();?>static/highlight.js"></script>
  <script src="<?=base_url();?>static/highlight.pack.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery.cookie.js"></script>
  <script type="text/javascript" src="<?=base_url();?>static/jquery.corner.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $('img').css({'width': '400px', 'max-width': '400px', 'cursor': 'pointer'}).click(function() { window.open(this.src); });
    $('a:not([href^="http://www.mengu.net/"])').each(function(i) {
        if (!$(this).attr('target') && $(this).attr('href') != "#")
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
                var result = '<div class="posttitle"><a href="<?=base_url();?>post/'+item.slug+'">'+item.title+'</a></div>';
                result += '<div class="postdate">'+item.dateline+'</div>';
				var commentText = item.commentcount > 1 ? 'Comments' : 'Comment';
				result += '<div class="commentinfo"><a href="<?=base_url();?>post/'+item.slug+'#comments">'+item.commentcount+' '+commentText+'</a></div>';
				result += '<div class="description">'+item.description+'</div>';
				result += '<div class="taglist">Tags: '+item.taglist+'</div>';
				result += '<div class="rest"><a href="<?=base_url();?>post/'+item.slug+'">Read the rest..</a></div>';
				$("#posts").append(result);
            });
		});
		$.cookie('page', parseInt(page)+1);
	});
  });
  $("#searchButton").click(function() {
     if ($("#searchQuery").val().length < 3)
     {
        alert("I'd prefer something with or longer than 3 characters.");
     }
  });
  </script>
  <script>hljs.initHighlightingOnLoad();</script>

</head>
<body>


<div id="header" class="container_15" style="margin:0; padding:0;">
<h1 style="text-transform: uppercase; font-size: 4.5em; font-weight: bold;"><a href="<?=base_url();?>" style="text-decoration: none; color: #000;">Mengu.net</a></h1>
    <div>mengu's weblog on web programming.</div>
</div>

<div id="content" class="container_15">
