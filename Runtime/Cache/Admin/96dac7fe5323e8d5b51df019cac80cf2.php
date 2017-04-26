<?php if (!defined('THINK_PATH')) exit();?><table>
	<thead>
		<tr>
			<th>序号</th>
			<?php if(is_array($listKey)): $i = 0; $__LIST__ = $listKey;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th><?php echo ($vo); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
			<!-- <th>操作</th> -->
		</tr>
	</thead>
	<tbody>
		<?php if(is_array($_list)): $vo = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lv): $mod = ($vo % 2 );++$vo;?><tr>
			<td><?php echo ($lv["id"]); ?></td>
			<?php if(is_array($listKey)): $i = 0; $__LIST__ = $listKey;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$lk): $mod = ($i % 2 );++$i;?><td><?php echo ($lv["$lk"]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
			<td>
				<!-- <a class="update" href="javascript:;" data-id="<?php echo ($lv["id"]); ?>">更新</a> -->
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody>
</table>
<script type="text/javascript">
	$(function(){
		$('a.update').click(function(){
			id = $(this).data('id');
			alert(id);
		});
	})
</script>