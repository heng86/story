<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 归档
 *
 * @package custom
 */
$this->need('header.php');
?>

<div class="container-fluid">
    <div class="row">
        <div id="main" class="col-12 clearfix" role="main">
            <article class="posti" itemscope itemtype="http://schema.org/BlogPosting">
			<h1 style="text-align:center;" class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
                <h3>概述</h3>
                <div class="post-tags">
            	<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            	<ul>
				<li>本站共有 <b><?php $stat->publishedPostsNum() ?></b> 篇文章，被归为 <b><?php $stat->categoriesNum() ?></b> 个分类，总评论 <b><?php $stat->publishedCommentsNum() ?></b> 次。
				</ul>
				</div>
                <!-- 总分类&标签 -->
                <h3>分类&标签</h3>
                <div class="post-tags">
                    <!-- 分类 -->
                    <h4>分类</h4>
                    <?php $this->widget('Widget_Metas_Category_List', 'sort=mid&ignoreZeroCount=1&desc=0&limit=10')->to($category); ?>
                    <ul class="a_tag">
                        <?php while ($category->next()) : ?>
                            <li rel="tag"><a href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a>-<?php $category->count(); ?></li>
                        <?php endwhile; ?>
                    </ul>
                    <!-- 标签 -->
                    <h4>标签</h4>
                    <?php $this->widget('Widget_Metas_Tag_Cloud', array('sort' => 'count', 'ignoreZeroCount' => true, 'desc' => true, 'limit' => 10))->to($tags); ?>
                    <ul class="a_tag">
                        <?php while ($tags->next()) : ?>
                            <li rel="tag"><a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?></a>-<?php $tags->count(); ?></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <!-- 标签 -->
                <h3>文章</h3>
                <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
                $year = 0;
                $mon = 0;
                $i = 0;
                $j = 0;
                $output = '<div id="archives">';
                while ($archives->next()) :
                    $year_tmp = date('Y', $archives->created);
                    $mon_tmp = date('m', $archives->created);
                    $y = $year;
                    $m = $mon;
                    if ($year != $year_tmp && $year > 0) $output .= '</ul>';
                    if ($year != $year_tmp) {
                        $year = $year_tmp;
                        $output .= '<h4>' . $year . ' 年</h4><ul>'; //输出年份
                    }
                    $output .= '<li>' . date('m月d日：', $archives->created) . '<a href="' . $archives->permalink . '">' . $archives->title . '</a></li>'; //输出文章日期和标题
                endwhile;
                echo $output;
                ?>
            </article>
        </div>
    </div>
</div>

<?php $this->need('footer.php'); ?>