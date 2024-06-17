<?php

namespace App\Helpers;

use Config;
use Illuminate\Support\Str;

class Helpers
{
  public static function appClasses()
  {

    $data = config('custom.custom');


    // default data array
    $DefaultData = [
      'myLayout' => 'vertical',
      'myTheme' => 'theme-default',
      'myStyle' => 'light',
      'myRTLSupport' => true,
      'myRTLMode' => true,
      'hasCustomizer' => true,
      'showDropdownOnHover' => true,
      'displayCustomizer' => true,
      'contentLayout' => 'compact',
      'headerType' => 'fixed',
      'navbarType' => 'fixed',
      'menuFixed' => true,
      'menuCollapsed' => false,
      'footerFixed' => false,
      'customizerControls' => [
        'rtl',
      'style',
      'headerType',
      'contentLayout',
      'layoutCollapsed',
      'showDropdownOnHover',
      'layoutNavbarOptions',
      'themes',
      ],
      //   'defaultLanguage'=>'en',
    ];

    // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
    $data = array_merge($DefaultData, $data);

    // All options available in the template
    $allOptions = [
      'myLayout' => ['vertical', 'horizontal', 'blank', 'front'],
      'menuCollapsed' => [true, false],
      'hasCustomizer' => [true, false],
      'showDropdownOnHover' => [true, false],
      'displayCustomizer' => [true, false],
      'contentLayout' => ['compact', 'wide'],
      'headerType' => ['fixed', 'static'],
      'navbarType' => ['fixed', 'static', 'hidden'],
      'myStyle' => ['light', 'dark', 'system'],
      'myTheme' => ['theme-default', 'theme-bordered', 'theme-semi-dark'],
      'myRTLSupport' => [true, false],
      'myRTLMode' => [true, false],
      'menuFixed' => [true, false],
      'footerFixed' => [true, false],
      'customizerControls' => [],
      // 'defaultLanguage'=>array('en'=>'en','fr'=>'fr','de'=>'de','pt'=>'pt'),
    ];

    //if myLayout value empty or not match with default options in custom.php config file then set a default value
    foreach ($allOptions as $key => $value) {
      if (array_key_exists($key, $DefaultData)) {
        if (gettype($DefaultData[$key]) === gettype($data[$key])) {
          // data key should be string
          if (is_string($data[$key])) {
            // data key should not be empty
            if (isset($data[$key]) && $data[$key] !== null) {
              // data key should not be exist inside allOptions array's sub array
              if (!array_key_exists($data[$key], $value)) {
                // ensure that passed value should be match with any of allOptions array value
                $result = array_search($data[$key], $value, 'strict');
                if (empty($result) && $result !== 0) {
                  $data[$key] = $DefaultData[$key];
                }
              }
            } else {
              // if data key not set or
              $data[$key] = $DefaultData[$key];
            }
          }
        } else {
          $data[$key] = $DefaultData[$key];
        }
      }
    }
    $styleVal = $data['myStyle'] == "dark" ? "dark" : "light";
    if (isset($_COOKIE['style'])) {
      $styleVal = $_COOKIE['style'];
    }
    //layout classes
    $layoutClasses = [
      'layout' => $data['myLayout'],
      'theme' => $data['myTheme'],
      'style' => $styleVal,
      'styleOpt' => $data['myStyle'],
      'rtlSupport' => $data['myRTLSupport'],
      'rtlMode' => $data['myRTLMode'],
      'textDirection' => $data['myRTLMode'],
      'menuCollapsed' => $data['menuCollapsed'],
      'hasCustomizer' => $data['hasCustomizer'],
      'showDropdownOnHover' => $data['showDropdownOnHover'],
      'displayCustomizer' => $data['displayCustomizer'],
      'contentLayout' => $data['contentLayout'],
      'headerType' => $data['headerType'],
      'navbarType' => $data['navbarType'],
      'menuFixed' => $data['menuFixed'],
      'footerFixed' => $data['footerFixed'],
      'customizerControls' => $data['customizerControls'],
    ];

    // sidebar Collapsed
    if ($layoutClasses['menuCollapsed'] == true) {
      $layoutClasses['menuCollapsed'] = 'layout-menu-collapsed';
    }

    // Header Type
    if ($layoutClasses['headerType'] == 'fixed') {
      $layoutClasses['headerType'] = 'layout-menu-fixed';
    }
    // Navbar Type
    if ($layoutClasses['navbarType'] == 'fixed') {
      $layoutClasses['navbarType'] = 'layout-navbar-fixed';
    } elseif ($layoutClasses['navbarType'] == 'static') {
      $layoutClasses['navbarType'] = '';
    } else {
      $layoutClasses['navbarType'] = 'layout-navbar-hidden';
    }

    // Menu Fixed
    if ($layoutClasses['menuFixed'] == true) {
      $layoutClasses['menuFixed'] = 'layout-menu-fixed';
    }


    // Footer Fixed
    if ($layoutClasses['footerFixed'] == true) {
      $layoutClasses['footerFixed'] = 'layout-footer-fixed';
    }

    // RTL Supported template
    if ($layoutClasses['rtlSupport'] == true) {
      $layoutClasses['rtlSupport'] = '/rtl';
    }

    // RTL Layout/Mode
    if ($layoutClasses['rtlMode'] == true) {
      $layoutClasses['rtlMode'] = 'rtl';
      $layoutClasses['textDirection'] = 'rtl';
    } else {
      $layoutClasses['rtlMode'] = 'ltr';
      $layoutClasses['textDirection'] = 'ltr';
    }

    // Show DropdownOnHover for Horizontal Menu
    if ($layoutClasses['showDropdownOnHover'] == true) {
      $layoutClasses['showDropdownOnHover'] = true;
    } else {
      $layoutClasses['showDropdownOnHover'] = false;
    }

    // To hide/show display customizer UI, not js
    if ($layoutClasses['displayCustomizer'] == true) {
      $layoutClasses['displayCustomizer'] = true;
    } else {
      $layoutClasses['displayCustomizer'] = false;
    }

    return $layoutClasses;
  }

  public static function updatePageConfig($pageConfigs)
  {
    $demo = 'custom';
    if (isset($pageConfigs)) {
      if (count($pageConfigs) > 0) {
        foreach ($pageConfigs as $config => $val) {
          Config::set('custom.' . $demo . '.' . $config, $val);
        }
      }
    }
  }

  public static function getInitial($name) {
    // Explode the name into an array of its parts
    $parts = explode(' ', $name);
    
    // Initialize an empty string to store initials
    $initial = '';
    
    // Iterate through each part of the name
    foreach ($parts as $part) {
        // Get the first character of each part and append it to the initials string
        $initial .= substr($part, 0, 1);
    }
    
    // Return the initials
    return $initial;
  }

  public static function getConstants() {
    $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
 
    $qualityNew = (object) [
      'label' => 'New',
      'value' => 'New',
    ];
    $qualityHigh = (object) [
      'label' => 'High Priority',
      'value' => 'High Priority',
    ];
    $qualityContacted = (object) [
      'label' => 'Contacted',
      'value' => 'Contacted',
    ];
    $qualityNego = (object) [
      'label' => 'In Negotiation',
      'value' => 'In Negotiation',
    ];
    $qualityLost = (object) [
      'label' => 'Lost',
      'value' => 'Lost',
    ];
    $stages = [$qualityNew, $qualityHigh, $qualityContacted, $qualityNego, $qualityLost];
    
    $qualityWarm = (object) [
      'label' => 'Warm',
      'value' => 'Warm',
    ];
    $quality = [$qualityWarm];

    $statusActive = (object) [
      'label' => 'Active',
      'value' => 'Active',
    ];
    $statusInactive = (object) [
      'label' => 'Inactive',
      'value' => 'Inactive',
    ];
    $status = [$statusActive, $statusInactive];

    $channel = (object) [
      'label' => 'WhatsApp',
      'value' => 'wa',
    ];
    $channel2 = (object) [
      'label' => 'Email',
      'value' => 'email',
    ];
    $channel3 = (object) [
      'label' => 'WeChat',
      'value' => 'wechat',
    ];
    $channel4 = (object) [
      'label' => 'Instagram',
      'value' => 'instagram',
    ];
    $listChannels = [$channel, $channel2, $channel3, $channel4];

    $ticketType = (object) [
      'label' => 'Document',
      'value' => 'document',
    ];
    $ticketType2 = (object) [
      'label' => 'Complaint',
      'value' => 'complaint',
    ];
    $ticketType3 = (object) [
      'label' => 'Technical',
      'value' => 'technical',
    ];
    $ticketType4 = (object) [
      'label' => 'Issue',
      'value' => 'issue',
    ];
    $ticketType5 = (object) [
      'label' => 'Others',
      'value' => 'others',
    ];
    $listTicketTypes = [$ticketType, $ticketType2, $ticketType3, $ticketType4, $ticketType5];

    $priority = (object) [
      'label' => 'Low',
      'value' => 'low',
    ];
    $priority2 = (object) [
      'label' => 'Medium',
      'value' => 'medium',
    ];
    $priority3 = (object) [
      'label' => 'High',
      'value' => 'high',
    ];
    $listPrioritys = [$priority, $priority2, $priority3];

    $statusProject = (object) [
      'label' => 'Open',
      'value' => 'open',
    ];
    $statusProject2 = (object) [
      'label' => 'In-progress',
      'value' => 'in-progress',
    ];
    $statusProject3 = (object) [
      'label' => 'Closed',
      'value' => 'closed',
    ];
    $statusProject3 = (object) [
      'label' => 'Pending',
      'value' => 'pending',
    ];
    $statusProject4 = (object) [
      'label' => 'KIV',
      'value' => 'kiv',
    ];
    $listStatusProjects = [$statusProject , $statusProject2, $statusProject3, $statusProject4];

    return [
      $stages,
      $alphabet,
      $quality,
      $status,
      $listChannels,
      $listTicketTypes,
      $listPrioritys,
      $listStatusProjects
    ];
  }
}
