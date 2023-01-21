<?php
session_start();
require('//Applications//XAMPP//xamppfiles//htdocs//gs_code//PHP05_kadai//dbconnect.php');
if (isset($_SESSION['id'])) {
	$id = $_REQUEST['id'];
	// 投稿を検査する
	$messages = $db->prepare('SELECT * FROM posts WHERE id=?');
	$messages->execute(array($id));
	$message = $messages->fetch();
	if ($message['member_id'] == $_SESSION['id']) {
		// 削除する
		$del = $db->prepare('DELETE FROM posts WHERE id=?');
		$del->execute(array($id));
	}
}
header('Location: submit_comment.php'); exit();
?>
