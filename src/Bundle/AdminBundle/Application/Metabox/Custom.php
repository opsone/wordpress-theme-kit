<?php

namespace Bundle\AdminBundle\Application\Metabox;

use Bundle\AdminBundle\Application\Filter as FilterAction;

class Custom extends FilterAction
{
  public static function registerMetaBoxes( $meta_boxes )
  {
      /**
       * Prefix of meta keys (optional)
       * Use underscore (_) at the beginning to make keys hidden
       * Alt.: You also can make prefix empty to disable it
       */
      // Better has an underscore as last sign

      // 1st meta box
      $meta_boxes[] = array(
          // Meta box id, UNIQUE per meta box. Optional since 4.1.5
          'id' => 'standard',

          // Meta box title - Will appear at the drag and drop handle bar. Required.
          'title' => 'Standard Fields',

          // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
          'pages' => array( 'post', 'page' ),

          // Where the meta box appear: normal (default), advanced, side. Optional.
          'context' => 'normal',

          // Order of meta box: high (default), low. Optional.
          'priority' => 'high',

          // Auto save: true, false (default). Optional.
          'autosave' => true,

          // List of meta fields
          'fields' => array(
              // TEXT
              array(
                  // Field name - Will be used as label
                  'name'  => 'Text',
                  // Field ID, i.e. the meta key
                  'id'    => FilterAction::PREFIX . "text",
                  // Field description (optional)
                  'desc'  => 'Text description',
                  'type'  => 'text',
                  // Default value (optional)
                  'std'   => 'Default text value',
                  // CLONES: Add to make the field cloneable (i.e. have multiple value)
                  'clone' => true,
              ),
              // CHECKBOX
              array(
                  'name' => 'Checkbox',
                  'id'   => FilterAction::PREFIX . "checkbox",
                  'type' => 'checkbox',
                  // Value can be 0 or 1
                  'std'  => 1,
              ),
              // RADIO BUTTONS
              array(
                  'name'    => 'Radio',
                  'id'      => FilterAction::PREFIX . "radio",
                  'type'    => 'radio',
                  // Array of 'value' => 'Label' pairs for radio options.
                  // Note: the 'value' is stored in meta field, not the 'Label'
                  'options' => array(
                      'value1' => 'Label1',
                      'value2' => 'Label2',
                  ),
              ),
              // SELECT BOX
              array(
                  'name'     => 'Select',
                  'id'       => FilterAction::PREFIX . "select",
                  'type'     => 'select',
                  // Array of 'value' => 'Label' pairs for select box
                  'options'  => array(
                      'value1' => 'Label1',
                      'value2' => 'Label2',
                  ),
                  // Select multiple values, optional. Default is false.
                  'multiple'    => false,
                  'std'         => 'value2',
                  'placeholder' => 'Select an Item',
              ),
              // HIDDEN
              array(
                  'id'   => FilterAction::PREFIX . "hidden",
                  'type' => 'hidden',
                  // Hidden field must have predefined value
                  'std'  => 'Hidden value',
              ),
              // PASSWORD
              array(
                  'name' => 'Password',
                  'id'   => FilterAction::PREFIX . "password",
                  'type' => 'password',
              ),
              // TEXTAREA
              array(
                  'name' => 'Textarea',
                  'desc' => 'Textarea description',
                  'id'   => FilterAction::PREFIX . "textarea",
                  'type' => 'textarea',
                  'cols' => 20,
                  'rows' => 3,
              ),
          ),
          'validation' => array(
              'rules' => array(
                  FilterAction::PREFIX . "password" => array(
                      'required'  => true,
                      'minlength' => 7,
                  ),
              ),
              // optional override of default jquery.validate messages
              'messages' => array(
                  FilterAction::PREFIX . "password" => array(
                      'required'  => 'Password is required',
                      'minlength' => 'Password must be at least 7 characters',
                  ),
              )
          )
      );

      // 2nd meta box
      $meta_boxes[] = array(
          'title' => 'Advanced Fields',

          'fields' => array(
              // HEADING
              array(
                  'type' => 'heading',
                  'name' => 'Heading',
                  'id'   => 'fake_id', // Not used but needed for plugin
              ),
              // SLIDER
              array(
                  'name' => 'Slider',
                  'id'   => FilterAction::PREFIX . "slider",
                  'type' => 'slider',

                  // Text labels displayed before and after value
                  'prefix' => '$',
                  'suffix' => ' USD',

                  // jQuery UI slider options. See here http://api.jqueryui.com/slider/
                  'js_options' => array(
                      'min'   => 10,
                      'max'   => 255,
                      'step'  => 5,
                  ),
              ),
              // NUMBER
              array(
                  'name' => 'Number',
                  'id'   => FilterAction::PREFIX . "number",
                  'type' => 'number',

                  'min'  => 0,
                  'step' => 5,
              ),
              // DATE
              array(
                  'name' => 'Date picker',
                  'id'   => FilterAction::PREFIX . "date",
                  'type' => 'date',

                  // jQuery date picker options. See here http://api.jqueryui.com/datepicker
                  'js_options' => array(
                      'appendText'      => '(yyyy-mm-dd)',
                      'dateFormat'      => 'yy-mm-dd',
                      'changeMonth'     => true,
                      'changeYear'      => true,
                      'showButtonPanel' => true,
                  ),
              ),
              // DATETIME
              array(
                  'name' => 'Datetime picker',
                  'id'   => $prefix . 'datetime',
                  'type' => 'datetime',

                  // jQuery datetime picker options.
                  // For date options, see here http://api.jqueryui.com/datepicker
                  // For time options, see here http://trentrichardson.com/examples/timepicker/
                  'js_options' => array(
                      'stepMinute'     => 15,
                      'showTimepicker' => true,
                  ),
              ),
              // TIME
              array(
                  'name' => 'Time picker',
                  'id'   => $prefix . 'time',
                  'type' => 'time',

                  // jQuery datetime picker options.
                  // For date options, see here http://api.jqueryui.com/datepicker
                  // For time options, see here http://trentrichardson.com/examples/timepicker/
                  'js_options' => array(
                      'stepMinute' => 5,
                      'showSecond' => true,
                      'stepSecond' => 10,
                  ),
              ),
              // COLOR
              array(
                  'name' => 'Color picker',
                  'id'   => FilterAction::PREFIX . "color",
                  'type' => 'color',
              ),
              // CHECKBOX LIST
              array(
                  'name' => 'Checkbox list',
                  'id'   => FilterAction::PREFIX . "checkbox_list",
                  'type' => 'checkbox_list',
                  // Options of checkboxes, in format 'value' => 'Label'
                  'options' => array(
                      'value1' => 'Label1',
                      'value2' => 'Label2',
                  ),
              ),
              // EMAIL
              array(
                  'name'  => 'Email',
                  'id'    => FilterAction::PREFIX . "email",
                  'desc'  => 'Email description',
                  'type'  => 'email',
                  'std'   => 'name@email.com',
              ),
              // RANGE
              array(
                  'name'  => 'Range',
                  'id'    => FilterAction::PREFIX . "range",
                  'desc'  => 'Range description',
                  'type'  => 'range',
                  'min'   => 0,
                  'max'   => 100,
                  'step'  => 5,
                  'std'   => 0,
              ),
              // URL
              array(
                  'name'  => 'URL',
                  'id'    => FilterAction::PREFIX . "url",
                  'desc'  => 'URL description',
                  'type'  => 'url',
                  'std'   => 'http://google.com',
              ),
              // OEMBED
              array(
                  'name'  => 'oEmbed',
                  'id'    => FilterAction::PREFIX . "oembed",
                  'desc'  => 'oEmbed description',
                  'type'  => 'oembed',
              ),
              // SELECT ADVANCED BOX
              array(
                  'name'     => 'Select',
                  'id'       => FilterAction::PREFIX . "select_advanced",
                  'type'     => 'select_advanced',
                  // Array of 'value' => 'Label' pairs for select box
                  'options'  => array(
                      'value1' => 'Label1',
                      'value2' => 'Label2',
                  ),
                  // Select multiple values, optional. Default is false.
                  'multiple'    => false,
                  // 'std'         => 'value2', // Default value, optional
                  'placeholder' => 'Select an Item',
              ),
              // TAXONOMY
              array(
                  'name'    => 'Taxonomy',
                  'id'      => FilterAction::PREFIX . "taxonomy",
                  'type'    => 'taxonomy',
                  'options' => array(
                      // Taxonomy name
                      'taxonomy' => 'category',
                      // How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
                      'type' => 'checkbox_list',
                      // Additional arguments for get_terms() function. Optional
                      'args' => array()
                  ),
              ),
              // POST
              array(
                  'name'    => 'Posts (Pages)',
                  'id'      => FilterAction::PREFIX . "pages",
                  'type'    => 'post',

                  // Post type
                  'post_type' => 'page',
                  // Field type, either 'select' or 'select_advanced' (default)
                  'field_type' => 'select_advanced',
                  // Query arguments (optional). No settings means get all published posts
                  'query_args' => array(
                      'post_status' => 'publish',
                      'posts_per_page' => '-1',
                  )
              ),
              // WYSIWYG/RICH TEXT EDITOR
              array(
                  'name' => 'WYSIWYG / Rich Text Editor',
                  'id'   => FilterAction::PREFIX . "wysiwyg",
                  'type' => 'wysiwyg',
                  // Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
                  'raw'  => false,
                  'std'  => 'WYSIWYG default value',

                  // Editor settings, see wp_editor() function: look4wp.com/wp_editor
                  'options' => array(
                      'textarea_rows' => 4,
                      'teeny'         => true,
                      'media_buttons' => false,
                  ),
              ),
              // DIVIDER
              array(
                  'type' => 'divider',
                  'id'   => 'fake_divider_id', // Not used, but needed
              ),
              // FILE UPLOAD
              array(
                  'name' => 'File Upload',
                  'id'   => FilterAction::PREFIX . "file",
                  'type' => 'file',
              ),
              // FILE ADVANCED (WP 3.5+)
              array(
                  'name' => 'File Advanced Upload',
                  'id'   => FilterAction::PREFIX . "file_advanced",
                  'type' => 'file_advanced',
                  'max_file_uploads' => 4,
                  'mime_type' => 'application,audio,video', // Leave blank for all file types
              ),
              // IMAGE UPLOAD
              array(
                  'name' => 'Image Upload',
                  'id'   => FilterAction::PREFIX . "image",
                  'type' => 'image',
              ),
              // THICKBOX IMAGE UPLOAD (WP 3.3+)
              array(
                  'name' => 'Thickbox Image Upload',
                  'id'   => FilterAction::PREFIX . "thickbox",
                  'type' => 'thickbox_image',
              ),
              // PLUPLOAD IMAGE UPLOAD (WP 3.3+)
              array(
                  'name'             => 'Plupload Image Upload',
                  'id'               => FilterAction::PREFIX . "plupload",
                  'type'             => 'plupload_image',
                  'max_file_uploads' => 4,
              ),
              // IMAGE ADVANCED (WP 3.5+)
              array(
                  'name'             => 'Image Advanced Upload',
                  'id'               => FilterAction::PREFIX . "imgadv",
                  'type'             => 'image_advanced',
                  'max_file_uploads' => 4,
              ),
              // BUTTON
              array(
                  'id'   => FilterAction::PREFIX . "button",
                  'type' => 'button',
                  'name' => ' ', // Empty name will "align" the button to all field inputs
              ),

          )
      );

      return $meta_boxes;
  }
}
