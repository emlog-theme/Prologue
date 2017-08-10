<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</div><!-- #wrapper -->
</div>
<footer id="footer">
		<p class="copyright">&copy; 2017 <a href="<?php echo BLOG_URL; ?>" target="_blank"><?php echo $blogname; ?>  </a>Theme Prologue By <a target="_blank" rel="nofollow" href="http://www.drlog.pw/">瑾忆</a></p>
</footer>
<a href="javascript:;" id="scrolltop"></a>

<script type='text/javascript' src='<?php echo TEMPLATE_URL; ?>js/main.js'></script>

<?php doAction('index_footer'); ?>
<?php doAction('index_bodys'); ?>
</body>
</html>