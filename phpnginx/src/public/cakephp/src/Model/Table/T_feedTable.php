<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class T_feedTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
    }
}