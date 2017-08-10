<?php
/*
Template Name:Prologue
Description:瑾忆博客
Version:1.1
Author:瑾忆
Author Url:http://www.drlog.pw
Sidebar Amount:0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}

require_once View::getView('module');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $site_title; ?> - <?php echo $site_key; ?> - <?php echo $site_description; ?></title>
    <meta name="keywords" content="<?php echo $site_key; ?>" />
    <meta name="description" content="<?php echo $site_description; ?>" />
	<meta name="generator" content="emlog" />
    <meta name="HandheldFriendly" content="True" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style.css">
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.pjax.min.js"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>
<body>
<div class="pjax">
<header id="header" class="alt">
<?php if($logid): ?>
        <div class="gohome">
            <a href="<?php echo BLOG_URL; ?>">←</a>
        </div>
                <div class="inner"><h1><?php echo $log_title; ?></h1><p><?php echo gmdate('Y-n-j', $date);?> / <?php echo $views; ?> 次阅读</p></div>
<?php elseif($tws):?>
       <div class="gohome">
            <a href="javascript:history.go( -1 );">←</a>
        </div>
                <div class="inner"><h1>微语</h1><p></p></div>
<?php elseif($pageurl == Url::logPage()): ?>
<div class="inner"><a href="<?php echo BLOG_URL; ?>"><h1><?php echo $blogname; ?></h1></a><p><?php echo _g('home_strong_1');?></p></div>
<?php elseif($keyword): ?>
       <div class="gohome">
            <a href="javascript:history.go( -1 );">←</a>
        </div>
<div class="inner"><a href="<?php echo BLOG_URL; ?>"><h1><?php echo $blogname; ?></h1></a><p>搜索结果</p></div>
<?php elseif($sortName):?>
        <div class="gohome">
            <a href="javascript:history.go( -1 );">←</a>
        </div>
                <div class="inner"><h1><?php echo $site_title; ?></h1></div>
<?php endif; ?>

<div class="post-bg" style="background-image: url(<?php if($logid): ?><?php echo getpostimagetop($logid); ?><?php else:?><?php echo _g('topimg');?><?php endif; ?>);"></div>
<?php if($pageurl == Url::logPage()||$keyword||$sortName): ?><div class="homeNav">
            <nav>

			<ul><?php blog_navi();?>
			</ul>

<?php echo widget_search($title); ?>
            </nav>
        </div><?php endif; ?>
            </header><!-- #header -->