<?php 
/**
 * 新建页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

    <div id="wrapper">
        <main id="primary" class="main items post-content post-single" role="main" itemprop="mainContentOfPage">        
                        <article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-uncategorized" itemscope itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
                 <div class="entry-content" itemprop="mainEntity">
<?php echo $log_content; ?>
                </div><!-- .entry-content -->

            </article>

            
<!-- You can start editing here. -->

<h3 id="comments">
<?php if(empty($comnum)): ?>
	既然没有吐槽，那就赶紧抢沙发吧！
<?php else: ?>
	"<?php echo $comnum;?>"则回应给&#8220;<?php echo $log_title;?>&#8221;
<?php endif; ?>
</h3>
	<?php 
	blog_comments($comments);
	blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); 
	?>
   
		</main><!-- .main -->
<?php include View::getView('footer');?>