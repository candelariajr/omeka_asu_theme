COLLECTIONS\SHOW.PHP
<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
?>
<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>
<?php echo $colectionTitle; ?>
<?php echo strip_formatting(metadata('collection', array('Dublin Core', 'Description'))); ?>
<?php echo link_to_items_browse(__('Select items from the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?>
<?php if (metadata('collection', 'total_items') > 0): ?>
    <?php foreach (loop('items') as $item): ?>
        <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
        <?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?>
        <?php if (metadata('item', 'has thumbnail')): ?>
            <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php else: ?>
    <?php echo __("There are currently no items within this collection."); ?>
<?php endif; ?>
<?php //fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>
END COLLECTIONS\SHOW.PHP
<?php echo foot(); ?>
