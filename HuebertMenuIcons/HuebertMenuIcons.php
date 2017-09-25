<?php
namespace HuebertMenuIcons;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;
use Shopware\Components\Theme\LessDefinition;
use Shopware\Bundle\AttributeBundle\Service\CrudService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HuebertMenuIcons extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatch',
            //'Theme_Compiler_Collect_Plugin_Javascript' => 'addJsFiles',
            'Theme_Compiler_Collect_Plugin_Less' => 'addLessFiles',
        ];
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     */
    public function onPostDispatch(\Enlight_Event_EventArgs $args) {
        //$this->container->get('Template')->addTemplateDir($this->getPath() . '/Views/');

        //$this->container->get('loader')->registerNamespace('Shopware\Plugins', $this->getPath() . '/Plugins/');

        $view = $args->getSubject()->View();
        $view->addTemplateDir($this->getPath() . '/Views');

        $path = Shopware()->Container()->get('kernel')->getPlugins()['AdvancedMenu'];
        $view->addTemplateDir($path);


    }

    /**
     * @inheritdoc
     */
    public function install(InstallContext $context) {
        //parent::install($context);
        $service = $this->container->get('shopware_attribute.crud_service');

        $service->update('s_categories_attributes', 'menu_icon_name', 'string', [
            'label' => 'Menu Icon/Bild Name',
            'supportText' => 'Bildnamen mit Dateiendung angeben z.B. meinIcon.png',
            'helpText' => 'Bilddatei muss in der Medienverwaltung vorhanden sein!',

            //user has the opportunity to translate the attribute field for each shop
            'translatable' => false,

            //attribute will be displayed in the backend module
            'displayInBackend' => true,

            //in case of multi_selection or single_selection type, article entities can be selected,
            'entity' => 'Shopware\Models\Article\Article',

            //numeric position for the backend view, sorted ascending
            'position' => 1,

            //user can modify the attribute in the free text field module
            'custom' => false,
        ]);

        $metaDataCache = Shopware()->Models()->getConfiguration()->getMetadataCacheImpl();
        $metaDataCache->deleteAll();
        Shopware()->Models()->generateAttributeModels(['s_categories_attributes']);

    }

    /**
     * @inheritdoc
     */
    public function uninstall(UninstallContext $context) {
        parent::uninstall($context);
    }

    public function addLessFiles(Enlight_Event_EventArgs $args) {
        $less = new LessDefinition(array(), array(
            __DIR__ . '/Views/frontend/_public/src/less/huebert_menu_icons.less'), __DIR__);

        return new ArrayCollection(array($less));
    }

    /*public function addJsFiles(Enlight_Event_EventArgs $args) {
        $jsFiles = array(
            __DIR__ . '/Views/frontend/_public/src/js/huebert_menu_icons.js',
        );

        return new ArrayCollection($jsFiles);
    }*/


}

