<?php

namespace App\Controller;

use ApiPlatform\Core\Bridge\Symfony\Validator\Validator;
use App\Entity\Ad;
use App\Entity\AdStatus;
use App\Entity\Component;
use App\Entity\ComponentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class AdController extends AbstractController {

    public function createAd(Request $request) {
        /*
        http://local.sunmedia.com/api/v1/create-ad
        POST
        {
        "name": "imagen",
        "width": 111,
        "height": 111,
        "x": 2,
        "y": 34,
        "z": 12,
        "ad_status_id": 2,
        "component": {
            "componentTypeId": 3,
            "link": "http://www.miportfolioraulcoca.com",
            "format": "jpg",
            "weight": 3,
            "text": ""
            }
        }
         */

        $json = $request->get('params', null);
        $params = json_decode($json, true);

        if (!empty($params)) {
            try {
                $ad = new Ad();
                $ad->setName($params['name']);
                $ad->setWidth($params['width']);
                $ad->setHeight($params['height']);
                $ad->setX($params['x']);
                $ad->setY($params['y']);
                $ad->setZ($params['z']);

                $adStatus = $this->getDoctrine()->getRepository(AdStatus::class)->find($params['ad_status_id']);
                $ad->setAdStatus($adStatus);
                $componentType = $this->getDoctrine()->getRepository(ComponentType::class)->find($params['component_type_id']);

                $component = new Component();
                $component->setComponentType($componentType);
                $component->setLink($params['component']['link']);
                $component->setFormat($params['component']['format']);
                $component->setWeight($params['component']['weight']);
                $component->setText($params['component']['text']);

                if (self::validate($component)) {
                    $ad->setComponent($component);

                    $this->saveObject($component);
                    $this->saveObject($ad);
                    $data = [
                        'status' => 'ok',
                        'code' => 200,
                        'message' => 'Anuncio creado!',
                        'data' => $ad,
                    ];
                } else {
                    $data = [
                        'status' => 'error',
                        'code' => 400,
                        'message' => 'Los componentes no son válidos',
                        'data' => [],
                    ];
                }
            } catch (\Exception $e) {
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => $e->getMessage(),
                    'data' => $e,
                ];
            }
        }

        return new JsonResponse($data);
    }

    public function publicateAd(Request $request) {
        /*
        http://local.sunmedia.com/api/v1/publicate-ad
        POST
        {"id":35}
         */
        $json = $request->get('params', null);
        $params = json_decode($json, true);
        if ($params['id']) {
            $ad = $this->getDoctrine()->getRepository(Ad::class)->find($params['id']);
            if ($ad->getAdStatus()->getId() == AdStatus::stopped) {
                $ad->setAdStatus($this->getDoctrine()->getRepository(AdStatus::class)->find(AdStatus::PUBLISHED));
                $this->saveObject($ad);
                $data = [
                    'status' => 'ok',
                    'code' => 200,
                    'message' => 'Anuncio publicado!',
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'El anuncio ya esta en estado ' . $ad->getAdStatus()->getName(),
                ];
            }
        } else {
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'Falta el parámetro id',
            ];
        }

        return new JsonResponse($data);
    }

    public static function validate($component) {
        $validator = Validation::createValidator();
        switch ($component->getComponentType()->getId()) {
            case ComponentType::IMAGE:
            case ComponentType::VIDEO:
                $link_validation = count($validator->validate($component->getLink(), new Assert\Url())) == 0;
                $weight_validation = intval($component->getWeight()) > 0;
                $format_validation = in_array(strtoupper($component->getFormat()), $component->getComponentType()->getId() == ComponentType::IMAGE ? $component->imageFormatAccepted : $component->videoFormatAccepted);
                if ($link_validation && $weight_validation && $format_validation) {
                    return true;
                } else {
                    return false;
                }
                break;
            case ComponentType::TEXT:
                var_dump(strlen($component->getText()));
                $text_validation = strlen($component->getText()) <= 140;
                if ($text_validation) {
                    return true;
                } else {
                    return false;
                }
                break;
        }

        return false;
    }

    public function saveObject($obj) {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $em->persist($obj);
        $em->flush();
    }
}
