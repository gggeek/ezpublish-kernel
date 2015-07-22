<?php

/**
 * File containing the LogicalOr criterion visitor class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */

namespace eZ\Publish\Core\Search\Elasticsearch\Content\Common\CriterionVisitor;

use eZ\Publish\Core\Search\Elasticsearch\Content\CriterionVisitorDispatcher as Dispatcher;
use eZ\Publish\Core\Search\Elasticsearch\Content\CriterionVisitor;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;

/**
 * Visits the LogicalOr criterion.
 */
class LogicalOr extends CriterionVisitor
{
    /**
     * Check if visitor is applicable to current criterion.
     *
     * @param \eZ\Publish\API\Repository\Values\Content\Query\Criterion $criterion
     *
     * @return bool
     */
    public function canVisit(Criterion $criterion)
    {
        return $criterion instanceof Criterion\LogicalOr;
    }

    /**
     * Map field value to a proper Elasticsearch filter representation.
     *
     * @param \eZ\Publish\API\Repository\Values\Content\Query\Criterion $criterion
     * @param \eZ\Publish\Core\Search\Elasticsearch\Content\CriterionVisitorDispatcher $dispatcher
     * @param array $fieldFilters
     *
     * @return mixed
     */
    public function visitFilter(Criterion $criterion, Dispatcher $dispatcher, array $fieldFilters)
    {
        /* @var $criterion \eZ\Publish\API\Repository\Values\Content\Query\Criterion\LogicalOperator */
        return array(
            'or' => array_map(
                function ($value) use ($dispatcher, $fieldFilters) {
                    return $dispatcher->dispatch($value, Dispatcher::CONTEXT_FILTER, $fieldFilters);
                },
                $criterion->criteria
            ),
        );
    }

    /**
     * Map field value to a proper Elasticsearch query representation.
     *
     * @param \eZ\Publish\API\Repository\Values\Content\Query\Criterion $criterion
     * @param \eZ\Publish\Core\Search\Elasticsearch\Content\CriterionVisitorDispatcher $dispatcher
     * @param array $fieldFilters
     *
     * @return mixed
     */
    public function visitQuery(Criterion $criterion, Dispatcher $dispatcher, array $fieldFilters)
    {
        /* @var $criterion \eZ\Publish\API\Repository\Values\Content\Query\Criterion\LogicalOperator */
        return array(
            'bool' => array(
                'should' => array_map(
                    function ($value) use ($dispatcher, $fieldFilters) {
                        return $dispatcher->dispatch($value, Dispatcher::CONTEXT_FILTER, $fieldFilters);
                    },
                    $criterion->criteria
                ),
                'minimum_should_match' => 1,
            ),
        );
    }
}
