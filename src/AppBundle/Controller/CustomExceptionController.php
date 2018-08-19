<?php


namespace AppBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class CustomExceptionController extends ExceptionController
{
    /**
     * @param Request $request
     * @param FlattenException $exception
     * @param DebugLoggerInterface $logger
     *
     * @return Response
     */
    public function showExceptionAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null)
    {
        $code = $exception->getStatusCode();

        $response = new JsonResponse();
        $response->setStatusCode($code);

        return new JsonResponse([
                'status' => 'error',
                'error_code' => $code,
                'error_message' => $exception->getMessage(),
                'error_url' => $request->getUri(),
                'error_method' => $request->getMethod(),
                // minimalistic output for now
                //'error_trace' => $exception->getTrace()
            ]
        );

    }
}
