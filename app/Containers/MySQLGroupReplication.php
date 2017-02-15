<?php
/**
 * @author Luís Pitta Grós <luis@idris.pt>
 */

namespace App\Containers;

use luisgros\docker\containers\Container;

class MySQLGroupReplication extends Container
{
    /**
     * @var string
     */
    public $repo = 'mysql/mysql-gr';
    /**
     * @var string
     */
    public $tag = 'latest';
    /**
     * @var string
     */
    public $network = 'group1';
    /**
     * @var string
     */
    public $instances = 3;

    /**
     * @return array
     */
    public function runCommand()
    {
        return [
                '-d --rm --net=group1 -e MYSQL_ROOT_PASSWORD=ENV[DB_PASSWORD] \\'.
                '-e MYSQL_REPLICATION_USER=ENV[DB_PASSWORD] -e MYSQL_REPLICATION_PASSWORD=ENV[DB_PASSWORD] \\'.
                'mysql/mysql-gr --group_replication_group_seeds=\'ENV[CONTAINER_I2]:6606,ENV[CONTAINER_I3]:6606\' \\'.
                '--server-id=ENV[INSTANCE_ID]',

                '-d --rm --net=group1 -e MYSQL_ROOT_PASSWORD=ENV[DB_PASSWORD] \\'.
                '-e MYSQL_REPLICATION_USER=ENV[DB_PASSWORD] -e MYSQL_REPLICATION_PASSWORD=ENV[DB_PASSWORD] \\'.
                'mysql/mysql-gr --group_replication_group_seeds=\'ENV[CONTAINER_I1]:6606,ENV[CONTAINER_I3]:6606\' \\'.
                '--server-id=ENV[INSTANCE_ID]',

                '-d --rm --net=group1 -e MYSQL_ROOT_PASSWORD=ENV[DB_PASSWORD] \\'.
                '-e MYSQL_REPLICATION_USER=ENV[DB_PASSWORD] -e MYSQL_REPLICATION_PASSWORD=ENV[DB_PASSWORD] \\'.
                'mysql/mysql-gr --group_replication_group_seeds=\'ENV[CONTAINER_I1]:6606,ENV[CONTAINER_I2]:6606\' \\'.
                '--server-id=ENV[INSTANCE_ID]',
        ];
    }

    public function preCommand()
    {
        $this->docker('network create group1 &>/dev/null');
    }
}
