<?php
/**
 * @todo: this isn't working
 */

namespace PermitHeatMapper\Spatial\ORM\AST\Functions\PostgreSQL;

use CrEOF\Spatial\ORM\Query\AST\Functions\AbstractSpatialDQLFunction;

class STCollect extends AbstractSpatialDQLFunction
{
    protected $platforms = array('postgresql');

    protected $functionName = 'ST_Collect';

    protected $minGeomExpr = 1;

    protected $maxGeomExpr = 1;
}
