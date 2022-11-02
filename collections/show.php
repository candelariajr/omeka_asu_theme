<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
?>
<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>
<div class="header-subtext">
    <div class="container">
        <div class="row">
            <div class="col">
		<h4 class="header-subtext-text-padding" alt="<?php echo $collectionTitle; ?>" title="<?php echo $collectionTitle;?>"><?php echo $collectionTitle;?></h4>
            </div>
        </div>
    </div>
</div>
<?php if($collectionDescription = strip_formatting(metadata('collection', array('Dublin Core', 'Description')))): ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
		<p class='collection-description' alt='<?php echo $collectionDescription; ?>' title='<?php echo $collectionDescription;?>'><?php echo $collectionDescription; ?></p>
            </div>
        </div>
   </div>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col">
	    <br> <?php $adaTitle = "Link to Items From ".$collectionTitle." Collection"; ?>   
	    <h5 alt="<?php echo $adaTitle;?>" title="<?php echo $adaTitle?>"><?php echo link_to_items_browse(__('Select items from the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h5>
        </div>
    </div>
</div>
<div class="container">
    <?php if (metadata('collection', 'total_items') > 0): ?>
        <?php foreach (loop('items') as $item): ?>
            <div class="item" alt="This is an Item" title="This is an Item">
                <?php  $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?> 
                <?php if (metadata('item', 'has thumbnail')):?>
                    <div class="item-img" alt="Thumbnail Image of Item" title="Thumbnail Image of Item">
                        <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle, 'title' => $itemTitle))); ?>
                    </div>
                <?php endif; ?>
                <div class="item-info">
                    <h4 alt="Link to Item Page" title="Link to Item Page"><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h4>
                    <?php if ($itemDescription = metadata('item', array('Dublin Core', 'Description'))): ?>
                        <div class="item-description">
                            <?php echo $itemDescription;?>
                        </div>
                    <?php endif; ?>
                    <?php if ($tags = tag_string('item', 'items')):?>
                        <div>
                            <p class="tags" alt="List of Tags" title= "List of Tags"><?php echo __('Tags: ') . $tags ?></p>
			</div>       
                    <?php endif; ?>
                </div>
            </div>
	<?php endforeach; ?>
        <script>
            $('.tags a').each(function(){
		    $(this).attr('title', $(this).text());
		    $(this).attr('alt', $(this).text());
	    })
        </script>
    <?php else: ?>
        <?php echo __("There are currently no items within this collection."); ?>
    <?php endif; ?>
</div>
<?php //fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>
<?php echo foot(); ?>
