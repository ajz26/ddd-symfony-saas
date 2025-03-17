<?php

namespace App\Cards\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        
        $data = [
            'success' => false,
            'message' => $exception->getMessage(),
            'code' => Response::HTTP_INTERNAL_SERVER_ERROR
        ];

        if ($exception instanceof HttpExceptionInterface) {
            $data['code'] = $exception->getStatusCode();
        }

        $response = new JsonResponse($data, $data['code']);
        
        if ($exception instanceof HttpExceptionInterface) {
            $response->headers->replace($exception->getHeaders());
        }
        
        $event->setResponse($response);
    }
} 