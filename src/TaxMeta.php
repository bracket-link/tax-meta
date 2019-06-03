<?php

namespace Moksha;

use Moksha\lib\Taxonomy_MetaData_CMB2;

class TaxMeta
{

    private $meta_boxes;

    /**
     * @param $meta_boxes
     */
    public function __construct($meta_boxes)
    {
        $this->meta_boxes = (array)$meta_boxes;
        add_action('init', array($this, 'addTaxonomyMeta'), 999);
    }

    /**
     * Hooks TaxMeta to init hook
     */
    public function addTaxonomyMeta()
    {
        if (is_array($this->meta_boxes) && count($this->meta_boxes)) {
            foreach ((array)$this->meta_boxes as $taxonomy => $taxonomy_fields) {
                $title = ucwords(str_replace('-', ' ', $taxonomy));
                $meta_box = array(
                    'id' => str_replace('-', '_', strtolower($taxonomy)),
                    'show_on' => array('key' => 'options-page', 'value' => array('unknown',),),
                    'show_names' => true,
                    'fields' => array()
                );
                $taxonomy_fields = array_merge($meta_box, $taxonomy_fields);
                new Taxonomy_MetaData_CMB2($taxonomy, $taxonomy_fields, $title);
            }
        }
    }
}