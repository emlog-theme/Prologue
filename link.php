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
<?php widget_link($title); ?>
                </div><!-- .entry-content -->

            </article>

            

   
		</main><!-- .main -->
<?php include View::getView('footer');?>