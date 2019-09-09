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
                } else{
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

    public static function validate($component) {
        $validator = Validation::createValidator();
        switch ($component->getComponentType()->getId()) {
            case ComponentType::IMAGE:
            case ComponentType::VIDEO:
                $link_validation = count($validator->validate($component->getLink(), new Assert\Url())) == 0;
                $weight_validation = intval($component->getWeight()) > 0;
                $format_validation = in_array(strtoupper($component->getFormat()), $component->getComponentType()->getId() == ComponentType::IMAGE ? $component->imageFormatAccepted : $component->videoFormatAccepted);
                if($link_validation && $weight_validation && $format_validation){
                    return true;
                } else {
                    return false;
                }
                break;
            case ComponentType::TEXT:
                var_dump(strlen($component->getText()));
                    $text_validation = strlen($component->getText()) <= 140;
                    if($text_validation){
                        return true;
                    }else{
                        return false;
                    }
                break;
        }

        return false;
    }

    public function saveObject($ad) {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $em->persist($ad);
        $em->flush();
    }
}
