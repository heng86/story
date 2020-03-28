<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div><!-- end #body -->
<footer id="footer" role="contentinfo">
    <div class="container-fluid">
        <div class="row">
			<div class="col-12">
				<p>
				&copy; 2007-<?php echo date('Y'); ?> <?php $this->options->title(); ?> -
				<span id="sitetime"></span> -
				<a href="/sitemap.xml" target="_blank">SiteMap</a> -
				<a href="/ampindex" target="_blank">AMP</a> -
				<?php if ($this->options->ICPbeian): ?>
				<a href="http://beian.miit.gov.cn" class="icpnum" target="_blank" rel="nofollow"><?php $this->options->ICPbeian(); ?></a>
				<?php endif; ?>
				<br>
				</p>
			</div>
			<div id="links">
				<ul>
					<?php $this->widget('Widget_Contents_Page_List')->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
				</ul>
			</div>
		</div>
    </div>
</footer>
<!-- 网站运行时间代码 -->
<script language=javascript>
  function siteTime(){
  	window.setTimeout("siteTime()", 1000);
  	var minutes = 60000;
  	var hours = minutes * 60;
  	var days = hours * 24;
  	var years = days * 365;
  	var today = new Date();
  	var todayYear = today.getFullYear();
  	var todayMonth = today.getMonth()+1;
  	var todayDate = today.getDate();
  	var todayHour = today.getHours();
  	var todayMinute = today.getMinutes();
  	/*
  	Date.UTC() -- 返回date对象距世界标准时间(UTC)1970年1月1日午夜之间的毫秒数(时间戳)
  	year - 作为date对象的年份，为4位年份值
  	month - 0-11之间的整数，做为date对象的月份
  	day - 1-31之间的整数，做为date对象的天数
  	hours - 0(午夜24点)-23之间的整数，做为date对象的小时数
  	minutes - 0-59之间的整数，做为date对象的分钟数
  	seconds - 0-59之间的整数，做为date对象的秒数
  	microseconds - 0-999之间的整数，做为date对象的毫秒数
  	*/
  	var t1 = Date.UTC(2007,03,14,00,00); //北京时间2007-3-14 00:00
  	var t2 = Date.UTC(todayYear,todayMonth,todayDate,todayHour,todayMinute);
  	var diff = t2-t1;
  	var diffYears = Math.floor(diff/years);
  	var diffDays = Math.floor((diff/days)-diffYears*365);
  	var diffHours = Math.floor((diff-(diffYears*365+diffDays)*days)/hours);
  	var diffMinutes = Math.floor((diff-(diffYears*365+diffDays)*days-diffHours*hours)/minutes);
  	document.getElementById("sitetime").innerHTML=" 本站已运行: "+diffYears+" 年 "+diffDays+" 天 "+diffHours+" 小时 "+diffMinutes+" 分钟 ";
  }
  siteTime();
</script>
<script src="https://cdn.staticfile.org/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php $this->options->themeUrl('assert/js/prism.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assert/js/zoom-vanilla.min.js'); ?>"></script>
<script>
    $(document).ready(function() {
        if (window.location.hash != '') {
            var i = window.location.hash.indexOf('#comment');
            var ii = window.location.hash.indexOf('#respond-post');
            if (i != -1 || ii != -1) {
                document.getElementById('btn-comments').innerText = 'hide comments';
                document.getElementById('comments').style.display = 'block';
                footerPosition();
            }
        }
    });

    window.onload = function() {
        <?php if ($this->is('post')) : ?>
            <?php $postConfig = post_config($this->content); ?>
            <?php if ($postConfig['isTorTree']) : ?>
                isMenu2('auto');
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($GLOBALS['isAutoNav'] == 'on') : ?>
            var b = document.getElementsByClassName('b');
            var w = document.getElementsByClassName('w');
            var menupgMargin = (b.length + w.length) * 28;
            var srhboxMargin = (b.length + w.length + 3) * 28;
            var menusrhWidth = (b.length + w.length - 1) * 28;
            document.getElementById('menu-page').style['margin-left'] = menupgMargin + 'px';
            document.getElementById('search-box').style['margin-left'] = srhboxMargin + 'px';
            document.getElementById('menu-search').style['width'] = menusrhWidth + 'px';
            if (menusrhWidth < 140) {
                document.getElementById('menu-search').setAttribute('placeholder', 'Search~');
            }
        <?php endif; ?>
    }

    function isMenu1() {
        if (document.getElementById('menu-page').style.display == 'block') {
            $('#menu-page').fadeOut(300);
        } else {
            $('#menu-page').fadeIn(300);
        }
    }

    function isComments() {
        if (document.getElementById('btn-comments').innerText == '显示评论') {
            document.getElementById('btn-comments').innerText = '隐藏评论';
            document.getElementById('comments').style.display = 'block';
        } else {
            document.getElementById('btn-comments').innerText = '显示评论';
            document.getElementById('comments').style.display = 'none';
        }
        footerPosition();
    }

    function Search404() {
        $('#menu-1').fadeIn(150);
        $('#menu-2').fadeIn(150);
        $('#menu-3').fadeIn(150);
        $('#search-box').fadeIn(300);
    }

    function goBack() {
        window.history.back();
    }

    function footerPosition() {
        $("footer").removeClass("fixed-bottom");
        var contentHeight = document.body.scrollHeight,
            winHeight = window.innerHeight;
        if (document.getElementsByClassName("post-content")[0]) {
            var winImgNum = document.getElementsByClassName("post-content")[0].getElementsByTagName("img").length;
        } else {
            var winImgNum = 0;
        }
        if (!(contentHeight > winHeight) && winImgNum == 0) {
            $("footer").addClass("fixed-bottom");
        }
    }
    footerPosition();
    $(window).resize(footerPosition);

    function goToComment() {
        document.getElementById('btn-comments').innerText = '隐藏评论';
        document.getElementById('comments').style.display = 'block';
        window.location.hash = "#postFun";
    }
</script>
<?php $this->footer(); ?>
</body>
</html>