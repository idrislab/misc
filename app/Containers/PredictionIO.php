<?php
/**
 * @author Luís Pitta Grós <luis@idris.pt>
 */

namespace App\Containers;

use luisgros\docker\containers\Container;

class PredictionIO extends Container
{
    /**
     * @var string
     */
    public $repo = 'idrislab/predictionio';
    /**
     * @var string
     */
    public $tag = 'latest';

    /**
     * @return array
     */
    public function runCommand()
    {
        $sentiment = resource_path().'/sentiment';

        return [
            "-d -p 8000:8000 -v $sentiment:/sentiment -w /sentiment idrislab/predictionio ".
            '/bin/bash -c "pio-start-all;jps -l;'.
            'pio app new app --id 2 --access-key OVobAwW87UspbSN9jI0N6JCd80FPxpGM;'.
            'python data/import_eventserver.py --access_key OVobAwW87UspbSN9jI0N6JCd80FPxpGM '.
            '--file data/train.tsv;'.
            'pio build && pio train && pio deploy"',
        ];
    }

    public function postCommand()
    {
        $host = 'https://'.$this->vars->host.':8000';
        $this->ping($host);
    }
}
