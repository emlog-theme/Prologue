<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
	'topimg' => array(
		'type' => 'image',
		'name' => '顶部背景图',
		'values' => array(
            TEMPLATE_URL . 'images/post.jpg',
        ),
            ),	

	'home_strong_1' => array(
		'type' => 'text',
		'name' => '首页一句话',
		'description' => '',
		'default' => '突如其来的装逼让我无法呼吸',
    ),
	
);