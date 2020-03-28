<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <div id="main" class="col-12 clearfix" role="main">
            <article class="posti" itemscope itemtype="http://schema.org/BlogPosting">
                <h1 class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
                <div class="post-meta">
                    <p>Written by <a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> with ♥ on <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y年m月d日'); ?></time> in <?php $this->category(', ', true, 'none'); ?></p>
                </div>
                <div class="post-content" itemprop="articleBody">
                    <?php parseContnet($this->content); ?>
                </div>
                <div id="postFun" style="display:block;margin:2em 0;" class="clearfix">
                    <section style="float:left;">
                        <span itemprop="keywords" class="tags"><?php _e('标签: '); ?><?php $this->tags(', ', true, 'none'); ?></span>
                    </section>
                    <section style="float:right;">
                        <span><a id="btn-comments" href="javascript:scroll(0,0);">&uarr; 回到顶部</a></span> · 
                        <span><a href="<?php $this->options->siteUrl(); ?>">&larr; 返回首页</a></span>
                    </section>
                </div>
                <div id="postFun" style="display:block;margin-bottom:2em;" class="clearfix">
                    <section style="float:left;">
                        <span>上一篇：<?php $this->thePrev('%s','没有了'); ?></span>
                        <br>
                        <span>下一篇：<?php $this->theNext('%s','没有了'); ?></span>
                    </section>
                </div>   
                <div id="postFun" style="display:block;" class="clearfix">
                    <section style="float:left;">
                    <span>相关文章：</span>
						<?php $this->related(5)->to($relatedPosts); ?>
						    <ul class="list-unstyled">
						    <?php while ($relatedPosts->next()): ?>
						    <li><a href="<?php $relatedPosts->permalink(); ?>" title="<?php $relatedPosts->title(); ?>"><?php $relatedPosts->title(); ?></a></li>
						    <?php endwhile; ?>
						</ul>   
                    </section>
                </div>         
                <?php
                $torHTML = post_tor($this->content);
                if ($torHTML != '') {
                    print_r('<div id="postTorTree"><div id="torTree"><div class="torArcT"><div class="torArcTile">' . $torHTML . '</div></div></div></div>');
                }
                ?>
            </article>
        </div>
    </div>
</div>
<?php $this->need('footer.php'); ?>