<?php
function find_random_item($params = array())
{
    $db = get_db();
    $table = $db->getTable('Item');

    $select = new Omeka_Db_Select;
    $select->from(array('i'=>$db->Item), array('i.*'));
    $select->from(array(), 'RAND() as rand');
    $select->order('rand DESC');

    if ($params['withImage']) {
        $select->joinLeft(array('f'=>"$db->File"), 'f.item_id = i.id', array());
        $select->where('f.has_derivative_image = 1');
    }

    $table->applySearchFilters($select, $params);

    $select->limit(1);

    $item = $table->fetchObject($select);

    return $item;
}

function display_random_featured_collection_with_item()
{
    $featuredCollection = random_featured_collection();
    $html = '<h2>Featured Collection</h2>';
    if ($featuredCollection) {

        $item = find_random_item(array('withImage' => true, 'collection' => $featuredCollection->id));

        $html .= '<h3>' . link_to_collection($collectionTitle, array(), 'show', $featuredCollection) . '</h3>';
        if (item_has_thumbnail($item)) {
            $html .= link_to_item(item_square_thumbnail(array(), 0, $item), array('class'=>'image'), 'show', $item);
        }
        if ($collectionDescription = collection('Description', array('snippet'=>150), $featuredCollection)) {
            $html .= '<p class="collection-description">' . $collectionDescription . '</p>';
        }
    } else {
        $html .= '<p>No featured collections are available.</p>';
    }
    return $html;
}

/**
* Return the HTML for summarizing a random featured exhibit
* CUSTOMIZED FOR BS TEMPLATE BY JONATHAN CANDELARIA 6-14-18
* This is to make the featured exhibit html match the html for featured
* item and collection panels
* @return string
*/
function asu_exhibit_builder_display_random_featured_exhibit()
{
$html = '<div id="featured-exhibit" class="featured">';
    $featuredExhibit = exhibit_builder_random_featured_exhibit();
    $html .= '<h3>' . __('Featured Exhibit') . '</h3>';
    if ($featuredExhibit) {
    $html .= get_view()->partial('exhibits/single.php', array('exhibit' => $featuredExhibit));
    } else {
    $html .= '<p>' . __('You have no featured exhibits.') . '</p>';
    }
    $html .= '</div>';
$html = apply_filters('exhibit_builder_display_random_featured_exhibit', $html);
return $html;
}

function custom_exhibit_builder_page_summary($exhibitPage = null)
{
    if (!$exhibitPage) {
        $exhibitPage = get_current_record('exhibit_page');
    }
    $id = $exhibitPage->id;
    $children = $exhibitPage->getChildPages();
    $html = '<a class="list-group-item" href="' . exhibit_builder_exhibit_uri(get_current_record('exhibit'), $exhibitPage) . '">'
        . metadata($exhibitPage, 'menu_title') .'</a>';

    if ($children) {
        $html .= '<div class="list-group">';
        foreach ($children as $child) {
            $html .= custom_exhibit_builder_page_summary($child);
            release_object($child);
        }
        $html .= '</div>';
    }
    //$html .= '</li>';
    return $html;
}
