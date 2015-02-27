<?php

namespace Bundle\AdminBundle\Application;

use WpThemeKitLib\Application\Taxonomy as TaxonomyAction;

class Taxonomy extends TaxonomyAction
{
    public static function type()
    {
        register_taxonomy('type',

            array(
                'post',
            ),

            array(
                "hierarchical"   => true,
                "label"          => 'Types',
                "singular_label" => 'type',
                "rewrite"        => array(
                    'slug'         => 'type',
                    'hierarchical' => true,
                )
            )
        );
    }
}
