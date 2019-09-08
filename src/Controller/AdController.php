<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\AdStatus;
use App\Entity\Component;
use App\Entity\ComponentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AdController extends AbstractController {
    //
    //    public function resJson($data) {
    //        $json = $this->get('serializer')->serialize($data, 'json');
    //        $response = new Response();
    //        $response->setContent($json);
    //        $response->headers->set('Content-Type', 'application/json');
    //        return $response;
    //    }

    public function createAd(Request $request) {

        //        $ad_repo = $this->getDoctrine()->getRepository(Ad::class);
        //        $ads = $ad_repo->findAll();
        //        return $this->resJson($ads);

        $json = $request->get('params', null);
        $params = json_decode($json, true);

//        print_r($params);
        if (!empty($params)) {
            if(self::validateAd($params)){
                $ad = new Ad();

                $data = [
                    'status' => 'ok',
                    'code' => 200,
                    'message' => '',
                    'params' => $json
                ];

                $ad = new Ad();
                $ad->setName($params['name']);
                $ad->setWidth($params['width']);
                $ad->setHeight($params['height']);
                $ad->setX($params['x']);
                $ad->setY($params['y']);
                $ad->setZ($params['z']);

                $adStatus = $this->getDoctrine()
                    ->getRepository(AdStatus::class)
                    ->find($params['ad_status_id']);

                $ad->setAdStatus($adStatus);

                $componentType = $this->getDoctrine()
                    ->getRepository(ComponentType::class)
                    ->find($params['component_type_id']);
                $ad->setcomponentType($componentType);
//                $ad->setComponent(new Component($params['component']));
                $this->saveAd($ad);

                /*
                "name": "imagen",
                "width": 111,
                "height": 111,
                "x": 2,
                "y": 34,
                "z": 12,
                "ad_status_id": 2,
                "component_type_id": 1,
                "component": {
                    "id": 1,
                    "componentTypeId": 1,
                    "link": "http://miportfolio.com",
                    "format": "jpg",
                    "weight": 2,
                    "text": null
                 */
            }
        }

        return new JsonResponse($data);
    }

    public static function validateAd($params){
        return true;
    }

    public function saveAd($ad){
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $em->persist($ad);
        $em->flush();
    }
}
