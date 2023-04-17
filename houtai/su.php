<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED);
include("../conn.php");//数据库连接
if('POST'==$_SERVER['REQUEST_METHOD']){
    header('Content-Type: application/json; charset=utf-8');
    $id=$_POST['id']+0;
    $id2=$_POST['id2']+0;
    $pid=$_POST['pid']+0;

    $node=getNodeById($id);
    $pnode=getNodeById($pid);

    if($_POST['isdrop']){//删除
        if($node){
            $num=$node->R-$node->L+1;
            mysqli_query($link,'DELETE FROM `tree_lr` WHERE L>='.$node->L.' AND R<='.$node->R) or die('删除节点错误！'.mysqli_error());
            mysqli_query($link,'UPDATE `tree_lr` SET L=L-'.$num.' WHERE L>'.$node->R) or die('删除节点时更新L值错误！'.mysqli_error());
            mysqli_query($link, 'UPDATE `tree_lr` SET R=R-'.$num.' WHERE R>'.$node->R) or die('删除节点时更新R值错误！'.mysqli_error());
            exit('true');
        }else{
            die('<font color="red">删除的节点不存在！</font>');
        }
    }elseif($_POST['isswap']){//交换两节点位置
        $node2=getNodeById($id2);
        if($node && $node2){
            $num=$node->R-$node->L+1;
            $num2=$node2->R-$node2->L+1;
            mysqli_query($link,'UPDATE `tree_lr` SET dorder=IF(dorder='.$node->dorder.','.$node2->dorder.','.$node->dorder.') WHERE id IN('.$id.','.$id2.')') or die('交换节点时更新dorder值错误！'.mysqli_error());
            mysqli_query($link,'UPDATE `tree_lr` SET L=L+IF(L>'.$node->R.',-'.$num.','.$num2.'), R=R+IF(R>'.$node->R.',-'.$num.','.$num2.') WHERE (L>='.$node->L.' AND R<='.$node->R.') OR (L>='.$node2->L.' AND R<='.$node2->R.')') or die('交换节点时更新L值错误！'.mysqli_error());
            exit('true');
        }else{
            die('<font color="red">交换的节点至少其中之一不存在！</font>');
        }
    }elseif($_POST['ismove']){//移动到...
        if($node && $pnode){//从后移到前...
            $maxR=mysqli_result(mysqli_query($link, 'SELECT MAX(R) FROM tree_lr'),0);
            $num=$node->R-$node->L+1;

            mysqli_query($link, 'UPDATE `tree_lr` SET pid='.$pid.' WHERE id='.$id) or die('交换节点时更新pid值错误！'.mysqli_error());

            //把节点放到maxR最后用来暂存LR
            $lastMaxR=$maxR-$node->L+1;
            mysqli_query($link, 'UPDATE `tree_lr` SET L=L+'.$lastMaxR.', R=R+'.$lastMaxR.' WHERE L>='.$node->L.' AND R<='.$node->R) or die('交换节点时更新LR+lastMaxR值错误！'.mysqli_error());

            if($node->R<$maxR){//调整节点后的LR值
                mysqli_query($link, 'UPDATE `tree_lr` SET L=L-'.$num.' WHERE L<='.$maxR.' AND L>'.$node->R) or die('交换节点时更新L值错误！'.mysqli_error());
                mysqli_query($link, 'UPDATE `tree_lr` SET R=R-'.$num.' WHERE L<='.$maxR.' AND R>='.$node->R) or die('交换节点时更新L值错误！'.mysqli_error());
            }

            if($pnode->L>$node->L){//纠正从前移到后的pnode的LR值
                $pnode->L-=$num;
                $pnode->R-=$num;
            }

            //让父节点腾出LR值空间
            mysqli_query($link, 'UPDATE `tree_lr` SET L=L+'.$num.' WHERE L<='.$maxR.' AND L>'.$pnode->R) or die('交换节点时更新L值错误！'.mysqli_error());
            mysqli_query($link, 'UPDATE `tree_lr` SET R=R+'.$num.' WHERE L<='.$maxR.' AND R>='.$pnode->R) or die('交换节点时更新L值错误！'.mysqli_error());

            //把暂存节点LR放到父节点腾出的LR值空间
            $pnodeR=-$maxR+$pnode->R-1;
            mysqli_query($link, 'UPDATE `tree_lr` SET L=L+'.$pnodeR.', R=R+'.$pnodeR.' WHERE L>'.$maxR) or die('交换节点时更新LR+lastMaxR值错误！'.mysqli_error());

            exit('true');
        }elseif($node){//从移到最后...
            $maxR=mysqli_result( mysqli_query($link, 'SELECT MAX(R) FROM tree_lr'),0);
            $num=$node->R-$node->L+1;

             mysqli_query($link, 'UPDATE `tree_lr` SET pid='.$pid.' WHERE id='.$id) or die('交换节点时更新pid值错误！'.mysqli_error());

            //把节点放到maxR最后用来暂存LR
            $lastMaxR=$maxR-$node->L+1;
            mysqli_query($link, 'UPDATE `tree_lr` SET L=L+'.$lastMaxR.', R=R+'.$lastMaxR.' WHERE L>='.$node->L.' AND R<='.$node->R) or die('交换节点时更新LR+lastMaxR值错误！'.mysqli_error());

            mysqli_query($link, 'UPDATE `tree_lr` SET L=L-'.$num.' WHERE L>'.$node->R) or die('交换节点时更新L值错误！'.mysqli_error());
            mysqli_query($link, 'UPDATE `tree_lr` SET R=R-'.$num.' WHERE R>='.$node->R) or die('交换节点时更新L值错误！'.mysqli_error());

            exit('true');
        }else{
            die('<font color="red">交换的节点至少其中之一不存在！</font>');
        }
    }elseif($id){//编辑
        if($node){
            mysql_query('UPDATE `tree_lr` SET `name`=\''.addslashes($_POST['name']).'\' WHERE id='.$id) or die('修改节点是更新name值错误！'.mysql_error());
            exit('true');
        }else{
            die('<font color="red">编辑的节点不存在！</font>');
        }
    }else{//添加
        if($pid){
            $pnode=getNodeById($pid);
            if($pnode){
                mysqli_query($link, 'UPDATE `tree_lr` SET L=L+2 WHERE L>'.$pnode->R) or die('添加节点时更新L值错误！'.mysqli_error());
                mysqli_query($link, 'UPDATE `tree_lr` SET R=R+2 WHERE R>='.$pnode->R) or die('添加节点时更新R值错误！'.mysqli_error());
                mysqli_query($link, 'INSERT INTO `tree_lr` (pid,`name`,L,R)VALUES('.$pid.',\''.addslashes($_POST['name']).'\','.$pnode->R.','.$pnode->R.'+1)') or die('添加节点错误！'.mysqli_error());
                mysqli_query($link, 'UPDATE `tree_lr` SET dorder=id WHERE id=last_insert_id()') or die('添加节点时更新dorder值错误！'.mysqli_error());
                die('"添加成功！"');
            }else{
                die('<font color="red">父节点不存在！</font>');
            }
        }else{
            $maxR=mysqli_result::fetch_all(mysqli_query($link, 'SELECT MAX(R) FROM tree_lr'));
            $maxR = $maxR[0];
            mysqli_query($link, 'INSERT INTO `tree_lr` (pid,`name`,L,R)VALUES(0,\''.addslashes($_POST['name']).'\','.$maxR.'+1,'.$maxR.'+2)') or die('添加节点错误！'.mysqli_error());
            mysqli_query($link, 'UPDATE `tree_lr` SET dorder=id WHERE id=last_insert_id()') or die('添加节点时更新dorder值错误！'.mysqli_error());
            die('"添加成功！"');
        }
    }
    exit('<font color="red">未知错误！</font>');
}else{
    header('Content-Type: text/html; charset=utf-8');
}

function getNodeById($id,$fields='L,R,dorder'){
    global $link;
    if(!$id){
        return false;
    }
    $q=mysqli_query($link, 'SELECT '.$fields.' FROM `tree_lr` WHERE id='.$id.' LIMIT 1');
    if(!$q){
        return false;
    }
    return mysqli_fetch_object($link,$q);
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>刘氏族谱</title>
    <meta name="keywords" content="刘氏族谱,族谱,刘氏家谱,家谱树,爱视传媒">
<meta name="description" content="自价、金二祖人川至今已近六百年历史，三才祖之后亦有四百多年。目前人数众多，分布省内外，很少联系往来，不少人祖宗、祖籍观念淡薄，上不知祖宗之根，下不知自已之源，甚至辈份都不清楚。虽然同根共祖具有相同血统和基因，但如同散沙，怎能互助互爱团结拼搏？在这世纪之交，在改革开放实行市场经济的形势下，我们不能辱没祖宗，一定要承上启下，继往开来，继承和发扬祖先耕读传家，拼搏不息，开拓进取的精神，以续谱为纽带，团结全族老小共同奋斗，从振兴家族做起，为中华的振兴作出贡献，为我氏在各族之林赢得一席之地">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/css/add.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style type="text/css">
    body{line-height:25px;font-size:14px;margin:0;}
    #wp{margin:0 auto;width:90%;padding:0 10px;border:1px #ccc solid;}
    h1{margin:0;padding:10px;font-size:20px;}
    h2{border-top:1px #ccc solid;border-bottom:1px #ccc solid;background:#eee;margin:10px -10px;padding:5px 8px;font-size:14px;}
    ul{list-style:none;margin:0;padding:0;}
    ul.view_node,ul.manage_node{padding:10px 0;}
    ul.view_node li{padding-left:1em;}
    ul.manage_node{text-align:right;}
    ul.manage_node li{clear:both;}
    ul.manage_node p{float:left;margin:0;}
    ul.manage_node ul{padding-left:1em;}
    .gray{color:gray;}
    a{text-decoration:none;}
    li.hover{background:#efefef;}
    input,button{cursor:pointer;}
    </style>
</head>
<body>
<script type="text/javascript">
$.post=function(data,callback){
    return $.ajax({
        url:location.href,
        type:'POST',
        data:data,
        dataType:'json',
        success:function(json){
            if(typeof(json)!='string'){
                callback(json);
            }else{
                alert(json);
                location.reload();
            }
        },error:function(xhr){
            $('#errorMsg').html(xhr.responseText+'<hr/>');
            setTimeout(function(){$('#errorMsg').html('')},10000);
        }
    });
}
function tree_add(ipt,pid){
    var val=$.trim($(ipt).val());
    if(!/.+/.test(val)){
        alert('不能空！');
        $(ipt).focus();
        return;
    }
    $.post({pid:pid,name:val});
};
</script>
<div id="wp">
	
			<?php include_once '/css/hadmin.php';?>
<h1>刘三才族裔_刘氏族谱</h1>
<?php
$list=array();
$q=mysqli_query($link, 'SELECT * FROM `tree_lr` ORDER BY l ASC') or die(mysqli_error());
while($node=mysqli_fetch_object($q)){
    $list[]=$node;
}

//简单缩进方式
$stack=array();
?><h2>价寿尚季圭、三仕应逢鼎、启志良心现、广发永长绵、宗强生贵子、圣王佑福卿、祖坐丰华地、万代庆兴隆。 四个代辈序，永远卜肆，源远流长</h2><ul class="view_node"><?php
foreach($list as $node):
    while(($count=count($stack)) && end($stack)<$node->L){
        array_pop($stack);
    }
    array_push($stack,$node->R);
    ?>
        <li style="padding-left:<?=$count?>em;"><?=$node->name?>
       ID <font color="green"><span title="ID"><?=$node->id?></span></font>&nbsp;&nbsp;&nbsp;&nbsp;
    父辈ID<font color="red">  <span title="PID"><?=$node->pid?></span></font>
    妻子<font color="red">  <span title="wname"><?=$node->wname?></span></font>
    第<font color="red"> <span title="dc"><?=$node->dc?></span></font>世代
    生平:<font color="red"> <span title="info"><?=$node->info?></span></font>
        </li>
        <?php
endforeach;
?></ul><?php

//元素包裹方式
$stack=array();
?><h2>节点管理</h2>
<div id="errorMsg"></div>
<input id="ipt_add" type="text" value="" size="30"/>
<input type="button" value="添加" onclick="tree_add('#ipt_add',0)"/>
<input type="button" value="详情编辑" onclick="info_add('#ipt_add',0)"/>
<ul class="manage_node"><?php
foreach($list as $node):
    while(count($stack) && end($stack)->R<$node->L){
        if(end($stack)->R-end($stack)->L-1){
            ?></ul><?php
        }
        ?></li><?php
        array_pop($stack);
    }
    array_push($stack,$node);
    ?><li nodeid="<?=$node->id?>"><p><span title="点击编辑节点" class="tree_edit"><?=$node->name?></span> <font color="red"><span title="ID"><?=$node->id?></span> <span title="PID"><?=$node->pid?></span></font> <font color="green"><span title="左值"><?=$node->L?></span> <span title="右值"><?=$node->R?></span></font></p><a href="javascript:void('添加子节点');" title="添加子节点" class="tree_add">快速添加</a>-<a href="/lsc/infoedit2.php?id=<?=$node->id?>" title="详情编辑" class="info_add">详情编辑</a>- <a href="javascript:void('删除子节点');" title="删除子节点" class="tree_drop">删除</a> - <a href="javascript:void('移动到指定节点');" title="移动到指定节点" class="tree_moveto">移动到...</a><?php
    if($node->R-$node->L-1){
        ?><ul><?php
    }
endforeach;
while(count($stack)){
    if($end->R-$end->L-1){
        ?></ul><?php
    }
    ?></li><?php
    array_pop($stack);
}
?></ul>
</div>

<script type="text/javascript">
$('li').mouseover(function(e){
    $(this).addClass('hover');
    e.stopPropagation();
}).mouseout(function(e){
    $(this).removeClass('hover');
    e.stopPropagation();
});

$('.tree_add').click(function(){
    var ul=$(this).parent().children('ul');
    if(ul.size()==0){
        ul=$('<ul/>').appendTo($(this).parent());
    }
    $('#ipt_add_child').parent().remove();
    $('<li><p><input id="ipt_add_child" type="text" value="" size="30"/><input type="button" value="添加" onclick="tree_add(\'#ipt_add_child\','+$(this).parent().attr('nodeid')+')"/></p>&nbsp;</li>').appendTo(ul);
});
$('.tree_edit').click(function(){
    var $this=$(this);
    var val=$.trim($this.text());
    var ipt=$('<input type="text" title="按Enter键保存修改，按ESC不保存修改"/>').val(val).insertAfter(this);
    $this.hide();
    ipt.keydown(function(e){
        if(e.keyCode==13){//Enter
            var nval=$.trim($(this).val());
            if(val==nval){
                $this.show();
                ipt.remove();
            }else{
                $.post({id:$this.parent().parent().attr('nodeid'),name:nval},function(status){
                    alert('已保存');
                    $this.show().text(nval);
                    ipt.remove();
                });
            }
        }
        if(e.keyCode==27){
            $this.show();
            ipt.remove();
        }
    }).blur(function(){
        $this.show();
        ipt.remove();
    });
    ipt.focus();
});
$('.tree_drop').click(function(){
    $.post({id:$(this).parent().attr('nodeid'),isdrop:1},function(status){
        location.reload();
    });
});

//上移/下移节点
function tree_swap_recursion(selt){
    selt.each(function(){
        var $this=$(this);
        var hasPrev=$this.prev().size();
        var hasNext=$this.next().size();

        var span=$('<span> -</span>').insertAfter($this.children('.tree_moveto'));
        var id=$this.attr('nodeid');
        if(hasPrev){
            span.append(' <a href="javascript:void(\'上移节点\');" title="上移节点" class="tree_move_up" onclick="tree_swap('+$this.prev().attr('nodeid')+','+id+')">上移</a>');
        }else{
            span.append(' <span class="gray" title="上移节点">上移</span>');
        }
        if(hasNext){
            span.append(' <a href="javascript:void(\'下移节点\');" title="下移节点" class="tree_move_down" onclick="tree_swap('+id+','+$this.next().attr('nodeid')+')">下移</a>');
        }else{
            span.append(' <span class="gray" title="下移节点">下移</span>');
        }

        tree_swap_recursion($(this).children('ul').children('li'));
    });
}
function tree_swap(id,id2){
    $.post({id:id,id2:id2,isswap:1},function(status){
        location.reload();
    });
}
tree_swap_recursion($('ul.manage_node > li'));

//移动到...
var movefrom_id=0,movefrom_parent_id=0;
function tree_moveto_recursion(selt){
    selt.each(function(){
        var $this=$(this);

        var id=$this.attr('nodeid');

        if(movefrom_id==id){
            return;
        }

        if(movefrom_parent_id!=id){
            $('<input type="button" value="移动到此处" onclick="tree_moveto('+id+','+movefrom_id+')"/>').appendTo($this.children('p'));
        }

        tree_moveto_recursion($(this).children('ul').children('li'));
    });
}
function tree_moveto(pid,id){
    $.post({id:id,pid:pid,ismove:1},function(status){
        location.reload();
    });
}
$('.tree_moveto').click(function(){
    if(movefrom_id){
        $(this).attr('title','移动到指定节点').text('移动到...');
        $('.tree_moveto').not(this).attr('disabled',false).removeClass('gray');
        $('ul.manage_node input,#tree_moveto').remove();
        movefrom_parent_id=0;
        movefrom_id=0;
        return;
    }
    $(this).attr('title','取消移动.').text('取消移动.');
    var $parent=$(this).parent(),$pparent=$parent.parent();
    movefrom_id=$parent.attr('nodeid');
    if(!$pparent.is('ul.manage_node')){
        movefrom_parent_id=$pparent.parent().attr('nodeid');
    }
    $('.tree_moveto').not(this).attr('disabled',true).addClass('gray');
    tree_moveto_recursion($('ul.manage_node > li'));
    $('ul.manage_node').after('<input id="tree_moveto" type="button" value="移动到此处" onclick="tree_moveto(0,'+movefrom_id+')"/>');
});

</script>
</body>
</html>