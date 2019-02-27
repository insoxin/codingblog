<div class="shortcodes_control">
    <p>
        <?php _e( '如果你想要使用简码请选择简码选项：', 'insoxin'); ?>
    </p>
    <div>
        <label>
            <?php _e( '选择简码', 'insoxin'); ?><span></span></label>
        <select name="items" class="shortcode_sel" size="1" onchange="document.forms.post.items_accumulated.value = this.options[selectedIndex].value;">

            <option class="parentscat">
                <?php _e( '1.标题', 'insoxin'); ?>
            </option>
            <option value="<h2 class=&quot;icon-logo&quot;><?php _e('二级标题','insoxin'); ?></h2>">
                <?php _e( '二级标题', 'insoxin'); ?>
            </option>
            <option value="<h3 class=&quot;icon-coffee&quot;><?php _e('三级标题','insoxin'); ?></h3>">
                <?php _e( '三级标题', 'insoxin'); ?>
            </option>
            <option value="<h4 class=&quot;icon-ajust&quot;><?php _e('四级标题','insoxin'); ?></h4>">
                <?php _e( '四级标题', 'insoxin'); ?>
            </option>
            <option value="<h5 class=&quot;icon-cloud&quot;><?php _e('五级标题','insoxin'); ?></h5>">
                <?php _e( '五级标题', 'insoxin'); ?>
            </option>

            <option class="parentscat">
                <?php _e( '2.消息框简码', 'insoxin'); ?>
            </option>
            <option value="[infobox]<?php _e('信息框','insoxin'); ?>[/infobox]">
                <?php _e( '信息框', 'insoxin'); ?>
            </option>
            <option value="[successbox]<?php _e('成功框','insoxin'); ?>[/successbox]">
                <?php _e( '成功框', 'insoxin'); ?>
            </option>
            <option value="[warningbox]<?php _e('警告框','insoxin'); ?>[/warningbox]">
                <?php _e( '警告框', 'insoxin'); ?>
            </option>
            <option value="[errorbox]<?php _e('错误框','insoxin'); ?>[/errorbox]">
                <?php _e( '错误框', 'insoxin'); ?>
            </option>

            <option class="parentscat">3.按钮简码
                <?php _e( '简码', 'insoxin'); ?>
            </option>
            <option value="[scbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;red&quot;]<?php _e('按钮红色','insoxin'); ?>[/scbutton]">
                <?php _e( '红色', 'insoxin'); ?>
            </option>
            <option value="[scbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;yellow&quot;]<?php _e('按钮黄色','insoxin'); ?>[/scbutton]">
                <?php _e( '黄色', 'insoxin'); ?>
            </option>
            <option value="[scbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;blue&quot;]<?php _e('按钮蓝色','insoxin'); ?>[/scbutton]">
                <?php _e( '蓝色', 'insoxin'); ?>
            </option>
            <option value="[scbutton link=&quot;#&quot; target=&quot;blank&quot; variation=&quot;green&quot;]<?php _e('按钮绿色','insoxin'); ?>[/scbutton]">
                <?php _e( '绿色', 'insoxin'); ?>
            </option>

            <option class="parentscat">
                <?php _e( '4.列表简码', 'insoxin'); ?>
            </option>
            <option value="[ssredlist]<ul> <li><?php _e('列表简码小红点','insoxin'); ?></li> <li><?php _e('列表简码','insoxin'); ?></li> <li><?php _e('姬长信','insoxin'); ?></li> </ul>[/ssredlist]">
                <?php _e( '小红点', 'insoxin'); ?>
            </option>
            <option value="[ssyellowlist]<ul> <li><?php _e('列表简码小黄点','insoxin'); ?></li> <li><?php _e('姬长信','insoxin'); ?></li> <li><?php _e('姬长信','insoxin'); ?></li> </ul>[/ssyellowlist]">
                <?php _e( '小黄点', 'insoxin'); ?>
            </option>
            <option value="[ssbluelist]<ul> <li><?php _e('列表小蓝点','insoxin'); ?></li> <li><?php _e('姬长信','insoxin'); ?></li> <li><?php _e('姬长信','insoxin'); ?></li> </ul>[/ssbluelist]">
                <?php _e( '小蓝点', 'insoxin'); ?>
            </option>
            <option value="[ssgreenlist]<ul> <li><?php _e('列表小绿点','insoxin'); ?></li> <li><?php _e('姬长信','insoxin'); ?></li> <li><?php _e('姬长信','insoxin'); ?></li> </ul>[/ssgreenlist]">
                <?php _e( '小绿点', 'insoxin'); ?>
            </option>

            <option class="parentscat">
                <?php _e( '5.其它简码', 'insoxin'); ?>
            </option>
            <option value="[swf]<?php _e('flash地址','insoxin'); ?>[/swf]]">
                <?php _e( 'flash', 'insoxin'); ?>
            </option>
            <option value="[tabgroup][tab title=&quot;<?php _e('标题','insoxin'); ?> 1&quot; id=&quot;1&quot;]<?php _e('内容','insoxin'); ?> 1[/tab][tab title=&quot;<?php _e('标题','insoxin'); ?> 2&quot; id=&quot;2&quot;]<?php _e('内容','insoxin'); ?> 2[/tab] [tab title=&quot;<?php _e('标题','insoxin'); ?> 3&quot; id=&quot;3&quot;]<?php _e('内容','insoxin'); ?> 3[/tab] [tab title=&quot;<?php _e('标题','insoxin'); ?> 4&quot; id=&quot;4&quot;]<?php _e('内容','insoxin'); ?> 4[/tab][/tabgroup]">TABS</option>
            <option value="[toggle_box][toggle_item title=&quot;<?php _e('标题','insoxin'); ?> 1&quot; active=&quot;true&quot;]<?php _e('内容','insoxin'); ?> 1[/toggle_item][toggle_item title=&quot;<?php _e('标题','insoxin'); ?> 2&quot;]<?php _e('内容','insoxin'); ?> 2[/toggle_item][toggle_item title=&quot;<?php _e('标题','insoxin'); ?> 3&quot;]<?php _e('内容','insoxin'); ?> 3[/toggle_item][toggle_item title=&quot;<?php _e('标题','insoxin'); ?> 4&quot;]<?php _e('内容','insoxin'); ?> 4[/toggle_item][/toggle_box]">
                <?php _e( '开关菜单', 'insoxin'); ?>
            </option>
            <option value="[related_posts tagid=&quot;5&quot;]">
                <?php _e( '标签相关文章', 'insoxin'); ?>
            </option>
            <option value="[reply]评论后可见内容[/reply]">
                <?php _e( '评论后可见内容', 'insoxin'); ?>
            </option>
            <option value="[private]只有用户才能看到的内容[/private]">
                <?php _e( '用户查看的内容', 'insoxin'); ?>
            </option>
            <option value="[buy product_id=&quot;<?php _e('产品 ID','insoxin'); ?>&quot;]<?php _e('购买产品才能查看的内容','insoxin'); ?>[/buy]">
                <?php _e( '购买产品才能查看的内容', 'insoxin'); ?>
            </option>

        </select>
        <label>
            <?php _e( '简码预览', 'insoxin'); ?><span><?php _e('简(在编辑框中复制简码)码','insoxin'); ?></span></label>
        <p>
            <textarea name="items_accumulated" rows="4"></textarea>
        </p>
    </div>
</div>