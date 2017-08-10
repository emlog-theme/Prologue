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

<?php
function displayRecord(){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	$output = '';
	foreach($record_cache as $value){
		$output .= '<div class="archive-title"><h3>'.$value['record'].'('.$value['lognum'].')</h3>'.displayRecordItem($value['date']).'';
	}
	$output = '<div id="archives-temp">'.$output.'</div>';
	return $output;
}
function displayRecordItem($record){
	if (preg_match("/^([\d]{4})([\d]{2})$/", $record, $match)) {
		$days = getMonthDayNum($match[2], $match[1]);
		$record_stime = emStrtotime($record . '01');
		$record_etime = $record_stime + 3600 * 24 * $days;
	} else {
		$record_stime = emStrtotime($record);
		$record_etime = $record_stime + 3600 * 24;
	}
	$sql = "and date>=$record_stime and date<$record_etime order by top desc ,date desc";
	$result = archiver_db($sql);
	return $result;
}
function archiver_db($condition = ''){
	$DB = MySql::getInstance();
	$sql = "SELECT gid, title, date, views FROM " . DB_PREFIX . "blog WHERE type='blog' and hide='n' $condition";
	$result = $DB->query($sql);
	$output = '';
	while ($row = $DB->fetch_array($result)) {
		$log_url = Url::log($row['gid']);
		$output .= '<div class="brick"><a href="'.$log_url.'"><span class="time"><i class="iconfont">&#xe65f;</i>'.date('Y年m月d日',$row['date']).'</span>'.$row['title'].'<em></em></a></div>';
	}
	$output = empty($output) ? '<span class="ar-circle"></span><div class="arrow-left-ar"></div><div class="brick">暂无文章</div>' : $output;
	$output = '<div class="archives" id="monlist">'.$output.'</div></div>';
	return $output;
}
echo displayRecord();
?>
                </div><!-- .entry-content -->

            </article>

            
<!-- You can start editing here. -->


		</main><!-- .main -->
<?php include View::getView('footer');?>