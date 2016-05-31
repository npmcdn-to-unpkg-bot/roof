<?php 

	$db = new mysqli(
		env("FORUM_DB_HOST"),
		env("FORUM_DB_DATABASE"),
		env("FORUM_DB_PASSWORD"),
		env("FORUM_DB_USERNAME")
	);
	
	mb_internal_encoding("UTF-8");
	$db->set_charset("utf8");

	$query_posts = $db->query('SELECT * FROM phpbb_posts ORDER BY post_time DESC LIMIT 4');

	while ($post = $query_posts->fetch_assoc()){
		$post['post_time'] = date('d.m.Y', $post['post_time']);
		$post['post_text'] = mb_substr(
			preg_replace(
				'|[[\/\!]*?[^\[\]]*?]|si',
				'',
				strip_tags( $post['post_text']) ),
			0,
			150
		);
		$query_users = $db->query('SELECT * FROM phpbb_users WHERE user_id='.$post['poster_id']);
		$post['user'] = $query_users->fetch_assoc();
		$posts[] = $post;
	}

?>

<div class="forum-message">
	<div class="title">ПОСЛЕДНЕЕ НА ФОРУМЕ</div>
	<?php foreach ($posts as $post): ?>
		<div class="forum-message__item">
			<img src="<?php if ($post['user']['user_avatar']): ?>http://forum.roofers.com.ua/download/file.php?avatar=<?php echo $post['user']['user_avatar'] ?><?php else: ?>http://roofers.com.ua/img/no-name-user.jpg<?php endif ?>" alt="" class="forum-message__avatar" width="35px">
			<a target="blank" href="http://forum.roofers.com.ua/memberlist.php?mode=viewprofile&u=<?php echo $post['poster_id'] ?>" class="forum-message__name"><?php echo $post['user']['username'] ?></a><span class="forum-message_post-date"><?php echo $post['post_time'] ?></span>
			<div class="forum-message__text"><?php echo $post['post_text'] ?></div>
			<a target="blank" href="http://forum.roofers.com.ua/viewtopic.php?f=<?php echo $post['forum_id'] ?>&t=<?php echo $post['topic_id'] ?>" class="forum-message__theme"><?php echo $post['post_subject'] ?></a>
		</div>
	<?php endforeach ?>
</div>