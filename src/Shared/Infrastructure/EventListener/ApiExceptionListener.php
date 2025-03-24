<?php

namespace App\Shared\Infrastructure\EventListener;

use App\Shared\Infrastructure\Response\ApiErrorResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        
        $errorResponse = new ApiErrorResponse(
            success: false,
            message: $exception->getMessage(),
            code: $exception instanceof HttpExceptionInterface 
                ? $exception->getStatusCode() 
                : Response::HTTP_INTERNAL_SERVER_ERROR,
            trace: !$exception instanceof HttpExceptionInterface 
                ? $exception->getTrace()
                : []
        );

        $response = new JsonResponse(
            $errorResponse->toArray(), 
            $errorResponse->getCode()
        );
        
        if ($exception instanceof HttpExceptionInterface) {
             $response->headers->add($exception->getHeaders());

        }
        
        $event->setResponse($response);
    }
} 