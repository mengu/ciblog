$(document).ready(function(){
    $(".current").corner("tl br 5px");
    $(".box-title").corner("tr tl 5px");
    $(".sidebar").corner("5px");
    $('img:not([class="more"])').css({'width': '400px', 'max-width': '400px', 'cursor': 'pointer'}).click(function() { window.open(this.src); });
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
});

