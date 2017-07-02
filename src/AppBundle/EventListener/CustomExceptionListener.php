<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Class CustomExceptionListener
 * @package AppBundle\EventListener
 */
class CustomExceptionListener
{
    private $templateEngine;

    /**
     * CustomExceptionListener constructor.
     * @param EngineInterface $templateEngine
     */
    public function __construct(EngineInterface $templateEngine)
    {
        $this->templateEngine = $templateEngine;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {

            $exception = $event->getException();
            $message = $exception->getMessage();

            $response = $this->templateEngine->render(
                '@App/Error/error.html.twig',
                array('error' => $message)
            );

            $event->setResponse(new Response($response));

    }
}