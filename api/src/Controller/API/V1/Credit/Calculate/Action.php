<?php

namespace App\Controller\API\V1\Credit\Calculate;

use App\Entity\CalcStartegy;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

#[Route('/api/v1/credit')]
class Action extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/calculate', name: 'app_calculate_credit', methods: ['GET'])]
    public function __invoke(
        #[MapQueryString(validationFailedStatusCode: Response::HTTP_UNPROCESSABLE_ENTITY)] ?Request $request,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ): JsonResponse
    {
        try {
            //Проверяем корректность переданных данных
            if(is_numeric($request->price)) {
                $price = (int)$request->price;
            } else {
                return new JsonResponse([
                    "error" => [
                        'name' => 'VALIDATION_ERROR',
                        "message" => "Цена передана некорректно",
                    ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if(is_numeric($request->initialPayment)) {
                $initialPayment = (float)number_format($request->initialPayment,2, '.', '');
            } else {
                return new JsonResponse([
                    "error" => [
                        'name' => 'VALIDATION_ERROR',
                        "message" => "Первоначальный взнос за кредит передан некорректно",
                    ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if(is_numeric($request->loanTerm)) {
                $loanTerm = (int)$request->loanTerm;
            } else {
                return new JsonResponse([
                    "error" => [
                        'name' => 'VALIDATION_ERROR',
                        "message" => "Срок кредита в месяцах передан некорректно",
                    ]
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $programId = 203;
            if ($initialPayment > 200000 && $loanTerm > 15) {
                $programId = 666;
            } elseif ($initialPayment > 50000 && $loanTerm > 10) {
                $programId = 101;
            }

            $carList = $entityManager->getRepository(CalcStartegy::class)->findOneBy(['programId' => $programId]);

            $response = $serializer->normalize(
                $carList,
                null,
                [AbstractNormalizer::GROUPS => ['credit_strategy:item']]
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