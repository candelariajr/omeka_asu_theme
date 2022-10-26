<?php
$pageTitle = __('Browsing Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse')); ?>
<div class="header-subtext">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h4 class="header-subtext-text-padding"><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h4>
            </div>
            <div class="col-7">
                <nav class="browse-navigation">
                    <?php echo public_nav_items(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<br>
<?php if ($total_results > 0): ?>
<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date Added')] = 'added';
?>
<!--
These are the sortlinks. They have been removed for some reason.
<div id="sort-links">
    <span class="sort-label"><?php //echo __('Sort by: '); ?></span><?php //echo browse_sort_links($sortLinks); ?>
</div>-->
<?php endif; ?>
<div class="container">
    <?php echo item_search_filters(); ?>
    <?php foreach (loop('items') as $item): ?>
        <div class="item">
            <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
            <?php if (metadata('item', 'has thumbnail')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?>
                </div>
            <?php endif; ?>
            <div class="item-info">
                <h4><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h4>
                <?php if ($itemDescription = metadata('item', array('Dublin Core', 'Description'))) :?>
                    <div class="item-description">
                        <?php echo $itemDescription; ?>
                    </div>
                <?php endif; ?>
                <?php if($tags = tag_string('item', 'items')): ?>
		    <div>
                        <p class="tags"><?php echo __('Tags: ') . $tags ?></p>
                    </div>
                <?php endif; ?>
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="footer-controls">
    <div class="container">
        <div class="row">
            <div class="col-5 d-none d-lg-block">
                <?php echo pagination_links(); ?>
            </div>
            <div class="col-7 d-none d-lg-block">
                <div id="outputs">
                    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
                    <?php echo output_format_list(false); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-controls-mobile">
    <div class="container">
        <div class="row">
            <div class="col d-lg-none">
                <?php echo pagination_links(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col d-lg-none">
                <div id="outputs">
                    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
                    <?php echo output_format_list(false); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>
<?php echo foot(); ?>
