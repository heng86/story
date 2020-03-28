<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php require_once 'functions.php'; ?>
<!DOCTYPE HTML>
<?php
require_once 'config.php';
if ($GLOBALS['style_BG'] != '') {
    echo '<style>';
    echo "\n";
    echo 'body{background: #fff;}body::before {background: url(' . $GLOBALS['style_BG'] . ') center/cover no-repeat;}blockquote::before {background: transparent !important;}';
    echo "\n";
    echo '</style>';
    echo "\n";
}
?>
<html  lang="zh-cmn-Hans">
<head>
	<!-- 声明文档使用的字符编码 -->
	<meta charset="<?php $this->options->charset(); ?>"/>
	<!-- 优先使用 IE 最新版本和 Chrome -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<!-- 启用国产浏览器的极速模式(webkit) -->
    <meta name="renderer" content="webkit"/>
	<!-- 移动设备全屏显示 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>
		<?php $this->archiveTitle(array(
            'category'  =>  _t('分类 "%s" 中的文章'),
            'search'    =>  _t('包含关键词 "%s" 的文章'),
            'tag'       =>  _t('被打上 "%s" 标签的文章'),
            'author'    =>  _t('作者 "%s" 发布的文章'),
            'date'      =>  _t('"%s" 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?>
    </title>
	<meta name="description" itemprop="description" content="<?php $this->options->description() ?>"/>
    <meta name="keywords" content="<?php $this->options->keywords() ?>"/>
    <link type="text/css" rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php $this->options->themeUrl('assert/css/prism.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php $this->options->themeUrl('assert/css/zoom.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php $this->options->themeUrl('assert/css/main.css'); ?>">
    <?php if ($GLOBALS['isIconNav'] == 'on') : ?>
    <link type="text/css" rel="stylesheet" href="<?php $this->options->themeUrl('assert/css/twemoji-awesome.css'); ?>">
    <?php endif; ?>
    <?php if($this->options->favicon): ?>
	<link rel="shortcut icon" href="<?php $this->options->favicon();?>">
	<?php endif; ?>
    <!-- Google Adsense -->
    <script data-ad-client="ca-pub-9060781598368507" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>

<body>
    <header id="header" class="clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="logo">
                    <div class="header-logo">
                        <!-- 标题开始 -->
                        <a href="<?php $this->options->siteUrl(); ?>">
                        <span class="b">一</span>
                        <span class="b">恒</span>
                        <span class="b">的</span>
                        <span class="b">网</span>
                        <span class="b">志</span>
                        </a>
                        <!-- 标题结束 -->
                        <a id="btn-menu" href="javascript:isMenu1();">
                            <span class="w">=</span>
                        </a>
                        <a href="javascript:isMenu1();">
                            <?php if ($GLOBALS['isIconNav'] == 'on') : ?>
                                <span id="menu-1" class="bf"><i class="twa twa-flags"></i></span>
                            <?php else : ?>
                                <span id="menu-1" class="bf">1</span>
                            <?php endif; ?>
                        </a>
                        <a href="javascript:isMenu2();">
                            <?php if ($GLOBALS['isIconNav'] == 'on') : ?>
                                <span id="menu-2" class="bf"><i class="twa twa-evergreen-tree"></i></span>
                            <?php else : ?>
                                <span id="menu-2" class="bf">2</span>
                            <?php endif; ?>
                        </a>
                        <a href="javascript:isMenu3();">
                            <?php if ($GLOBALS['isIconNav'] == 'on') : ?>
                                <span id="menu-3" class="bf"><i class="twa twa-mag"></i></span>
                            <?php else : ?>
                                <span id="menu-3" class="bf">3</span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div id="menu-page">
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while ($pages->next()) : ?>
                            <a href="<?php $pages->permalink(); ?>">
                                <li><?php $pages->title(); ?></li>
                            </a>
                        <?php endwhile; ?>
                        <?php if ($GLOBALS['isRSS'] == 'on') : ?>
                            <a href="<?php $this->options->feedUrl(); ?>">
                                <li>RSS</li>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="body" class="clearfix">