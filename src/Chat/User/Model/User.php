<?php
declare(strict_types=1);

namespace Chat\User\Model;

use Illuminate\Auth\Authenticatable;
use Pandawa\Component\Ddd\AbstractModel;

/**
 * @property string $name
 * @property string $phone
 * @author frada <fbahezna@gmail.com>
 */
class User extends AbstractModel implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable;
}