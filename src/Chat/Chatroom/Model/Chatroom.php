<?php
declare(strict_types=1);

namespace Chat\Chatroom\Model;

use Chat\Message\Relation\HasManyMessage;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @property string $title
 * @property string $max
 * @author frada <fbahezna@gmail.com>
 */
class Chatroom extends AbstractModel
{
    use HasManyMessage;
}