<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

#[AsEventListener(event: 'kernel.response', method: 'onResponse')]
class MapRequestPayloadResponseEventListener
{
    public function __construct(
        public readonly DecoderInterface $serializer
    ) {}

    public function onResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();

        if (Response::HTTP_NOT_FOUND === $response->getStatusCode()) {
            $event->setResponse(new JsonResponse([
                'error' => [
                    'name' => 'Http Status Code Not Found',
                    'message' => "Данного маршрута не существует",
                ]], Response::HTTP_NOT_FOUND));
        }

        if ($event->isMainRequest() && 'application/json' === $response->headers->get('Content-Type')) {
            if (Response::HTTP_UNPROCESSABLE_ENTITY === $response->getStatusCode()) {
                $content = $this->serializer->decode($response->getContent(), 'json');
                $message = "непредвиденная ошибка";
                if (array_key_exists('detail', $content)) {
                    $message = $content['detail'];
                } else if (array_key_exists('error', $content)) {
                    $message = $content['error']['message'];
                }

                $event->setResponse(new JsonResponse([
                    'error' => [
                        'name' => 'Data Validation Failed',
                        'message' => $message,
                    ]], Response::HTTP_UNPROCESSABLE_ENTITY));
            }
        }
    }
}
