### 家谱源码familytree php+mysqli 二叉树左右值 

 **由于本人技术有限，PHP会的连皮毛都算不上，所以需要家谱系统爱好者及精通PHP的朋友来不断完善本系统，本系统会不定期更新，秉承自由共享精神尽我所能来一步步实现未实现的功能，不论三年还是五载……** </br>

[php版本7.4 数据库名链接修改首页及admin的conn.php文件即可，后台登录账号admin密码lsc123如需修改请在admin目录下的login.php文件进行修改</br>

  **  **一、** ** 已实现功能 源码无架构，目前有族谱树、欧式族谱、塔式族谱、ztree样式 、excel（可接入传承家谱）、word现代版家谱六种样式，其中族谱树有详情页传值单独页面</br>

  **  **二、** ** 目前存在的问题需要优化 </br>

1、欧式族谱样式实现的仅单页，数据还没自动生成</br>  

2、实现数据导出pdf或word输出 

四、远期计划 

1、实现多用户多姓氏的数据展示 

2、实现合谱

3、实现数据比对寻源</br>

  ** **  五、** ** 
本人不会php，代码都东拼西凑，php7.4的代码基本都是chatgtp3.5完成的，禁止将代码用于商业行为</br>

 ** ** 六、 ** **  ztree样式（ztree连接sql动态版）需下载ztree_v3到根目录，ztree下载地址：https://gitee.com/zTree/zTree_v3</br>

familytree家谱宗谱刘三才族裔刘氏家谱</br>

http://demo.tvsbar.com/index.php</br>

欧式版式家谱 http://127.0.0.1/type/os.php </br>

塔式版式家谱 http://127.0.0.1/type/bt.php </br>

ztree样式  http://127.0.0.1/type/ztree.html </br>
ebook样式  http://127.0.0.1/type/ebook/laopu </br>

 **word现代版家谱** (一个树，多个树见注释）  http://127.0.0.1/type/word.php</br>


 **word现代版家谱** (标准家谱 按世代顺序 一次输出） http://127.0.0.1/type/word2.php</br>


 **word现代版家谱** (备用家谱 按一房人输出后再输出另外的一房人） http://127.0.0.1/type/word3.php</br>
### 关键代码

**7代人输出样式（欧式、苏式、word版样式关键代码-20230430）http://127.0.0.1/type/7id.php**  </br>

**根据id自定义输出几代人样式（印刷出谱欧式、苏式、word版样式关键代码-20230430）http://127.0.0.1/type/7nid.php**  </br>

电视直播 http://www.tvsbar.com</br>

更新日志</br>

20180816 首次上传源码</br>
20231231 更新源码</br>
 **本次更新告一段落，根据需求慢慢一步一步实现，有问题请邮箱联系1517152664#qq.com  :zzz: 

by 爱视传媒tvsbar 20231231 tvsbar@qq.com</br>

![输入图片说明](https://images.gitee.com/uploads/images/2020/0319/142833_ef090f88_1349966.png "QQ截图20200319142722.png") 
![输入图片说明](https://images.gitee.com/uploads/images/2020/0319/142947_0a2d4a47_1349966.png "QQ截图20200319142528.png")
![输入图片说明](https://images.gitee.com/uploads/images/2020/0319/143023_082a9836_1349966.png "QQ截图20200319142627.png")
![输入图片说明](https://images.gitee.com/uploads/images/2020/0319/143012_37502031_1349966.png "QQ截图20200319142346.png")
![输入图片说明](https://images.gitee.com/uploads/images/2020/0319/143053_6fe3090b_1349966.png "QQ截图20200319142257.png")
![输入图片说明](https://images.gitee.com/uploads/images/2020/0319/143134_9cfd2c87_1349966.png "QQ截图20200319142237.png")
![输入图片说明](https://images.gitee.com/uploads/images/2020/0319/143123_4681e884_1349966.png "QQ截图20200319142133.png")