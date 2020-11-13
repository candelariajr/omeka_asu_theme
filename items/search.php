<?php
$pageTitle = __('Search Items');
echo head(array('title' => $pageTitle,
           'bodyclass' => 'items advanced-search'));
?>
<div class="header-subtext">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h4 class="header-subtext-text-padding"><?php echo $pageTitle; ?></h4>
            </div>
            <div class="col-7">
                <nav class="search-navigation">
                    <?php echo public_nav_items(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<br/><br/>
<div class="container">
    <div class="row">
        <div class="col">
            <?php echo $this->partial('items/search-form.php',
                array('formAttributes' =>
                    array('id'=>'advanced-search-form'))); ?>
        </div>
        <script>
            $(".field").each(function(){
                //this.addClass("form-group");
            });
        </script>
    </div>
</div>
<?php echo foot(); ?>
