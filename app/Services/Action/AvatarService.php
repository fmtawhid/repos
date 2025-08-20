<?php

namespace App\Services\Action;

use App\Models\Avatar;
use App\Services\BaseService;

/**
 * Class AiAvatarProService.
 */
class AvatarService extends BaseService
{
    private $avatar;

    public function __construct()
    {
        $this->avatar = new Avatar();
    }

    /**
     * @throws \Exception
     */
    public function getAvatars()
    {
        $voices = $this->getData(Avatar::query());

        return $voices;
    }

}
