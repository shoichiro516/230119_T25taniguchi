<?php
session_start();
require('//Applications//XAMPP//xamppfiles//htdocs//gs_code//PHP05_kadai//dbconnect.php');
if (empty($_REQUEST['id'])) {
	header('Location: submit_comment.php'); exit();
}
// 投稿を取得する
$posts = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');
$posts->execute(array($_REQUEST['id']));
?>

	<p>&laquo;<a href="submit_comment.php">一覧にもどる</a></p>

	<?php
	if ($post = $posts->fetch()):
	?>
				
    <div>
		<img src="//member_picture/<?php echo htmlspecialchars($post['picture'], ENT_QUOTES); ?>" width="48" height="48" alt="<?php echo 	 htmlspecialchars($post['name'], ENT_QUOTES); ?>" />
		<p><?php echo htmlspecialchars($post['message'], ENT_QUOTES);
		?><span class="name">（<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>）</span></p>
		
        <p class="day"><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></p>
	</div>
	
    <?php
	else:
	?>
	
    <p>その投稿は削除されたか、URL間違いです</p>
	<?php
	endif;
	?>
