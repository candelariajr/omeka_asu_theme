<?php
    $pageTitle = __('Browse Collections collections\browse.php');
    echo head(array('title'=>$pageTitle, 'bodyid' => 'collections', 'bodyclass' => 'browse'));
?>
<?php echo $pageTitle; ?>
<?php echo __('(%s total)', $total_results); ?>
<?php foreach (loop('collections') as $collection): ?>
    <?php if ($collectionImage = record_image('collection', 'square_thumbnail')): ?>
        <?php echo link_to_collection($collectionImage, array('class' => 'image collection-img')); ?>
    <?php endif; ?>
    <?php echo link_to_collection(); ?>
    <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
         <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
    <?php endif; ?>
    <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))),
        array('collection' => metadata('collection', 'id'))); ?>
    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
<?php endforeach; ?>
<?php echo pagination_links(); ?>
<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>
<?php if (get_theme_option('Display Featured Collection')): ?>
    <?php echo __('Featured Collection'); ?>
    <?php echo random_featured_collection(); ?>
<?php endif; ?>
<?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
<?php endif; ?>
<?php echo foot(); ?>
