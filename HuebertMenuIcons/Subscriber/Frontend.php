<?php

namespace HuebertMenuIcons\Subscriber;

use Enlight\Event\SubscriberInterface;

class Frontend implements SubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Front_DispatchLoopStartup' => 'onStartDispatch'
        );
    }

    /**
     * @var ContainerInterface
     */
    protected $container;

    protected $templateDir;


    /**
     * BaseSubscriber constructor.
     *
     * @param ContainerInterface $container
     * @param                    $templateDir
     */
    public function __construct(ContainerInterface $container, $templateDir)
    {
        $this->container = $container;
        $this->templateDir = $templateDir;
    }

    public function onStartDispatch(\Enlight_Event_EventArgs $args)
    {
        Shopware()->Template()->addTemplateDir($this->templateDir);
    }
}
