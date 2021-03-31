<?php
    $pageTitle = __('Browse Collections collections\browse.php');
    echo head(array('title'=>$pageTitle, 'bodyid' => 'collections', 'bodyclass' => 'browse'));
    $displayFeaturedCollection = get_theme_option('Display Featured Collection');
    $randomCollectionView = "";
    $featuredContentEnabled = false;
    if($displayFeaturedCollection){
        $randomCollectionView = random_featured_collection();
        $featuredContentEnabled = true;
    }
?>
<div class="header-subtext">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h4 class="header-subtext-text-padding">Browse Collections <?php echo __('(%s total)', $total_results); ?></h4>
            </div>
            <div class="col-7">
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <?php if ($displayFeaturedCollection): ?>
                <div>
                    <div id="featured-collection" class="featured">
                        <h3><?php echo __('Featured Collection'); ?></h3>
                        <?php echo $randomCollectionView; ?>
                    </div><!-- end featured collection -->
                </div>
            <?php endif; ?>
            <?php foreach (loop('collections') as $collection): ?>
                <div class="item">
                    <?php if ($collectionImage = record_image('collection', 'square_thumbnail')): ?>
                        <div class="item-img">
                            <?php echo link_to_collection($collectionImage, array('class' => 'image collection-img'))."<br>"; ?>
                        </div>
                    <?php endif; ?>
                    <div class="item-info">
                        <h4><?php echo link_to_collection(); ?></h4>
                        <div class="item-description>
                            <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
                                <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
                            <?php endif; ?>
                            <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))),
                                array('collection' => metadata('collection', 'id'))); ?>
                            <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>
        </div>
    </div>
</div>

<div class="footer-controls">
    <div class="container">
        <div class="row">
            <div class="col-5 d-none d-lg-block">
                <?php echo pagination_links(); ?>
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
    </div>
</div>
<?php if (get_theme_option('Display Featured Collection')): ?>
    <?php //echo __('Featured Collection'); ?>
    <?php //echo random_featured_collection(); ?>
<?php endif; ?>
<?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <?php //echo exhibit_builder_display_random_featured_exhibit(); ?>
<?php endif; ?>
<?php echo foot(); ?>
