<?php
/*************************************************************************************/
/*      This file is part of the Thelia package.                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : dev@thelia.net                                                       */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE.txt  */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

namespace Comment;

use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Install\Database;
use Thelia\Model\ConfigQuery;
use Thelia\Module\BaseModule;

/**
 * Class Comment
 * @package Comment
 *
 * @author Michaël Espeche <michael.espeche@gmail.com>
 * @author Julien Chanséaume <jchanseaume@openstudio.fr>
 */
class Comment extends BaseModule
{
    public function postActivation(ConnectionInterface $con = null)
    {               
        ConfigQuery::write('comment_moderate', 1);
        ConfigQuery::write('comment_', 1);

        $database = new Database($con->getWrappedConnection());
        $database->insertSql(null, [THELIA_MODULE_DIR . 'Comment/Config/thelia.sql']);
    }
}
