<?php if (!defined('THINK_PATH')) exit(); switch($addons_config["editor_type"]): case "1": ?>
		<input type="hidden" name="parse" value="0">
		<script type="text/javascript">
			$('textarea[name="<?php echo ($addons_data["name"]); ?>"]').height('<?php echo ($addons_config["editor_height"]); ?>');
		</script><?php break;?>
	<?php case "2": ?>
		<input type="hidden" name="parse" value="0">
		<?php if(($addons_config["editor_wysiwyg"]) == "1"): ?><link rel="stylesheet" href="/Public/static/kindeditor/default/default.css" />
			<script charset="utf-8" src="/Public/static/kindeditor/kindeditor-min.js"></script>
			<script charset="utf-8" src="/Public/static/kindeditor/zh_CN.js"></script>
			<script type="text/javascript">
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="<?php echo ($addons_data["name"]); ?>"]', {
						allowFileManager : false,
						themesPath: K.basePath,
						width: '100%',
						height: '<?php echo ($addons_config["editor_height"]); ?>',
						resizeType: <?php if(($addons_config["editor_resize_type"]) == "1"): ?>1<?php else: ?>0<?php endif; ?>,
						pasteType : 2,
						urlType : 'absolute',
						fileManagerJson : '<?php echo U('fileManagerJson');?>',
						//uploadJson : '<?php echo U('uploadJson');?>' }
						uploadJson : '<?php echo addons_url("EditorForAdmin://Upload/ke_upimg");?>'
					});
				});

				$(function(){
					//传统表单提交同步
					$('textarea[name="<?php echo ($addons_data["name"]); ?>"]').closest('form').submit(function(){
						editor.sync();
					});
					//ajax提交之前同步
					$('button[type="submit"],#submit,.ajax-post').click(function(){
						editor.sync();
					});
				})
			</script>

		<?php else: ?>
			<script type="text/javascript" charset="utf-8" src="/Public/static/ueditor/ueditor.config.js"></script>
			<script type="text/javascript" charset="utf-8" src="/Public/static/ueditor/ueditor.all.js"></script>
			<script type="text/javascript" charset="utf-8" src="/Public/static/ueditor/lang/zh-cn/zh-cn.js"></script>
			<script type="text/javascript">
				$('textarea[name="<?php echo ($addons_data["name"]); ?>"]').attr('id', 'editor_id_<?php echo ($addons_data["name"]); ?>');
				window.UEDITOR_HOME_URL = "/Public/static/ueditor";
				window.UEDITOR_CONFIG.initialFrameHeight = parseInt('<?php echo ($addons_config["editor_height"]); ?>');
				window.UEDITOR_CONFIG.scaleEnabled = <?php if(($addons_config["editor_resize_type"]) == "1"): ?>true<?php else: ?>false<?php endif; ?>;
				window.UEDITOR_CONFIG.imageUrl = '<?php echo addons_url("EditorForAdmin://Upload/ue_upimg");?>';
				window.UEDITOR_CONFIG.imagePath = '';
				window.UEDITOR_CONFIG.imageFieldName = 'imgFile';
				UE.getEditor('editor_id_<?php echo ($addons_data["name"]); ?>');
			</script><?php endif; break;?>
	<?php case "3": ?>
		<script type="text/javascript" src="/Public/static/jquery-migrate-1.2.1.min.js"></script>
		<script charset="utf-8" src="/Public/static/xheditor/xheditor-1.2.1.min.js"></script>
		<script charset="utf-8" src="/Public/static/xheditor/xheditor_lang/zh-cn.js"></script>
		<script type="text/javascript" src="/Public/static/xheditor/xheditor_plugins/ubb.js"></script>
		<script type="text/javascript">
		var submitForm = function (){
			$('textarea[name="<?php echo ($addons_data["name"]); ?>"]').closest('form').submit();
		}
		$('textarea[name="<?php echo ($addons_data["name"]); ?>"]').attr('id', 'editor_id_<?php echo ($addons_data["name"]); ?>')
		$('#editor_id_<?php echo ($addons_data["name"]); ?>').xheditor({
			tools:'full',
			showBlocktag:false,
			forcePtag:false,
			beforeSetSource:ubb2html,
			beforeGetSource:html2ubb,
			shortcuts:{'ctrl+enter':submitForm},
			'height':'<?php echo ($addons_config["editor_height"]); ?>',
			'width' :'100%'
		});
		</script>
		<input type="hidden" name="parse" value="1"><?php break;?>
	<?php case "4": ?>
		<link rel="stylesheet" href="/Public/static/thinkeditor/skin/default/style.css">
		<script type="text/javascript" src="/Public/static/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="/Public/static/thinkeditor/jquery.thinkeditor.js"></script>
		<script type="text/javascript">
			$(function(){
				$('textarea[name="<?php echo ($addons_data["name"]); ?>"]').attr('id', 'editor_id_<?php echo ($addons_data["name"]); ?>');
				var options = {
					"items"  : "h1,h2,h3,h4,h5,h6,-,link,image,-,bold,italic,code,-,ul,ol,blockquote,hr,-,fullscreen",
			        "width"  : "100%", //宽度
			        "height" : "<?php echo ($addons_config["editor_height"]); ?>", //高度
			        "lang"   : "zh-cn", //语言
			        "tab"    : "    ", //Tab键插入的字符， 默认为四个空格
					"uploader": "<?php echo addons_url('Editor://Upload/upload');?>"
			    };
			    $('#editor_id_<?php echo ($addons_data["name"]); ?>').thinkeditor(options);
			})
		</script>
		<input type="hidden" name="parse" value="2"><?php break; endswitch;?>