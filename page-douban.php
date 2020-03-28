<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 豆瓣秀
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
				<div class="post-content" itemprop="articleBody">
					<h3>最近看过的书</h3>
					<div data-status="read" class="douban-book-list doubanboard-list"></div>
					<h3>最近看过的电影</h3>
					<div data-status="watched" class="douban-movie-list doubanboard-list"></div>
					<h3>计划要读的书</h3>
					<div data-status="wish" class="douban-book-list doubanboard-list"></div>
					<h3>想看的电影</h3>
					<div data-status="wish" class="douban-movie-list doubanboard-list"></div>
				</div>
            </article>
        </div>
    </div>
</div>
<?php $this->need('footer.php'); ?>