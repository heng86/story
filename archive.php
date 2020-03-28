<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="archive-header">
            <span><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 "%s" 中的文章'),
                'search'    =>  _t('包含关键词 "%s" 的文章'),
                'tag'       =>  _t('被打上 "%s" 标签的文章'),
                'author'    =>  _t('作者 "%s" 发布的文章'),
                'date'      =>  _t('"%s" 发布的文章')
                    ), '', ''); ?></span>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div id="main" role="main">
            <ul class="post-list clearfix">
                <?php if ($this->have()) : ?>
                    <?php while ($this->next()) : ?>
                        <li class="post-item grid-item" itemscope itemtype="http://schema.org/BlogPosting">
                            <a class="post-link" href="<?php $this->permalink() ?>">
                                <h3 class="post-title"><time class="index-time" datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('M j, Y'); ?></time><br><?php $this->title() ?></h3>
                                <?php if ($this->category) : ?>
                                    <div class="post-meta">
                                        <?php echo $this->category; ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                <?php else : ?>
                    <br><br>
                    <h2 class="post-title">
                        <center><?php _e('(´°̥̥̥̥̥̥̥̥ω°̥̥̥̥̥̥̥̥｀) 什么都没有找到唉...'); ?></center>
                    </h2>
                <?php endif; ?>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="nav-page">
            <?php $this->pageNav('&laquo;', '&raquo;'); ?>
        </div>
    </div>
</div>

<?php $this->need('footer.php'); ?>