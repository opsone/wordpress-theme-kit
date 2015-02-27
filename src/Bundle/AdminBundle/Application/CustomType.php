<?php

namespace Bundle\AdminBundle\Application;

use WpThemeKitLib\Application\CustomType as CustomTypeAction;

class CustomType extends CustomTypeAction
{
    public static function sampleType()
    {
        $labels =
        array(
            'name'               => 'Samples',
            'singular_name'      => 'Sample',
            'add_new'            => 'Ajouter',
            'add_new_item'       => 'Ajouter un example',
            'edit_item'          => 'Modifier l\'example',
            'new_item'           => 'Nouveau example',
            'view_item'          => 'Voir l\'example',
            'search_items'       => 'Recherche un example',
            'not_found'          => 'Aucun example',
            'not_found_in_trash' => 'Aucun example',
            'parent_item_colon'  => ''
        );

        $args =
        array(
            'labels'            => $labels,
            'rewrite'           => array('slug' => 'Samples'),
            'public'            => true,
            'publicly_queryable'=> true,
            'show_ui'           => true,
            'query_var'         => true,
            'capability_type'   => 'post',
            'hierarchical'      => false,
            'menu_position'     => 4,
            'supports'          => array('title', 'editor', 'thumbnail', 'post_tag'),
            'menu_icon'         => get_template_directory_uri() . '/assets/admin/img/sample.png'
        );

        register_post_type('sample', $args);
    }
}
