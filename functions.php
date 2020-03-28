<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
  $logoimg = new Typecho_Widget_Helper_Form_Element_Text('logoimg', NULL, NULL, _t('页头logo地址'), _t('一般为http://www.yourblog.com/image.png,支持 https:// 或 //,留空则使用站点名称'));

  $form->addInput($logoimg->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));

  $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('favicon地址'), _t('一般为http://www.yourblog.com/image.ico,支持 https:// 或 //,留空则不设置favicon'));

  $form->addInput($favicon->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));

  $Projects = new Typecho_Widget_Helper_Form_Element_Textarea('Projects', NULL, NULL, _t('首页 Projects 设置（注意：切换主题会被清空！）'), _t('格式：<strong>链接名称(必须) | 链接地址(必须) | 链接描述</strong> 不同信息之间用英文竖线“|”分隔， 一行一个。'));
	$form->addInput($Projects);

  $ShowLinks = new Typecho_Widget_Helper_Form_Element_Radio('ShowLinks',
        array('able' => _t('启用'),'disable' => _t('禁止'),),
        'able', _t('底部友情链接显示'), _t('默认启用'));
  $form->addInput($ShowLinks);

  $ICPbeian = new Typecho_Widget_Helper_Form_Element_Text('ICPbeian', NULL, NULL, _t('ICP备案号'), _t('在这里输入ICP备案号,留空则不显示'));
  $form->addInput($ICPbeian);

  $ADpost = new Typecho_Widget_Helper_Form_Element_Textarea('ADpost', NULL, NULL, _t('文章底部广告代码'), _t('文章页面底部，评论列表之前'));
  $form->addInput($ADpost);

  $ADpage = new Typecho_Widget_Helper_Form_Element_Textarea('ADpage', NULL, NULL, _t('页面底部广告代码'), _t('独立页面底部，评论列表之前'));
  $form->addInput($ADpage);
}
ini_set("error_reporting", "E_ALL & ~E_NOTICE");

/**项目展示<?php Projects(); ?>*/
function Projects($sorts = NULL) {
    $options = Typecho_Widget::widget('Widget_Options');
    $Project = NULL;
    if ($options->Projects) {
        $list = explode("\r\n", $options->Projects);
        foreach ($list as $val) {
            list($name, $url, $description, $sort) = explode("|", $val);
            if ($sorts) {
                $arr = explode("|", $sorts);
                if ($sort && in_array($sort, $arr)) {
                    $Project .= $url ? '<li class="project-item"><a href="'.$url.'" target="_blank">'.$name.'</a>:<span class="meta"> '.$description.'</span></li>' : '<li class="project-item">'.$name.': '.$description.'</li>';
                }
            } else {
                $Project .= $url ? '<li class="project-item"><a href="'.$url.'" target="_blank">'.$name.'</a>:<span class="meta"> '.$description.'</span></li>' : '<li class="project-item">'.$name.': '.$description.'</li>';
            }
        }
    }
    echo $Project ? $Project : '世间无限丹青手，一片伤心画不成。';
}

function parseContnet($content)
{
    //解析文章 暂只是添加 h3,h4 锚点，为 <img> 添加 data-action

    //添加 h3,h4 锚点
    $ftitle = array();
    preg_match_all('/<h([3-4])>(.*?)<\/h[3-4]>/', $content, $title);
    $num = count($title[0]);

    for ($i = 0; $i < $num; $i++) {
        $f = $title[2][$i];
        $type = $title[1][$i];
        if ($type == '3') {
            $ff = '<h3 id="anchor-' . $i . '">' . $f . '</h3>';
        }
        if ($type == '4') {
            $ff = '<h4 id="anchor-' . $i . '">' . $f . '</h4>';
        }
        array_push($ftitle, $ff);
    }
    for ($i = 0; $i < $num; $i++) {
        $content = str_replace_limit($title[0][$i], $ftitle[$i], $content);
    }

    //<img> 添加 data-action
    $fimg = array();
    preg_match_all('/<img (.*?)>/', $content, $img);
    $num = count($img[0]);

    for ($i = 0; $i < $num; $i++) {
        $f = $img[1][$i];
        $ff = '<img data-action="zoom" ' . $f . '>';

        array_push($fimg, $ff);
    }
    for ($i = 0; $i < $num; $i++) {
        $content = str_replace_limit($img[0][$i], $fimg[$i], $content);
    }

    print_r($content);
}

function str_replace_limit($search, $replace, $subject, $limit = 1)
{
    if (is_array($search)) {
        foreach ($search as $k => $v) {
            $search[$k] = '`' . preg_quote($search[$k], '`') . '`';
        }
    } else {
        $search = '`' . preg_quote($search, '`') . '`';
    }

    return preg_replace($search, $replace, $subject, $limit);
}

/**文章目录**/
function post_tor($content)
{
    $f = '';
    preg_match_all('/<h[3-4]>(.*?)<\/h[3-4]>/', $content, $tor_i);
    $num = count($tor_i[0]);
    for ($i = 0; $i < $num; $i++) {
        $a = '<a href="#anchor-' . $i . '">' . $tor_i[0][$i] . '</a>';
        $f = $f . $a;
    }
    $f = str_replace('<h3>', '<span class="tori">', $f);
    $f = str_replace('</h3>', '</span><br>', $f);
    $f = str_replace('<h4>', '<span class="torii">', $f);
    $f = str_replace('</h4>', '</span><br>', $f);
    if ($num == 0) {
        return '';
    } else {
        return '<a href="#main" class="tori">回到顶部</a><br>' . $f . '<!--<a href="javascript:goToComment();">评论</a>-->';
    }
}


function post_config($content)
{
    $rst = array();
    preg_match_all('/<!-- isTorTree:(.*?); -->/', $content, $isTor);
    if ($isTor[1][0] == 'on') {
        $rst['isTorTree'] = 1;
    }

    return $rst;
}
