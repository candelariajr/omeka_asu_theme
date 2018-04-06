<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 4/4/2018
 * Time: 1:07 PM
 */
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
$exhibitNavOption = get_theme_option('exhibits_nav');
?>
<div class="custom-exhibit-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 id="custom-exhibit-title-container"><?php //echo $title;
                    echo exhibit_builder_link_to_exhibit($exhibit);?></h2>
            </div>
        </div>
    </div>
</div>
<div class="custom-exhibit-subtitle">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<hr>-->
                <h4 id="currentPage"><?php echo metadata('exhibit_page', 'title');?></h4>
            </div>
        </div>
    </div>
</div>
<div class="custom-exhibit-nav">
    <div class="container">
        <div class="row">
            <div class="col-4 col-md-3 col-lg-2 d-none d-sm-block">
                <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
                    <div class="custom-exhibit-nav-button">
                        <?php echo $prevLink; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col custom-exhibit-nav-center">
            </div>
            <div class="col-4 col-md-3 col-lg-2 d-none d-sm-block">
                <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
                    <div class="custom-exhibit-nav-button">
                        <?php echo $nextLink; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="custom-main-content">
    <div class="container">
        <div class="row">
            <div id="page-content" class="col-12 order-1 col-sm-8 col-md-9 order-sm-2 order-md-2 order-lg-2">
                <br>
                <div role="main" id="exhibit-blocks">
                    <?php exhibit_builder_render_exhibit_page(); ?>
                </div>
                <script>
                    $("a.download-file").each(function(){
                        var downloadLink = $(this).attr('href');
                        /*
                        * Turn this: /omeka_themes/exhibits/show/mem/item/5
                        * into this: /omeka_themes/items/show/9
                        * */
                        var newComponents = downloadLink.split("/");
                        //console.log("/" + newComponents[1] + "/items/show/" + newComponents[6]);
                        var newURL = "/" + newComponents[1] + "/items/show/" + newComponents[6];
                        $(this).attr('href', newURL);
                    })
                </script>
            </div>
            <aside id="sidebar-first" class="col-12 order-2 col-sm-4 col-md-3 order-sm-1 order-md-1 order-lg-1">
                <?php
                $pageTree = exhibit_builder_page_tree();
                if ($pageTree):
                    echo $pageTree;?>
                <?php endif; ?>
                <script>
                    $("#sidebar-first > ul").each(function(){
                        $(this).addClass("nav nav-pills flex-column");
                        $(this).find("li").addClass("nav-item");
                        $(this).find("a").addClass("nav-link");
                        $(this).find("a").each(function(){
                            $(this).addClass("nav-link");
                            var compareText = $("#currentPage").text();
                            if($(this).text() === compareText){
                                $(this).addClass("active");
                            }
                        });
                        $(this).find("ul").addClass("nav nav-pills flex-column custom-nest");
                    })
                </script>
            </aside>
        </div>
    </div>
</div>
<?php echo foot(); ?>