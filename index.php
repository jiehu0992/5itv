<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>刘三才后裔刘氏家族族谱树</title>
	<meta name="keywords" content="刘氏族谱,族谱,刘氏家谱,家谱树,爱视传媒">
	<meta name="description" content="自价、金二祖人川至今已近六百年历史，三才祖之后亦有四百多年。目前人数众多，分布省内外，很少联系往来，不少人祖宗、祖籍观念淡薄，上不知祖宗之根，下不知自已之源，甚至辈份都不清楚。虽然同根共祖具有相同血统和基因，但如同散沙，怎能互助互爱团结拼搏？在这世纪之交，在改革开放实行市场经济的形势下，我们不能辱没祖宗，一定要承上启下，继往开来，继承和发扬祖先耕读传家，拼搏不息，开拓进取的精神，以续谱为纽带，团结全族老小共同奋斗，从振兴家族做起，为中华的振兴作出贡献，为我氏在各族之林赢得一席之地">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<!--主要样式-->
	<script type="text/javascript" src="js/context-menu.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
	    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', '收起子孙族谱树');
	    $('.tree li.parent_li > span').on('click', function (e) {
	        var children = $(this).parent('li.parent_li').find(' > ul > li');
	        if (children.is(":visible")) {
	            children.hide('fast');
	            $(this).attr('title', '展开子孙族谱树').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
	        } else {
	            children.show('fast');
	            $(this).attr('title', '收起子孙族谱树').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
	        }
	        e.stopPropagation();
	    });
	});
	</script>
		
	</head>
<body>
<!-- 标准家谱树 需配合tree.php使用-->
<?php include 'header.php'; ?>
<div class="tree well">
    <?php 
        include_once 'type/tree.php';
        $menu = lefttree($array, $type); // 传递 $array 和 $type
    ?>
    <ul id="dhtmlgoodies_tree" class="dhtmlgoodies_tree">
        <?php echo $menu; ?>
    </ul>
</div>


<div class="tree">
    <ul>
        <li>
            <span><i class="icon-calendar"></i> 1999, 9, 9</span>
            <ul>
                <li>
                	<span class="badge badge-success"><i class="icon-minus-sign"></i> 四个代辈序，永远卜肆，源远流长</span>
                    <ul>
                        <li>
	                       <span><i class="icon-time"></i>10</span> 价寿尚季圭、三仕应逢鼎、启志良心现、广发永长绵、宗强生贵子、圣王佑福卿、祖坐丰华地、万代庆兴隆
                        </li>
                    </ul>
                </li>
                <li>
                	<span class="badge badge-success"><i class="icon-minus-sign"></i> 新四十代辈序</span>
                    <ul>
                        <li>
	                        <span><i class="icon-time"></i> 10</span>承汉传业昌、立德齐家祥、博学显雄才、道义传纲常、精勤春繁茂、宣元文武彰、明主恩泽照、仁伦宏图扬
                        </li>
                    </ul>
                </li>
                <li>
                	<span class="badge badge-warning"><i class="icon-minus-sign"></i> 先祖谱序</span>
                    <ul>
                        <li>
	                       <span><i class="icon-time"></i> 10</span>尝观商有承围之嗣（si）主，六百年历种长承，周有继治之文
孙，三十世钟虡（jù 意：古时悬钟鼓木架的两侧立柱）永守，古圣人克绳祖武，尚且远绍箕裘，况我刘氏。累自陶唐赐姓而后，系出神明之胄不卜可知矣！爰（ yuán）溯我祖传家以来，自价、金二祖，始由湖广黄州府麻城县孝感乡水牛塘移川北邻水县桂林漕，地号龙井沟，宅名蔑匠湾。盖先人之德泽孔长，先人声名圣振。故更一世，登甲第者蝉联而出，享高爵者继续而来。今邑中基址尚在，牌坊犹存，往来者且壮观瞻焉。自是而下，列胶庠（ xiang）食膳饩（ xi）者，殆（ dai）不可胜数。子孙蛰蛰，子孙纯纯，谓非先人之眙（chi）谋者远哉！奈洪化兵燹（xian）后，或迁于陕西或复于湖广，纷纷散处各居一方，惟应守祖一人席列祖之宏业，传列祖之隆名于未坠，使不溯厥本源，则前人之功业不彰，而后嗣之报本无自。故录其世系，俾世世子孙勿替引焉，是以为之序。
                        </li>
                        <li>
	                       <span><i class="icon-time"></i> 10</span> 道光二年壬午岁又三月望八日 良柱、良朋、良恪同撰
                        </li>
                    </ul>
                </li>
                <li>
                	<span class="badge badge-important"><i class="icon-minus-sign"></i> 续谱说明</span>
                    <ul>
                        <li>
	                        <span><i class="icon-time"></i>10</span>纵观历史，凡政治修明，社会经济繁荣，人民安居乐业的时代，各地政府部门都要修志编史。生逢盛世的全国人民，甚至海外华人都在认祖归宗纷纷续谱，何况刘氏乃是源远流长的名门望族！</br>
    自价、金二祖人川至今已近六百年历史，三才祖之后亦有四百多年。目前人数众多，分布省内外，很少联系往来，不少人祖宗、祖籍观念淡薄，上不知祖宗之根，下不知自已之源，甚至辈份都不清楚。虽然同根共祖具有相同血统和基因，但如同散沙，怎能互助互爱团结拼搏？在这世纪之交，在改革开放实行市场经济的形势下，我们不能辱没祖宗，一定要承上启下，继往开来，继承和发扬祖先耕读传家，拼搏不息，开拓进取的精神，以续谱为纽带，团结全族老小共同奋斗，从振兴家族做起，为中华的振兴作出贡献，为我氏在各族之林赢得一席之地。</br>
原有刘氏族谱古本，流传在世的全系转抄本，不仅不全、不详，而且谬误较多。经收集考证，编撰最早又较系统完整的古本是道光二年（ 1822），良柱、良朋、良恪三祖所写，至今近200年了。近两个世纪以来，随着社会变革，人世沧桑，家族也发生了巨变。若再不清理续谱；将造成后代的更大混乱，成为我族不可弥补的憾事！为此，银生（广周）、孝廷、永安等23人于公元一九九八年八月十三日倡议组成“刘氏家族续谱筹备组”。经筹备组研究决定组成编委会，由编委会具体实施续谱工作。</br>
新续《刘氏续谱》分三大部分:</br>第一部分在本着忠实古本的基础上，对古本进行整理、修订。为了便于阅读理解，对部份文言字词、名人职务、学位等作了注解、注音，部份干支纪年换算成公元年号。书写方式上，改竖写为横排，改繁体字为简化字。此外，还加了目录、续写说明、刘氏溯源、小标题以及括号标点等字符。</br>
第二部份是将目前已找到的我氏人员自已提供的“心”字辈以下的子孙情况，逐代串联起来与古本连成世系。
第三部份是有关其他情况。</br>
价、金二祖的生殁和从湖北人川的准确时间虽然凭现有资料无法证实，但从近代发现的仕魁祖墓内神主牌上记载的生殁时间 可以推测。按仕魁祖生于1567年倒推六代（180年），刘价祖大约生于明洪武丁卯年（1387），若壮年人川，正是明成祖永乐（140子1424）年间。那时正是国家统一，国力富强时期，虽然成祖好大喜功，连年对外用兵，超过国家财力人力，但总体看，仍不失为明朝的盛世；加之“湖广填四川”的高峰年代也不在永乐年间。由此可见，价、金二祖不是普通移民或逃难人川，很可能是入川做官或投亲靠友。不然，入川后的第一代刘寿祖很难高中进士，并任顺天府推官。至于先祖为什么落业在山区而不去富庶的城郊？除其他原因外，估计是因“湖广填四川”前后400年，自元末明初（1330年前后）开始，到价、金二祖人川时已近100年，富庶城郊早被先期移民所占。比较而言，桂林漕这个山青水秀、土地肥沃的“风水宝地”算是当时剩下的好地方。</br>
族谱古本主要写的是应守祖上下各代的简况，价、金二祖之下，应守祖之上的旁系祖先几乎都未叙述。例如解温乡的滥坝、袁市乡的合口岩有两支人本是三才祖之二子仕盛祖的后代，因迁出大屋基后失去联系未记人古谱，这次，续谱全部．合族归宗 。</br>
从“先祖谱序”中可知，洪化兵燹（燹 音：xian，意：兵灾）后，旁系先祖中不少人迁到陕西或回到了湖广，由此可见，现今的陕西、湖北还有不少价、金二祖的后裔与我们音信隔绝数百年。如有机会或可能与他们联系上，实现全族大圆，那将是我氏之大幸。</br>
这次续谱，原则上按国家男女平等和计划生青等政策，凡我刘氏不分男女皆可绩谱，但女子出嫁后所生的子女，不再姓刘的不谱。续谱中若有遗漏要求增补的，可记入族。谱后面的空表上。</br>
续谱以辩证唯物主义观点全面概述了有据可考的我族人员对古、今族人概不评论，只按血缘关系秉笔直书，目的是为了真实反映我族的历史和现状。由于资料、时间、水平有限，新谱中的谬误在所难免，望我族有识之士予以理解和补正。</br>
先祖所排四十代辈序，已用 23代，因考虑到全族统一续谱的大事百年难遇，为使后代辈序不乱，在前四十代辈序之后续编了新的四十代辈序，供子孙后代使用。
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
            </ul>
</div>
<div align="center">2018年爱视传媒制作http://demo.tvsbar.com</div>
</body>
</html>