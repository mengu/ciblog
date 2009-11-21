<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{=T.accepted_language or 'en'}}">
<head>
  <title>Mengu.net </title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
    $('a:not([href^="http://www.mengu.net/demo"])').each(function(i) {
        if (!$(this).attr('target') && $(this).attr('href') != "#")
        {
            $(this).attr('target', '_blank');
        }
    });
    $(".description a").corner("5px").css('padding', '3px');
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
				$("#posts").append(result);
            });
		});
		$.cookie('page', parseInt(page)+1);
	});
  });
  function moderateComment(id, operation)
  {
      $.post("<?=base_url();?>comments/"+operation, { id: id },
        function(data){
            $("#uc_"+id).remove();
        });
      return false;
  }
  </script>
  <script>hljs.initHighlightingOnLoad();</script>

</head>
<body>

<h2 style="margin: 0; margin-left: 5px; border: 0; font-size:60px; font-weight: bold;"><a href="<?=base_url();?>">Mengu.net</a></h2>
<div style="margin-left: 5px;">mengu's weblog on web programming.</div>

