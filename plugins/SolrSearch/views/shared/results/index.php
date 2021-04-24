<?php
/**
 * @package     omeka
 * @subpackage  solr-search
 * @copyright   Jonathan Candelaria
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */
?>
<?php queue_css_file('results'); ?>
<?php echo head(array('title' => __('Solr Search')));?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 id="collection-search-label"><?php echo __('Search Within Results'); ?></h2>
            <!-- Search form. -->
            <div class="solr">
                <form id="solr-search-form">
                    <input type="submit" value="Search" />
                    <span class="float-wrap">
                        <input type="text" title="<?php echo __('Search keywords') ?>" name="q" value="<?php echo array_key_exists('q', $_GET) ? $_GET['q'] : ''; ?>" />
                    </span>
                </form>
            </div>
            <!-- Applied facets. -->
            <div id="solr-applied-facets">
                <ul>
                <!-- Get the applied facets. -->
                <?php foreach (SolrSearch_Helpers_Facet::parseFacets() as $f): ?>
                    <li>
                        <!-- Facet label. -->
                        <?php $label = SolrSearch_Helpers_Facet::keyToLabel($f[0]); ?>
                        <span class="applied-facet-label"><?php echo $label; ?></span>
                        <span class="applied-facet-value"><?php echo $f[1]; ?></span>
                        <!-- Remove link. -->
                        <?php $url = SolrSearch_Helpers_Facet::removeFacet($f[0], $f[1]); ?>
                        (<a href="<?php echo $url; ?>">remove</a>)
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
            <!-- Facets. -->
            <div id="solr-facets">
                <h3><?php echo __('Limit your search'); ?></h3>
                <?php foreach ($results->facet_counts->facet_fields as $name => $facets): ?>
                    <!-- Does the facet have any hits? -->
                    <?php if (count(get_object_vars($facets))): ?>
                        <div class="facet">
                            <!-- Facet label. -->
                            <?php $label = SolrSearch_Helpers_Facet::keyToLabel($name); ?>
                            <strong>
                                <?php echo $label; ?>
                                <span class="facet-group-count">(<?php echo count(get_object_vars($facets))?>)<span>
                            </strong>
                            <ul>
                            <!-- Facets. -->
                                <?php foreach ($facets as $value => $count): ?>
                                    <li class="<?php echo $value; ?>">
                                        <!-- Facet URL. -->
                                        <?php $url = SolrSearch_Helpers_Facet::addFacet($name, $value); ?>
                                        <!-- Facet link. -->
                                        <a href="<?php echo $url; ?>" class="facet-value">
                                            <?php echo $value; ?>
                                        </a>
                                        <!-- Facet count. -->
                                        (<span class="facet-count"><?php echo $count; ?></span>)
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Results. -->
            <div id="solr-results">
                <!-- Number found. -->
                <h3 id="num-found">
                    <?php echo $results->response->numFound; ?> results
                </h3>
                <?php foreach ($results->response->docs as $doc): ?>
                    <!-- Document. -->
                    <div class="result">
                        <!-- Header. -->
                        <div class="result-header">
                            <!-- Record URL. -->
                            <?php $url = SolrSearch_Helpers_View::getDocumentUrl($doc); ?>
                            <!-- Title. -->
                            <a href="<?php echo $url; ?>" class="result-title"><?php
                                $title = is_array($doc->title) ? $doc->title[0] : $doc->title;
                                if (empty($title)) {
                                    $title = '<i>' . __('Untitled') . '</i>';
                                }
                                echo $title;?>
                            </a>
                            <!-- Result type. -->
                            <span class="result-type">(<?php echo $doc->resulttype; ?>)</span>
                        </div>
                        <!-- Highlighting. -->
                        <?php if (get_option('solr_search_hl')): ?>
                            <ul class="hl">
                                <?php foreach($results->highlighting->{$doc->id} as $field): ?>
                                    <?php foreach($field as $hl): ?>
                                        <li class="snippet"><?php echo strip_tags($hl, '<em>'); ?></li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <!-- This is where the thumbnail and encapsulating gallery div is created -->
                        <?php
                            $item = get_db()->getTable($doc->model)->find($doc->modelid);
                            
                            $itemElements = all_element_texts($item, array('return_type' => 'array'));
                            $itemType = $itemElements['Dublin Core']['Type'][0];
                            //echo($itemType);
                            //print_r($itemElements);
                            
                            
                            echo item_image_gallery(
                                array('wrapper' => array('class' => 'gallery')),
                                'square_thumbnail', false, $item
                            );
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php echo pagination_links(); ?>
        </div>
    </div>
</div>
<?php echo foot();
