<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes" />
    <?php if ($description = option('description')): ?>
        <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>
    <!-- Stylesheets -->
    <?php
    queue_css_file(array('bootstrap-grid', 'bootstrap','style'));
    echo head_css();
    ?>
    <!-- JavaScripts -->
    <?php queue_js_file('jquery-3.2.1.min', 'javascripts'); ?>
    <?php queue_js_file('Popper', 'javascripts'); ?>
    <?php queue_js_file('bootstrap', 'javascripts'); ?>
    <?php //queue_js_file('bootstrap.bundle', 'javascripts'); ?>
    <?php echo head_js(); ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<!--Generate Admin/Login Bar-->
<div class="custom-admin-container-top">
    <div class="container">
        <div class="row">
            <div class="col d-block d-sm-block d-md-none d-lg-none d-xl-none">
                <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
            </div>
        </div>
    </div>
</div>

<div class="custom-top-search">
    <div class="container">
        <div class="row">
            <div class="col d-none d-sm-none d-md-none d-lg-block col-lg-2 d-xl-block col-xl-2">
                <a href="http://appstate.edu" title="ASU">
                    <img src="http://localhost/omeka_themes/files/custom/small_logo.png" alt="ASU" class="custom-top-logo">
                </a>
            </div>
            <div class=" custom-admin-container-mid col d-none d-sm-none d-md-block d-lg-block d-xl-block">
                <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
            </div>
            <div class="col custom-search-box">
                <form class="form-inline custom-form">
                    <div class="input-group">
                        <label for="query" class="sr-only"></label>
                        <input type="text" name="query" placeholder="Search..." class="form-control" aria-label="Search terms" id="query" required>
                        <div class="input-group-append">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="form-check form-row">
                                    <input class="form-check-input col-1" type="radio" name="query_type" id="query_type-keyword" value="keyword" checked="checked">
                                    <label class="form-check-label col-8"  for="query_type-keyword">
                                        Keyword
                                    </label>
                                </div>
                                <div class="form-check form-row">
                                    <input class="form-check-input col-1" type="radio" name="query_type" id="query_type-boolean" value="boolean">
                                    <label class="form-check-label col-8" for="query_type-boolean">
                                        Boolean
                                    </label>
                                </div>
                                <div class="form-check form-row">
                                    <input class="form-check-input col-1" type="radio" name="query_type" id="query_type-exact_match" value="exact_match">
                                    <label class="form-check-label col-8" for="query_type-exact_match">
                                        Exact Match
                                    </label>
                                </div>
                                <hr>
                                <div>
                                    <div class="form-check form-row">
                                        <input class="form-check-input col-1" type="checkbox" name="record_types[]" id="record_types-Item" value="Item" checked="checked">
                                        <label class="form-check-label col-8" for="record_types-Item">
                                            Item
                                        </label>
                                    </div>
                                    <div class="form-check form-row">
                                        <input class="form-check-input col-1" type="checkbox" name="record_types[]" id="record_types-File" value="File" checked="checked">
                                        <label class="form-check-label col-8" for="record_types-File">
                                            File
                                        </label>
                                    </div>
                                    <div class="form-check form-row">
                                        <input class="form-check-input col-1" type="checkbox" name="record_types[]" id="record_types-Collection" value="Collection" checked="checked">
                                        <label class="form-check-label col-8" for="record_types-Collection">
                                            Collection
                                        </label>
                                    </div>
                                    <div class="form-check form-row">
                                        <input class="form-check-input col-1" type="checkbox" name="record_types[]" id="record_types-Exhibit" value="Exhibit" checked="checked">
                                        <label class="form-check-label col-8" for="record_types-Exhibit">
                                            Exhibit
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-check form-row">
                                    <div class="form-check-label col-8">
                                        <a href="/AdvancedSearch">Advanced Search</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" class="btn">
                                Go
                            </button>
                        </div>
                    </div>
                </form>
                <script>
                    jQuery("label, .dropdown-menu, fieldset").bind('click', function(e){
                        e.stopPropagation();
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<div class="custom-nav-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="#">
                        <h4 class="custom-site-name-bar">Digital Collections</h4>
                    </a>
                    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler0" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarToggler0">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                            <!--
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>
                            -->
                            <li class="nav-item">
                                <a class="nav-link" style="color: #ffc900 !important" href="../../items/browse">Browse Items</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #ffc900 !important" href="../../exhibits">Browse Exhibits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #ffc900 !important" href="../../collections">Browse Collections</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #ffc900 !important" href="../../about">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #ffc900 !important" href="../../contact">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: #ffc900 !important" href="../../copyright">Copyright Info</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
