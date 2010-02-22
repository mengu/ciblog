<?php

/*mysql_connect('localhost', 'root', 's');
mysql_select_db('web2py');

$posts = mysql_query("SELECT posts.id, posts.title, posts.slug, posts.body, posts.dateline, posts.user, GROUP_CONCAT(categories.id) AS categories FROM posts, categories, relations WHERE (relations.post=posts.id AND relations.category=categories.id) GROUP BY relations.post;
");
echo mysql_error();

while ($post = mysql_fetch_assoc($posts))
{
	echo $post['title'] . "<br />";
		/*foreach (explode(",", $post['categories']) AS $categoryid)
		{
				print_r(mysql_fetch_assoc(mysql_query("SELECT categories.id, categories.title FROM categories WHERE categories.id = $categoryid")));
		}*/
//}
echo getcwd();



?>
