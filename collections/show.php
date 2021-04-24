<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
?>
<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>
<div class="header-subtext">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="header-subtext-text-padding"><?php echo $collectionTitle;?></h4>
            </div>
        </div>
    </div>
</div>
<?php if($collectionDescription = strip_formatting(metadata('collection', array('Dublin Core', 'Description')))): ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <p><?php echo $collectionDescription; ?></p>
            </div>
        </div>
   </div>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <br>    
            <h5><?php echo link_to_items_browse(__('Select items from the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h5>
        </div>
    </div>
</div>
<div class="container">
    <?php if (metadata('collection', 'total_items') > 0): ?>
        <?php foreach (loop('items') as $item): ?>
            <div class="item">
                <?php  $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?> 
                <?php if (metadata('item', 'has thumbnail')):?>
                    <div class="item-img">
                        <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?>
                    </div>
                <?php endif; ?>
                <div class="item-info">
                    <h4><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h4>
                    <?php if ($itemDescription = metadata('item', array('Dublin Core', 'Description'))): ?>
                        <div class="item-description">
                            <?php echo $itemDescription;?>
                        </div>
                    <?php endif; ?>
                    <?php if ($tags = tag_string('item', 'items')):?>
                        <div>
                            <p class="tags"><?php echo __('Tags: ') . $tags ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <?php echo __("There are currently no items within this collection."); ?>
    <?php endif; ?>
</div>
<?php //fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>
<?php echo foot(); ?>
