=== WP-Baidu-Record ===
Contributors: ZhangGe
Donate link: http://zhangge.net/about/
Tags: WP-Baidu-Record,百度收录查询
Requires at least: 3.0
Tested up to: 4.6
Stable tag: 1.0.7
License: GPLv2 or later
License URI: http://zhangge.net/4726.html

The Baidu Record Checkout Wordpress Plugin. WordPress百度是否已收录查询插件

== Description ==

Added Baidu Record Check result for The Single of Wordpress blog. 在WordPress文章页面添加一个百度是否收录的查询和显示功能。

插件特色    
这个功能实际上已有人开发了插件，我只是在原来的基础上做了一些改进，具体如下：

1. 原版特性：通过curl在百度查询本页url并获取结果，如果存在就输出已收录，否则就是未收录，并且可点击提交url

2. 原版缺点：每次打开页面都需要在百度查询一遍，严重拖慢速度！当然可以利用缓存插件解决此问题。

改进特性：

i. 通过curl在百度查询url收录结果，如果已收录就将结果写入到文章的post meta记录中。待下一次再次打开页面时，先检查文章自定义栏目字段来判断是否已收录，若已收录则直接输出，而不再执行curl查询，从而解决了curl实时查询拖慢速度的问题！

ii. 若查询结果为已收录，亦会输出一个在百度查询文章标题的a标签，用于查看文章排名，甚至可以查看是否被人转载或篡改！

iii. 管理员可以随时在后台文章编辑界面中的自定义栏目来修改是否已收录的结果，自定义名称为baidu_record,1为已收录，0为未收录。
        
改进之后，如果是已收录的文章，将不会重复查询，从而解决了原版代码严重拖慢网站速度的缺憾，希望大家喜欢！

详情请浏览：[http://zhangge.net/4726.html](http://zhangge.net/4726.html)

== Installation ==

可以通过以下两种方法的其中一种来安装wp-baidu-record 插件：

1. 将下载的文件解压缩，然后将`wp-baidu-record`文件夹 上传到 `/wp-content/plugins/`目录，在插件后台启用即可

2. 直接在后台-安装插件，搜索'wp-baidu-record'，按照提示安装启用


== Frequently Asked Questions ==

1. 若发现插件使用问题，请到插件主页留言[http://zhangge.net/4718.html](http://zhangge.net/4718.html)

Best Regards！

== Screenshots ==

1. Screenshot-install

2. Screenshot-record 

3. Screenshot-unrecord
 
== Changelog ==

= 1.0.7 =

* 修复特殊场景获取页面地址函数错误问题

= 1.0.6 =

* 彻底修复判断是否收录不准确问题

= 1.0.4 =

* 修复判断是否收录不准确问题（若还有问题请反馈）

= 1.0.3 =

* 修复一个无法显示的BUG

= 1.0.2 =

* 修复调用函数

= 1.0.1 =

* 修复启用插件时会报异常信息的BUG（其实无任何影响）

= 1.0.0 =

* 发布 wp-baidu-record 插件

== Upgrade notice ==

* 插件首次发布，有任何问题请至插件主页反馈，非常感谢！

== Arbitrary section 1 ==
