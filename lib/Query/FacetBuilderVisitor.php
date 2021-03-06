<?php

/**
 * This file is part of the eZ Platform Solr Search Engine package.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */
namespace EzSystems\EzPlatformSolrSearchEngine\Query;

use eZ\Publish\API\Repository\Values\Content\Query\FacetBuilder;

/**
 * Visits the facet builder tree into a Solr query.
 */
abstract class FacetBuilderVisitor
{
    /**
     * CHeck if visitor is applicable to current facet result.
     *
     * @param string $field
     *
     * @return bool
     */
    abstract public function canMap($field);

    /**
     * Map Solr facet result back to facet objects.
     *
     * @param string $field
     * @param array $data
     *
     * @return Facet
     */
    abstract public function map($field, array $data);

    /**
     * CHeck if visitor is applicable to current facet builder.
     *
     * @param FacetBuilder $facetBuilder
     *
     * @return bool
     */
    abstract public function canVisit(FacetBuilder $facetBuilder);

    /**
     * Map field value to a proper Solr representation.
     *
     * @param FacetBuilder $facetBuilder
     *
     * @return string
     */
    abstract public function visit(FacetBuilder $facetBuilder);

    /**
     * Map Solr return array into a sane hash map.
     *
     * @param array $data
     *
     * @return array
     */
    protected function mapData(array $data)
    {
        $values = array();
        reset($data);
        while ($key = current($data)) {
            $values[$key] = next($data);
            next($data);
        }

        return $values;
    }
}
