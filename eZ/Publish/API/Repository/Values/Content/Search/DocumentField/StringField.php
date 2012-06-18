<?php
/**
 * File containing the eZ\Publish\API\Repository\Values\Content\Search\DocumentField\StringField class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 */
namespace eZ\Publish\API\Repository\Values\Content\Search\DocumentField;

use eZ\Publish\API\Repository\Values\Content\Search\DocumentField;

/**
 * String document field
 */
class StringField extends DocumentField
{
    /**
     * The type name of the facet. Has to be handled by the solr schema.
     *
     * @var string
     */
    protected $type = 'ez_string';
}

