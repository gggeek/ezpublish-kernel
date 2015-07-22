<?php

/**
 * File containing the DateModified sort clause class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 *
 * @version //autogentag//
 */

namespace eZ\Publish\Core\Search\Elasticsearch\Content\Location\SortClauseVisitor;

use eZ\Publish\Core\Search\Elasticsearch\Content\SortClauseVisitor;
use eZ\Publish\API\Repository\Values\Content\Query\SortClause;

/**
 * Visits the DateModified sort clause.
 */
class DateModified extends SortClauseVisitor
{
    /**
     * Check if visitor is applicable to current sort clause.
     *
     * @param \eZ\Publish\API\Repository\Values\Content\Query\SortClause $sortClause
     *
     * @return bool
     */
    public function canVisit(SortClause $sortClause)
    {
        return $sortClause instanceof SortClause\DateModified;
    }

    /**
     * Map field value to a proper Elasticsearch representation.
     *
     * @param \eZ\Publish\API\Repository\Values\Content\Query\SortClause $sortClause
     *
     * @return mixed
     */
    public function visit(SortClause $sortClause)
    {
        return array(
            'content_modified_dt' => array(
                'order' => $this->getDirection($sortClause),
            ),
        );
    }
}
