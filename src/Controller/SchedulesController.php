<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class SchedulesController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
    }

    public function index()
    {
        $this->loadComponent('Paginator');
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT reservations.id AS id, user_id, menu_id,
                start_time, end_time, elapsed_time
                FROM reservations LEFT OUTER JOIN service_times 
                ON service_times.reservation_id = reservations.id')->fetchAll('assoc');
        $this->set('reservations', $results);
    }
}
