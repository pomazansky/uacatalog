<?php

namespace UACatalog\Models;

use Propel\Runtime\Connection\ConnectionInterface;
use UACatalog\Models\Base\Blog as BaseBlog;

/**
 * Skeleton subclass for representing a row from the 'blog' table.
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Blog extends BaseBlog
{

    /**
     * @param ConnectionInterface $con
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function delete(ConnectionInterface $con = null)
    {
        $filePath = __DIR__ . '/../../../web/upload/' . $this->getImgFile();

        if (is_file($filePath)) {
            unlink($filePath);
        }

        parent::delete($con);
    }

}
