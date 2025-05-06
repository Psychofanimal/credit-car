<?php

namespace App\Controller\API\V1\Request;

use AllowDynamicProperties;
use App\Entity\CalcStartegy;
use App\Entity\Property;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use App\Entity\Request as RequestCalc;

#[AllowDynamicProperties] #[Route('/api/v1')]
class Action extends AbstractController
{
     public function __construct(
         private readonly SerializerInterface $serializer,
     ) {}

    /**
     * @throws Exception
     */
    #[Route('/request', name: 'app_request', methods: ['POST'], format: 'json')]
    public function __invoke(
        #[MapRequestPayload(acceptFormat: 'json')] ?Request $request,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
    ): JsonResponse
    {
        $responseDto = new ResponseDto();
        try {
            $carId = $request->carId;
            $programId = $request->programId;
            $initialPayment = $request->initialPayment;
            $loanTerm = $request->loanTerm;

            $carProperty = $entityManager->getRepository(Property::class)->find($carId);
            $calcStrategy = $entityManager->getRepository(CalcStartegy::class)->findOneBy(["programId" => $programId]);

            //Проверяем корректность переданных данных
            if (null === $carProperty || null === $calcStrategy) {
                throw new Exception();
            }

            $requestCalc = new RequestCalc();
            $requestCalc->setCarId($carProperty);
            $requestCalc->setProgramId($calcStrategy);
            $requestCalc->setInitialPayment($initialPayment);
            $requestCalc->setLoanTerm($loanTerm);

            $responseDto->setSuccess(true);

            $this->response = $this->serializer->normalize(
                $responseDto,
                null,
                [AbstractNormalizer::GROUPS => ['request:item']]
            );
        } catch (Throwable $e) {
            $logger->error($e->getMessage());
        } finally {
            return $this->getResponse($responseDto);
        }
    }

    private function getResponse(ResponseDto $responseDto): JsonResponse
    {
        $response = $this->serializer->normalize($responseDto);
        return new JsonResponse($response, Response::HTTP_OK);
    }
}