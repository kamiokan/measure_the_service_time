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

    public function edit($id = null)
    {
        $service_time = $this->ServiceTimes->find()->where(['id' => $id])->firstOrFail();
        if ($this->request->is(['post', 'put'])) {
            $g = $this->request->getData();
            $start_time = $g['start_time']['year'] . '-' . $g['start_time']['month'] . '-' . $g['start_time']['day']
                . ' ' . $g['start_time']['hour'] . ':' . $g['start_time']['minute'] . ':00';
            $end_time = $g['end_time']['year'] . '-' . $g['end_time']['month'] . '-' . $g['end_time']['day']
                . ' ' . $g['end_time']['hour'] . ':' . $g['end_time']['minute'] . ':00';

            // （終了時間）-（開始時間）で施術時間を計算
            $start_time = new DateTime($start_time);
            $end_time = new DateTime($end_time);

            // 開始時間より終了時間が古い場合は間違っているというエラーメッセージ
            if ($start_time > $end_time) {
                $this->Flash->error(__('開始時間が終了時間よりも後になっています！'));

                // idを渡してeditを再描画する
                return $this->redirect(['action' => 'edit', $id]);
            }
            $elapsed_time = $start_time->diff($end_time);

            $insert = [
                'start_time'   => $start_time,
                'end_time'     => $end_time,
                'elapsed_time' => $elapsed_time->format('%H:%I:%S'),
            ];

            $this->ServiceTimes->patchEntity($service_time, $insert);
            if ($this->ServiceTimes->save($service_time)) {
                $this->Flash->success(__('Your service_time has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your service_time.'));
        }

        $this->set(compact('service_time'));
    }
}
