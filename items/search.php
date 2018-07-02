<?php
$pageTitle = __('Search Items');
echo head(array('title' => $pageTitle,
           'bodyclass' => 'items advanced-search'));
?>
ITEMS\SEARCH.PHP
<h1><?php echo $pageTitle; ?></h1>

<nav class="search-navigation">
    <?php echo public_nav_items(); ?>
</nav>
<br/><br/>
<?php echo $this->partial('items/search-form.php',
    array('formAttributes' =>
        array('id'=>'advanced-search-form'))); ?>
END ITEMS\SEARCH.PHP
<?php echo foot(); ?>
