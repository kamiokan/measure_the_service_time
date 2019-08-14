<?php

namespace App\Controller;

use DateTime;

class ServiceTimesController extends AppController
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
        $service_times = $this->Paginator->paginate($this->ServiceTimes->find());
        $this->set(compact('service_times'));
    }

    public function addStartTime($reservation_id = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);
        $now = new DateTime();
        $service_time = $this->ServiceTimes->newEntity();
        $insert = [
            'reservation_id' => $reservation_id,
            'start_time'     => $now,
        ];
        $service_time = $this->ServiceTimes->patchEntity($service_time, $insert);

        if ($this->ServiceTimes->save($service_time)) {
            $this->Flash->success(__('Your service_time has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to add your service_time.'));
    }

    public function addEndTime($reservation_id = null)
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post']);
        $now = new DateTime();
        $service_time = $this->ServiceTimes->find()->where(['reservation_id' => $reservation_id])->firstOrFail();

        // （終了時間）-（開始時間）で施術時間を計算
        $start_time = new DateTime($service_time->start_time);
        $elapsed_time = $start_time->diff($now);

        $insert = [
            'end_time'     => $now,
            'elapsed_time' => $elapsed_time->format('%H:%I:%S'),
        ];
        $service_time = $this->ServiceTimes->patchEntity($service_time, $insert);

        if ($this->ServiceTimes->save($service_time)) {
            $this->Flash->success(__('Your service_time has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to add your service_time.'));
    }
}
