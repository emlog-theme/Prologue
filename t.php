<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

    <div id="wrapper">
        <main id="primary" class="main items post-content post-single" role="main" itemprop="mainContentOfPage">        

<div id="timeline">
            <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <span id="menu_index_1" name="menu_index_1"></span><h2><?php echo $val['date'];?></h2>
                        <p class="time-p">
                            <?php echo $val['t'].'<br/>'.$img;?>
                        </p>
                    </div>
                </div>
				<?php endforeach;?>
</div>


            

		</main><!-- .main -->
<?php include View::getView('footer');?>