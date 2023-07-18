<?php
namespace Zoho\Api\Logger;

use Zoho\Crm\Util\Constants;

/**
 * This class used to give logger levels.
 */
abstract class Levels
{
    const FATAL = Constants::FATAL;
    const ERROR = Constants::ERROR_KEY;
    const WARNING = Constants::WARNING;
    const INFO = Constants::INFO_KEY;
    const DEBUG = Constants::DEBUG;
    const TRACE = Constants::TRACE;
    const ALL = Constants::ALL;
}
?>
