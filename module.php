<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 

?>

<?php 
/**
 * 设置页面
 */

//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}

//获取文章图片数量
function pic($content){
	if(preg_match_all("/<img.*src=[\"'](.*)[\"']/Ui", $content, $img) && !empty($img[1])){
		echo $imgNum = count($img[1]);
	}else{
		echo "0";
	}
}

//获取附件第一张图片
function getThumbnail($blogid){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
    //die($sql);
    $imgs = $db->query($sql);
    $img_path = "";
    while($row = $db->fetch_array($imgs)){
         $img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
    }
    return $img_path;
}

//格式化內容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('繼續閱讀&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
// 分页函数
function pjax_page($count,$perlogs,$page,$url,$anchor=''){
	$pnums = @ceil($count / $perlogs);
	$page = @min($pnums,$page);
	$prepg=$page-1;
	$nextpg=($page==$pnums ? 0 : $page+1);
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
	if($pnums<=1){
		return false;
	}
	if($prepg){
		$re .="<a class='button big' href=\"$url$prepg$anchor\">上一页</a>";
	}
	if($nextpg){
		$re .="<a class='button big' href=\"$url$nextpg$anchor\">下一页</a>";
	}
	return $re;
}
?>
<?php
//获取文章首张图片 内容用
function getpostimagetop($gid){
$db = MySql::getInstance();
$sql = "SELECT * FROM ".DB_PREFIX."blog WHERE gid=".$gid."";
//die($sql);
$imgs = $db->query($sql);
$img_path = "";
while($row = $db->fetch_array($imgs)){
preg_match('|<img.*src=[\"](.*?)[\"]|', $row['content'], $img);
$rand_img = TEMPLATE_URL."/images/post.jpg";
$imgsrc = !empty($img[0]) ? $img[1] : $rand_img;
    }
    return $imgsrc;
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	<div class="previous">&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a></div>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		
	<?php endif;?>
	<?php if($nextLog):?>
		 <div class="next"><a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;</div>
	<?php endif;?>

<?php }?>
<?php
function index_tag(){global $CACHE;$tag_cache = $CACHE->readCache('tags');
?>
<div class="tags">
    <?php shuffle ($tag_cache);foreach($tag_cache as $value):?>
    <a href="<?php echo Url::tag($value['tagurl']); ?>"   title="<?php echo $value['usenum']; ?>篇文章">
    <?php if(empty($value['tagname'])){ echo "无标签";}else{echo $value['tagname'];}?>
    </a>
    <?php endforeach; ?>
</div>
<?php }?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li class="page_item"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="page_item"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li class="page_item"><a href="<?php echo $value['url']; ?>"><?php echo $value['naviname']; ?></a></li>
	<?php endforeach; ?>
<?php }?>


<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	shuffle($link_cache);$link_cache = array_slice($link_cache,0,99999);
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
    <div class="link-items">
	<?php foreach($link_cache as $value): ?>
	<li class="link-item"><a class="button" href="<?php echo $value['url']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</div>

<?php }?> 
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '<i class="iconfont icon-tags"></i>';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>

<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//widget：搜索
function widget_search($title){ ?>
			<form id="search-form" method="get" name="keyform" action="<?php echo BLOG_URL; ?>index.php" role="search">
                <div>
                    <input class="m-search-input" type="text" name="keyword" placeholder="搜索" required>
                </div>
            </form>
<?php } ?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>

	<?php endif; ?>
	<ol class="commentlist">
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
			<li class="comment even thread-even depth-<?php echo $comment['cid']; ?> parent" id="comment-<?php echo $comment['cid']; ?>">
				<div id="div-comment-<?php echo $comment['cid']; ?>" class="comment-info">
				<div class="comment-author vcard">
				<?php if($isGravatar == 'y'): ?>
			<img alt='' src='<?php echo getGravatar($comment['mail']); ?>' class='avatar avatar-32 photo avatar-default' height='32' width='32' />
			<?php endif; ?>
			<cite class="fn"><?php echo $comment['poster']; ?></cite><span class="says">说道：</span>		</div>
		
		<div class="comment-meta commentmetadata"><?php echo $comment['date']; ?></div>

		<p><?php echo $comment['content']; ?></p>

		<div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div>
				</div>
		<ul class="children"><?php blog_comments_children($comments, $comment['children']);?>

</ul><!-- .children -->
</li><!-- #comment-## -->
	<?php endforeach; ?>
	</ol>
	<div class="navigation"><?php echo $commentPageUrl;?></div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
			<li class="comment byuser comment-author-jinyi bypostauthor odd alt depth-<?php echo $comment['cid']; ?>" id="comment-<?php echo $comment['cid']; ?>">
				<div id="div-comment-<?php echo $comment['cid']; ?>" class="comment-info">
				<div class="comment-author vcard">
				<?php if($isGravatar == 'y'): ?>
			<img alt='' src='<?php echo getGravatar($comment['mail']); ?>' class='avatar avatar-32 photo avatar-default' height='32' width='32' />
			<?php endif; ?>
			<cite class="fn"><?php echo $comment['poster']; ?></cite><span class="says">说道：</span>		</div>
		
		<div class="comment-meta commentmetadata"><?php echo $comment['date']; ?></div>

		<p><?php echo $comment['content']; ?></p>

		<?php if($comment['level'] < 4): ?><div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div><?php endif; ?>
				</div>
		</li><!-- #comment-## -->
	<?php blog_comments_children($comments, $comment['children']); ?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
<div id="comment-place">
<div id="comment-post">
<h3>发表评论</h3>

<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>


<form name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" method="post" id="commentform">
<?php if(ROLE == ROLE_VISITOR): ?>

<p><input name="comname" id="author" onblur="if (this.value =='') this.value='<?php if(empty($ckname)){echo preg_replace('/((?:\d+\.){3})\d+/',"\\1*",getIp());}else{echo $ckname;} ?>'" onclick="this.value=''" value="<?php if(empty($ckname)){echo preg_replace('/((?:\d+\.){3})\d+/',"\\1*",getIp());}else{echo $ckname;} ?>" size="22" tabindex="1" required="required" type="text">
<label for="author"><small>姓名 (必填)</small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $ckmail; ?>" size="22" tabindex="2" aria-required='true' />
<label for="email"><small>电子邮件（不会被公开） (必填)</small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $ckurl; ?>" size="22" tabindex="3" />
<label for="url"><small>站点</small></label></p>
		    <?php else: ?>
		        <p>以<a href="<?php echo BLOG_URL; ?>admin/blogger.php">admin</a>登录。 <a href="./admin/?action=logout">登出 »</a></p>
			<?php endif; ?>
<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
 <?php echo $verifyCode; ?>
<p><input name="submit" type="submit" id="submit" tabindex="5" value="发表评论" />
<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
				<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
</p>

</form>
</div>
</div>
	<!-- #comment-place -->
	<?php endif; ?>
<?php }?>