<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class CustomExceptionListener
 * @package AppBundle\EventListener
 */
class CustomExceptionListener
{
    private $templateEngine;
    private $kernel;

    /**
     * CustomExceptionListener constructor.
     * @param EngineInterface $templateEngine
     * @param KernelInterface $kernel
     */
    public function __construct(EngineInterface $templateEngine, KernelInterface $kernel)
    {
        $this->templateEngine = $templateEngine;
        $this->kernel = $kernel;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $env = $this->kernel->getEnvironment();

        if ($env == 'prod') {
            $exception = $event->getException();
            $message = $exception->getMessage();

            $response = $this->templateEngine->render(
                '@App/Error/error.html.twig',
                array('error' => $message)
            );

            $event->setResponse(new Response($response));
        }

    }
}