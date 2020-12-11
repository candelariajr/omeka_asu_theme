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

<?php echo item_search_filters(); ?>

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
    <div class="card-columns">
    <?php foreach (loop('items') as $item): ?>
        <div class="card">
            <h2 class="card-title"><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>
            <hr>
            <?php if (metadata('item', 'has files')): ?>
                <div class="card-img-top">
                    <?php echo link_to_item(item_image('square_thumbnail')); ?>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
                    <div class="card-text item-description">
                        <?php echo $description; ?>
                    </div>
                <?php endif; ?>
                <?php if (metadata('item', 'has tags')): ?>
                    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                        <?php echo tag_string('items'); ?></p>
                    </div>
                <?php endif; ?>
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
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
