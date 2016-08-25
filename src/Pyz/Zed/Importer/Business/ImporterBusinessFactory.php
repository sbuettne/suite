<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Importer\Business;

use Pyz\Zed\Importer\Business\Factory\InstallerFactory;
use Pyz\Zed\Importer\Business\Icecat\IcecatImporter;
use Pyz\Zed\Importer\ImporterConfig;
use Spryker\Zed\Installer\Business\InstallerBusinessFactory as SprykerInstallerBusinessFactory;
use Spryker\Zed\Messenger\Business\Model\MessengerInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Importer\ImporterConfig getConfig()
 */
class ImporterBusinessFactory extends SprykerInstallerBusinessFactory
{

    /**
     * @return \Pyz\Zed\Importer\Business\Factory\InstallerFactory
     */
    protected function createInstallerFactory()
    {
        return new InstallerFactory();
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\InstallerInterface[]
     */
    protected function getInstallerCollection()
    {
        return [
            ImporterConfig::RESOURCE_GLOSSARY => $this->createInstallerFactory()->createGlossaryInstaller(),
            ImporterConfig::RESOURCE_CATEGORY_ROOT => $this->createInstallerFactory()->createCategoryRootInstaller(),
            ImporterConfig::RESOURCE_CATEGORY => $this->createInstallerFactory()->createCategoryInstaller(),
            ImporterConfig::RESOURCE_CATEGORY_CATALOG => $this->createInstallerFactory()->createCategoryCatalogInstaller(),
            ImporterConfig::RESOURCE_TAX => $this->createInstallerFactory()->createTaxInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_ATTRIBUTE_KEY => $this->createInstallerFactory()->createProductAttributeKeyInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_MANAGEMENT_ATTRIBUTE => $this->createInstallerFactory()->createProductManagementAttributeInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_ABSTRACT => $this->createInstallerFactory()->createProductAbstractInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_CONCRETE => $this->createInstallerFactory()->createProductConcreteInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_PRICE => $this->createInstallerFactory()->createProductPriceInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_STOCK => $this->createInstallerFactory()->createProductStockInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_SEARCH_ATTRIBUTE => $this->createInstallerFactory()->createProductSearchAttributeInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_SEARCH_ATTRIBUTE_MAP => $this->createInstallerFactory()->createProductSearchAttributeMapInstaller(),
            ImporterConfig::RESOURCE_PRODUCT_SEARCH => $this->createInstallerFactory()->createProductSearchInstaller(),
            ImporterConfig::RESOURCE_CMS_PAGE => $this->createInstallerFactory()->createCmsPageInstaller(),
            ImporterConfig::RESOURCE_CMS_BLOCK => $this->createInstallerFactory()->createCmsBlockInstaller(),
            ImporterConfig::RESOURCE_SHIPMENT => $this->createInstallerFactory()->createShipmentInstaller(),
            ImporterConfig::RESOURCE_DISCOUNT => $this->createInstallerFactory()->createDiscountInstaller(),
        ];
    }

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param \Spryker\Zed\Messenger\Business\Model\MessengerInterface $messenger
     *
     * @return \Pyz\Zed\Importer\Business\Icecat\IcecatImporter
     */
    public function createIcecatImporter(OutputInterface $output, MessengerInterface $messenger)
    {
        return new IcecatImporter(
            $output,
            $messenger,
            $this->getInstallerCollection()
        );
    }

}
