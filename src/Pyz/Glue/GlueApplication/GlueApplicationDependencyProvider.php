<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\GlueApplication;

use Spryker\Glue\AuthRestApi\Plugin\AccessTokensResourceRoutePlugin;
use Spryker\Glue\AuthRestApi\Plugin\AccessTokenValidatorPlugin;
use Spryker\Glue\AuthRestApi\Plugin\FormatAuthenticationErrorResponseHeadersPlugin;
use Spryker\Glue\AuthRestApi\Plugin\RefreshTokensResourceRoutePlugin;
use Spryker\Glue\CartItemsProductsRelationship\Plugin\CartItemsProductsRelationshipPlugin;
use Spryker\Glue\CartsRestApi\CartsRestApiConfig;
use Spryker\Glue\CartsRestApi\Plugin\CartItemsResourceRoutePlugin;
use Spryker\Glue\CartsRestApi\Plugin\CartsResourceRoutePlugin;
use Spryker\Glue\CatalogSearchProductsResourceRelationship\Plugin\CatalogSearchAbstractProductsResourceRelationshipPlugin;
use Spryker\Glue\CatalogSearchProductsResourceRelationship\Plugin\CatalogSearchSuggestionsAbstractProductsResourceRelationshipPlugin;
use Spryker\Glue\CatalogSearchRestApi\CatalogSearchRestApiConfig;
use Spryker\Glue\CatalogSearchRestApi\Plugin\CatalogSearchResourceRoutePlugin;
use Spryker\Glue\CatalogSearchRestApi\Plugin\CatalogSearchSuggestionsResourceRoutePlugin;
use Spryker\Glue\CategoriesRestApi\Plugin\CategoriesResourceRoutePlugin;
use Spryker\Glue\CategoriesRestApi\Plugin\CategoryResourceRoutePlugin;
use Spryker\Glue\CustomersRestApi\Plugin\CustomersResourceRoutePlugin;
use Spryker\Glue\CustomersRestApi\Plugin\SetCustomerBeforeActionPlugin;
use Spryker\Glue\GlueApplication\GlueApplicationDependencyProvider as SprykerGlueApplicationDependencyProvider;
use Spryker\Glue\GlueApplication\Plugin\Rest\SetStoreCurrentLocaleBeforeActionPlugin;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipCollectionInterface;
use Spryker\Glue\ProductAvailabilitiesRestApi\Plugin\AbstractProductAvailabilitiesRoutePlugin;
use Spryker\Glue\ProductAvailabilitiesRestApi\Plugin\ConcreteProductAvailabilitiesRoutePlugin;
use Spryker\Glue\ProductsProductAvailabilitiesResourceRelationship\Plugin\AbstractProductAvailabilitiesResourceRelationshipPlugin;
use Spryker\Glue\ProductsProductAvailabilitiesResourceRelationship\Plugin\ConcreteProductAvailabilitiesResourceRelationshipPlugin;
use Spryker\Glue\ProductsRestApi\Plugin\AbstractProductsResourceRoutePlugin;
use Spryker\Glue\ProductsRestApi\Plugin\ConcreteProductsResourceRoutePlugin;
use Spryker\Glue\ProductsRestApi\ProductsRestApiConfig;
use Spryker\Glue\StoresRestApi\Plugin\StoresResourceRoutePlugin;
use Spryker\Glue\WishlistItemsProductsResourceRelationship\Plugin\WishlistItemsConcreteProductsResourceRelationshipPlugin;
use Spryker\Glue\WishlistsRestApi\Plugin\WishlistItemsResourceRoutePlugin;
use Spryker\Glue\WishlistsRestApi\Plugin\WishlistsResourceRoutePlugin;
use Spryker\Glue\WishlistsRestApi\WishlistsRestApiConfig;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GlueApplicationDependencyProvider extends SprykerGlueApplicationDependencyProvider
{
    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface[]
     */
    protected function getResourceRoutePlugins(): array
    {
        return [
            new AccessTokensResourceRoutePlugin(),
            new RefreshTokensResourceRoutePlugin(),
            new CatalogSearchResourceRoutePlugin(),
            new StoresResourceRoutePlugin(),
            new CatalogSearchSuggestionsResourceRoutePlugin(),
            new ConcreteProductAvailabilitiesRoutePlugin(),
            new AbstractProductAvailabilitiesRoutePlugin(),
            new CategoriesResourceRoutePlugin(),
            new CategoryResourceRoutePlugin(),
            new CustomersResourceRoutePlugin(),
            new AbstractProductsResourceRoutePlugin(),
            new ConcreteProductsResourceRoutePlugin(),
            new CartsResourceRoutePlugin(),
            new CartItemsResourceRoutePlugin(),
            new WishlistsResourceRoutePlugin(),
            new WishlistItemsResourceRoutePlugin(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ValidateRestRequestPluginInterface[]
     */
    protected function getValidateRestRequestPlugins(): array
    {
        return [
            new AccessTokenValidatorPlugin(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\FormatResponseHeadersPluginInterface[]
     */
    protected function getFormatResponseHeadersPlugins(): array
    {
        return [
            new FormatAuthenticationErrorResponseHeadersPlugin(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ControllerBeforeActionPluginInterface[]
     */
    protected function getControllerBeforeActionPlugins(): array
    {
        return [
            new SetStoreCurrentLocaleBeforeActionPlugin(),
            new SetCustomerBeforeActionPlugin(),
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipCollectionInterface $resourceRelationshipCollection
     *
     * @return \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRelationshipCollectionInterface
     */
    protected function getResourceRelationshipPlugins(
        ResourceRelationshipCollectionInterface $resourceRelationshipCollection
    ): ResourceRelationshipCollectionInterface {
        $resourceRelationshipCollection->addRelationship(
            CartsRestApiConfig::RESOURCE_CART_ITEMS,
            new CartItemsProductsRelationshipPlugin()
        );
        $resourceRelationshipCollection->addRelationship(
            WishlistsRestApiConfig::RESOURCE_WISHLIST_ITEMS,
            new WishlistItemsConcreteProductsResourceRelationshipPlugin()
        );
        $resourceRelationshipCollection->addRelationship(
            CatalogSearchRestApiConfig::RESOURCE_CATALOG_SEARCH,
            new CatalogSearchAbstractProductsResourceRelationshipPlugin()
        );
        $resourceRelationshipCollection->addRelationship(
            CatalogSearchRestApiConfig::RESOURCE_CATALOG_SEARCH_SUGGESTIONS,
            new CatalogSearchSuggestionsAbstractProductsResourceRelationshipPlugin()
        );
        $resourceRelationshipCollection->addRelationship(
            ProductsRestApiConfig::RESOURCE_ABSTRACT_PRODUCTS,
            new AbstractProductAvailabilitiesResourceRelationshipPlugin()
        );
        $resourceRelationshipCollection->addRelationship(
            ProductsRestApiConfig::RESOURCE_CONCRETE_PRODUCTS,
            new ConcreteProductAvailabilitiesResourceRelationshipPlugin()
        );

        return $resourceRelationshipCollection;
    }
}
