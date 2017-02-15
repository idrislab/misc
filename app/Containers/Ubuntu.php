<?php
/**
 * @author Luís Pitta Grós <luis@idris.pt>
 */

namespace App\Containers;

use luisgros\docker\containers\Container;

class Ubuntu extends Container
{
    /**
     * @var string
     */
    public $repo = 'ubuntu';
    /**
     * @var string
     */
    public $tag = 'latest';

    public $verbose = true;

    /**
     * @return string
     */
    public function runCommand()
    {
        return [
            "-d ubuntu uname -a;uptime"
            ];
    }

    public function postCommand()
    {
    }
}
