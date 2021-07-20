<?php


namespace Artgris\MaintenanceBundle\EventListener;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Environment;

/**
 * Maintenance Listener
 *
 * @author Arthur Gribet <a.gribet@gmail.com>
 */
class MaintenanceListener
{
    /**
     * @var bool
     */
    private $enable;
    /**
     * @var array
     */
    private $ips;
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var Environment
     */
    private $twig_Environment;
    /**
     * @var mixed
     */
    private $response;

    /**
     * MaintenanceListener constructor.
     *
     * @param array $maintenance
     * @param KernelInterface $kernel
     * @param Environment $twig_Environment
     */
    public function __construct(array $maintenance, KernelInterface $kernel, Environment $twig_Environment)
    {
        $this->enable = $maintenance['enable'] ?: false;
        $this->ips = $maintenance['ips'] ?: [];
        $this->response = $maintenance['response'];
        $this->kernel = $kernel;
        $this->twig_Environment = $twig_Environment;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        /**
         * Conditions : Maintenance enable, not in dev/test mode, not in enable Ips
         */
        if ($this->enable && !in_array($this->kernel->getEnvironment(), ['dev']) && !in_array(@$_SERVER['REMOTE_ADDR'], $this->ips)) {
            $content = $this->twig_Environment->render('@ArtgrisMaintenance/maintenance.html.twig');
            $event->setResponse(new Response($content, $this->response));
        }
    }
}