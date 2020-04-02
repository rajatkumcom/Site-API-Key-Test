<?php
/**
 * @file
 * Contains \Drupal\site_api_key\Controller\SiteApiController.
 */

namespace Drupal\site_api_key\Controller;

use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;



class SiteApiController {

    public function jsonOutput($site_api_key, $nid) {
        
        $result = 'Access Denied';
        if( $site_api_key == \Drupal::config('system.site')->get('siteapikey') ) {
            
            if (!empty($nid)) {
                $result = Node::load($nid);
                if(  isset( $result ) ) {
                 $result = $result->toArray();
                } else {
                    $result = 'Node not exist.';
                }
            }
            
        } else {
            $result = 'Access Denied';
        }
        
        return new JsonResponse([
            $result,
        ]);
    
    }
  
}