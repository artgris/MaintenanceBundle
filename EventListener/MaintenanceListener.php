<?php


namespace Artgris\MaintenanceBundle\EventListener;


use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelInterface;
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
	 * @var TwigEngine
	 */
	private $templating;
	/**
	 * MaintenanceListener constructor.
	 *
	 * @param array $maintenance
	 * @param KernelInterface $kernel
	 * @param TwigEngine $templating
	 */
	public function __construct(array $maintenance, KernelInterface $kernel, TwigEngine $templating)
	{
		$this->enable = $maintenance['enable'] ? $maintenance['enable'] : false;
		$this->ips = $maintenance['ips'] ? $maintenance['ips'] : [];
		$this->kernel = $kernel;
		$this->templating = $templating;
	}
	public function onKernelRequest(GetResponseEvent $event)
	{
		/**
		 * Conditions : Maintenance enable, not in dev/test mode, not in enable Ips
		 */
		if ($this->enable && !in_array($this->kernel->getEnvironment(), ['dev']) && !in_array(@$_SERVER['REMOTE_ADDR'], $this->ips)) {
			$content = $this->templating->render('@ArtgrisMaintenance/maintenance.html.twig');
			$event->setResponse(new Response($content, Response::HTTP_SERVICE_UNAVAILABLE));
			$event->stopPropagation();
		}
	}
}