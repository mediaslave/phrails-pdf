<?php
namespace net\mediaslave\pdf\lib;
class MemoryDestination extends \Destination {  

  function process($tmp_filename, $content_type) {
    return file_get_contents($tmp_filename);
  }
}
?>