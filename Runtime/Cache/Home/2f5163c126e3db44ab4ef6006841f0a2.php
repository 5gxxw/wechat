<?php if (!defined('THINK_PATH')) exit();?><div class="container-fluid">
    <div class="blank"></div>
    <h3 class="noticeDetailTitle"><strong><?php echo ($title); ?></strong></h3>
    <div class="noticeDetailInfo">发布者:<?php echo ($name); ?></div>
    <div class="noticeDetailInfo">发布时间：<?php echo (time_format($create_time)); ?></div>
    <div class="noticeDetailContent">
        <?php echo ($content); ?>
    </div>
</div>