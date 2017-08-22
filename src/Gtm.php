<?php namespace AntonioTajuelo\Gtm;

class Gtm {

  private static $datalayer = [];

  private static $is_rendered  = false;

  public static function renderContainer($container_id,$datalayer = [],$options = []) {

    self::$is_rendered = true;

    if(isset($_SESSION['datalayer'])) {
      if(count($_SESSION['datalayer']) > 0) {
        self::$datalayer = array_merge($_SESSION['datalayer'],self::$datalayer);
        $_SESSION['datalayer'] = [];
      }
    }

    if(count($datalayer) > 0) {
      echo '<script>var dataLayer = [';
      echo json_encode(array_merge($datalayer,self::$datalayer),JSON_UNESCAPED_SLASHES);
      echo '];</script>';
      echo "\n";
    }

    $output = '<noscript><iframe src="//www.googletagmanager.com/ns.html?id=' . $container_id . '"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;';
    if(in_array('defer',$options)) {
      $output .= 'j.defer=true;';
    }
    $output .= 'j.src=
\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'' . $container_id . '\');</script>' . "\n";
    
    echo $output;

  }

  public static function datalayerPush($items = []) {

    if(self::$is_rendered) {
      echo '<script>dataLayer.push(' . json_encode($items,JSON_UNESCAPED_SLASHES) . ');</script>' . "\n";
    } else {
      self::$datalayer = array_merge(self::$datalayer,$items);
    }

  }

  public static function datalayerRemember($items) {

    if(!isset($_SESSION['datalayer'])) {
      $_SESSION['datalayer'] = [];
    }

    $_SESSION['datalayer'] = array_merge($_SESSION['datalayer'],$items);

  }

  public static function destroyContainer() {

    self::$datalayer = [];
    self::$is_rendered = false;

  }

}
