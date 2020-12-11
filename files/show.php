<?php
    echo head();
?>
<!--
File #26: "1-U-ZIk9StToMYfTt_I-vA_r.jpg"
1-U-ZIk9StToMYfTt_I-vA_r.jpg

Item
    The Lone Meme (link)
Format Metadata
    Original Filename
        1-U-ZIk9StToMYfTt_I-vA_r.jpg
    File Size
        122584 bytes
    Authentication
        5957e3701739ce1987f41ecc29a94047
Type Metadata
    Mime Type
        image/jpeg
    File Type / OS
-->
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <h3>File Metadata for: <?php echo metadata('file', 'original filename');?></h3><br>
            <?php echo file_image("fullsize", array(), null)?><br><br>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2><?php echo __('Item'); ?></h2>
            <?php echo link_to_item(null, array(), 'show', $file->getItem()); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div id="format-metadata">
                <h2><?php echo __('Format Metadata'); ?></h2>
                <div id="original-filename" class="element">
                    <h3><?php echo __('Original Filename'); ?></h3>
                    <div class="element-text"><?php echo metadata('file', 'Original Filename'); ?></div>
                </div>

                <div id="file-size" class="element">
                    <h3><?php echo __('File Size'); ?></h3>
                    <div class="element-text"><?php echo __('%s bytes', metadata('file', 'Size')); ?></div>
                </div>

                <div id="authentication" class="element">
                    <h3><?php echo __('Authentication'); ?></h3>
                    <div class="element-text"><?php echo metadata('file', 'Authentication'); ?></div>
                </div>
            </div><!-- end format-metadata -->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div id="type-metadata">
                <h2><?php echo __('Type Metadata'); ?></h2>
                <div id="mime-type-browser" class="element">
                    <h3><?php echo __('Mime Type'); ?></h3>
                    <div class="element-text"><?php echo metadata('file', 'MIME Type'); ?></div>
                </div>
                <div id="file-type-os" class="element">
                    <h3><?php echo __('File Type / OS'); ?></h3>
                    <div class="element-text"><?php echo metadata('file', 'Type OS'); ?></div>
                </div>
            </div><!-- end type-metadata -->
        </div>
    </div>
</div>
<?php echo foot();?>
