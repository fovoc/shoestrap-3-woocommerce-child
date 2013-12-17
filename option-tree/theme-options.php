<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => 'General Configuration'
      ),
      array(
        'id'          => 'custom',
        'title'       => 'Theme Customizer'
      ),
      array(
        'id'          => 'shopdetails',
        'title'       => 'Shop Details'
      ),
      array(
        'id'          => 'slider',
        'title'       => 'Slider, Banner, Brands'
      ),
      array(
        'id'          => 'social',
        'title'       => 'Social Networks'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'hs_logo',
        'label'       => 'Logo Image',
        'desc'        => 'Upload your own logo. Leave it blank if you decided to use text instead',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_logofont',
        'label'       => 'Logo Font',
        'desc'        => 'Insert Google Font name you want to use for your logo',
        'std'         => 'Bangers',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_logofontsize',
        'label'       => 'Logo Font Size',
        'desc'        => 'Size for logo text',
        'std'         => '',
        'type'        => 'measurement',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_fav',
        'label'       => 'Favicon',
        'desc'        => 'Upload your favicon',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_font',
        'label'       => 'Body Font',
        'desc'        => 'Default font setting. If you want to use this font-family, clear form for Body Google Font below.',
        'std'         => '',
        'type'        => 'typography',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_fontgoogle',
        'label'       => 'Body Google Font',
        'desc'        => 'If you decided to use Google Font, just insert the font name here. Leave form blank if you want to use default fonts selected above.',
        'std'         => 'Lato',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_sidebarpage',
        'label'       => 'Page sidebar',
        'desc'        => 'Select sidebar position for pages',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Left SideBar',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'no_sidebar',
            'label'       => 'No Sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_sidebarblog',
        'label'       => 'Blog Sidebar',
        'desc'        => 'Select sidebar position for blog list and blog post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'no_sidebar',
            'label'       => 'No Sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_sidebarshop',
        'label'       => 'Shop Sidebar',
        'desc'        => 'Select sidebar position for product listing',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'no_sidebar',
            'label'       => 'No Sidebar',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_text',
        'label'       => 'Share text in product page',
        'desc'        => '',
        'std'         => 'Hard to decide? Ask your friends',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_homefeat',
        'label'       => 'Homepage Featured Products',
        'desc'        => 'Featured products title',
        'std'         => 'FEATURED PRODUCTS',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_homefeatno',
        'label'       => 'Number of Featured Products',
        'desc'        => 'Number of featured products you want to display on homepage',
        'std'         => '9',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_announcement',
        'label'       => 'Announcement',
        'desc'        => 'This section sit at footer area, beside payment method icons. You can insert greeting, promotion, announcement, testimoni or anything here. HTML is allowed.',
        'std'         => 'Welcome to HumbleShop.',
        'type'        => 'textarea',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_background',
        'label'       => 'Body Background',
        'desc'        => 'Custom your background look',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_link',
        'label'       => 'Body link color',
        'desc'        => 'Choose default link color for body',
        'std'         => '#E55137',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_panel',
        'label'       => 'Main panel color',
        'desc'        => 'Select color for main panel',
        'std'         => '#FFFFFF',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_headpanel',
        'label'       => 'Header panel color',
        'desc'        => 'Select head panel color (page title section)',
        'std'         => '#F2F2F2',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_line',
        'label'       => 'Border color',
        'desc'        => 'Select default border line color',
        'std'         => '#DDDDDD',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerbg',
        'label'       => 'Footer background color',
        'desc'        => 'Select you footer background color',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerfont',
        'label'       => 'Footer font color',
        'desc'        => 'Choose default color for texts in footer.',
        'std'         => '#777777',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerlink',
        'label'       => 'Footer link color',
        'desc'        => 'Choose font color for link in footer.',
        'std'         => '#bbbbbb',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_footerline',
        'label'       => 'Footer border line color',
        'desc'        => 'Select footer border line color',
        'std'         => '#333333',
        'type'        => 'colorpicker',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_css',
        'label'       => 'Additional CSS',
        'desc'        => 'Enter your additional css here (optional)',
        'std'         => '',
        'type'        => 'css',
        'section'     => 'custom',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_add1',
        'label'       => 'Address 1',
        'desc'        => 'First row address',
        'std'         => 'First row address',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_add2',
        'label'       => 'Address 2',
        'desc'        => 'Second row address',
        'std'         => 'Second row address',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_town',
        'label'       => 'Town/City',
        'desc'        => 'Town/City',
        'std'         => 'Town',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_zip',
        'label'       => 'Postcode/ZIP',
        'desc'        => 'Postcode/ZIP',
        'std'         => 'Postcode',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_country',
        'label'       => 'Country',
        'desc'        => 'Country',
        'std'         => 'Country',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_phone',
        'label'       => 'Phone No',
        'desc'        => 'Phone number',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_fax',
        'label'       => 'Fax No',
        'desc'        => 'Fax number',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_email',
        'label'       => 'Email',
        'desc'        => 'Email address',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_bank',
        'label'       => 'Payment Option',
        'desc'        => 'Select payment method logos you want to display at the footer.',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'shopdetails',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'amex',
            'label'       => 'American Express',
            'src'         => ''
          ),
          array(
            'value'       => 'mastercard',
            'label'       => 'MasterCard',
            'src'         => ''
          ),
          array(
            'value'       => 'visa',
            'label'       => 'Visa',
            'src'         => ''
          ),
          array(
            'value'       => 'paypal',
            'label'       => 'Paypal',
            'src'         => ''
          ),
          array(
            'value'       => 'cirrus',
            'label'       => 'Cirrus',
            'src'         => ''
          ),
          array(
            'value'       => 'delta',
            'label'       => 'Deltad',
            'src'         => ''
          ),
          array(
            'value'       => 'direct-debit',
            'label'       => 'Direct Debit',
            'src'         => ''
          ),
          array(
            'value'       => 'discover',
            'label'       => 'Discoverd',
            'src'         => ''
          ),
          array(
            'value'       => 'ebay',
            'label'       => 'Ebay',
            'src'         => ''
          ),
          array(
            'value'       => 'google',
            'label'       => 'Google Checkout',
            'src'         => ''
          ),
          array(
            'value'       => 'maestro',
            'label'       => 'Maestro',
            'src'         => ''
          ),
          array(
            'value'       => 'moneybookers',
            'label'       => 'Moneybookers',
            'src'         => ''
          ),
          array(
            'value'       => 'sagepay',
            'label'       => 'Sagepay',
            'src'         => ''
          ),
          array(
            'value'       => 'solo',
            'label'       => 'Solo',
            'src'         => ''
          ),
          array(
            'value'       => 'switch',
            'label'       => 'Switch',
            'src'         => ''
          ),
          array(
            'value'       => 'visaelectron',
            'label'       => 'Visa Electron',
            'src'         => ''
          ),
          array(
            'value'       => 'twocheckout',
            'label'       => '2checkout',
            'src'         => ''
          ),
          array(
            'value'       => 'westernunion',
            'label'       => 'Western Union',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_slider',
        'label'       => 'Slider',
        'desc'        => 'Add slider for front page',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'hs_slideimage',
            'label'       => 'Image',
            'desc'        => 'Upload your banner image <em>(recommended size 940x400)</em>',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'hs_slidelink',
            'label'       => 'Link',
            'desc'        => 'Insert link for the banner',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'hs_slidetext',
            'label'       => 'Additional Text',
            'desc'        => 'Insert short text for the banner. HTML is allowed',
            'std'         => '',
            'type'        => 'textarea',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'hs_slidercarousel',
        'label'       => 'Slider carousel',
        'desc'        => 'Carousel option for slider in front page. Only nicely fit window if you have more than 5 sliders',
        'std'         => '0',
        'type'        => 'checkbox',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_banner',
        'label'       => 'Promo Banner',
        'desc'        => 'Check if you want to enable promo banner',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'hs_promos',
        'label'       => 'Promo Banners',
        'desc'        => 'Upload promo banners, recommended is <strong>3 banners</strong>',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'hs_bannerimg',
            'label'       => 'Banner image',
            'desc'        => 'Upload your promo banner. Recommended size is 260x140',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'id'          => 'hs_bannerlink',
            'label'       => 'Banner Link',
            'desc'        => 'Insert URL for promo link',
            'std'         => '',
            'type'        => 'text',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'hs_brand',
        'label'       => 'Brands carousel',
        'desc'        => 'Add Brands carousel title. Leave this field blank if you don\'t want to use this feature.',
        'std'         => 'Brands',
        'type'        => 'text',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'hs_brandlist',
        'label'       => 'Brands Logo',
        'desc'        => 'Add Brand your logos',
        'std'         => '',
        'type'        => 'list-item',
        'section'     => 'slider',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'settings'    => array( 
          array(
            'id'          => 'hs_brandimage',
            'label'       => 'Image',
            'desc'        => 'Add Brand logo',
            'std'         => '',
            'type'        => 'upload',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        )
      ),
      array(
        'id'          => 'facebook',
        'label'       => 'Facebook',
        'desc'        => 'Facebook user/page name',
        'std'         => 'envato',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'twitter',
        'label'       => 'Twitter',
        'desc'        => 'Your twitter username',
        'std'         => 'envato',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'gplus',
        'label'       => 'Google Plus',
        'desc'        => 'Your Google+ ID',
        'std'         => '107285294994146126204',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'pinterest',
        'label'       => 'Pinterest',
        'desc'        => 'Your pinterest username',
        'std'         => 'humblespace',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'tumblr',
        'label'       => 'Tumblr',
        'desc'        => 'Your tumblr page url',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'instagram',
        'label'       => 'Instagram',
        'desc'        => 'Your instagram username',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}