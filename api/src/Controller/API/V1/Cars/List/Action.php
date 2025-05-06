<?php
namespace App\Controller\API\V1\Cars\List;

use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

#[Route('/api/v1')]
class Action extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/cars', name: 'app_get_car_list', methods: ['GET'])]
    public function __invoke(
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ): JsonResponse
    {
        try {
            $carList = $entityManager->getRepository(Property::class)->findAll();

            $response = $serializer->normalize(
                $carList,
                null,
                [AbstractNormalizer::GROUPS => ['property:list']]
            );

            return new JsonResponse($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            $logger->error($e->getMessage());
            return new JsonResponse([
                "error" => [
                    "name" => "Ошибка получения данных",
                    "message" => "Произошла непредвиденная ошибка. Мы уже занимаемся ее исправлением",
                ]
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}