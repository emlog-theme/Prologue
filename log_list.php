<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

    <div id="wrapper">
        <main id="primary" class="main items post-list" role="main" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/Blog">            
<?php 
if (!empty($logs)):
foreach($logs as $value):
$logdes = blog_tool_purecontent($value['content'], 96);
?>
<?php
	    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
        $imgsrc = !empty($img[1]) ? $img[1][0] : TEMPLATE_URL.'images/post.jpg';?>
			<article class="item" itemscope itemprop="blogPost">
                <header class="entry-header">
                    <a href="<?php echo $value['log_url']; ?>" style="background-image: url(<?php echo $imgsrc; ?>);"></a>
                    <h3 class="entry-title" itemprop="name"><?php echo $value['log_title']; ?></h3>
                </header>
                <p class="entry-summary" itemprop="description"><?php echo $logdes; ?></p>
                <ul class="actions">
                    <li><a href="<?php echo $value['log_url']; ?>" class="button">More</a></li>
                </ul>
            </article>
<?php 
endforeach;
else:
?>
	<li class="nothing">你找到的东西已飞宇宙黑洞去了！</li>
<?php endif;?>
		</main><!-- .main -->
        <div id="pagination"><?php echo pjax_page($lognum,$index_lognum,$page,$pageurl); ?></div>    
<?php include View::getView('footer');?>