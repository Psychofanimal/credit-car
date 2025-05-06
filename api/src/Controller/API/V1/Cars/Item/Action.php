<?php
namespace App\Controller\API\V1\Cars\Item;

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
    #[Route('/cars/{id}', name: 'app_get_car_item', methods: ['GET'])]
    public function __invoke(
        int $id,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ): JsonResponse
    {
        try {
            $carItem = $entityManager->getRepository(Property::class)->find($id);

            $response = $serializer->normalize(
                $carItem,
                null,
                [AbstractNormalizer::GROUPS => ['property:item']]
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