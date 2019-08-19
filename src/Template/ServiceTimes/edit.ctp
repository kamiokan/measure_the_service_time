<h1>接客時間の編集</h1>
<?php
echo $this->Form->create($service_time);
?>
<div class="input datetime"><label>予約ＩＤ</label>
    <?= $service_time->reservation_id ?>
</div>
<?php
echo $this->Form->control('reservation_id', ['type' => 'hidden']);

// 日時のフォーマット設定
$this->Form->templates([
    'dateWidget' => '{{year}} 年 {{month}} 月 {{day}} 日 {{hour}} 時 {{minute}} 分',
]);
$attr = [
    'required'   => false,
    'monthNames' => false,
    'empty'      => false, //空選択可能かどうか
    'year'       => ['class' => "select-year"],
    'month'      => ['class' => "select-month"],
    'day'        => ['class' => "select-day"],
];

echo $this->Form->control('start_time', [
        'type'       => 'datetime',
        'monthNames' => false,
        'label'      => '接客開始時間',
        'dateFormat' => 'YMD',
        'minYear'    => date('Y') - 1,
        'maxYear'    => date('Y') + 1,
        'timeFormat' => '24', //時刻を24時間表記
    ]
);
echo $this->Form->control('end_time', [
        'type'       => 'datetime',
        'monthNames' => false,
        'label'      => '接客終了時間',
        'dateFormat' => 'YMD',
        'minYear'    => date('Y') - 1,
        'maxYear'    => date('Y') + 1,
        'timeFormat' => '24', //時刻を24時間表記
    ]
);
echo $this->Form->button(__('保存する'));
echo $this->Form->end();
?>
<div style="margin: 60px 0;">
    <?= $this->Html->link("＞＞ 接客時間一覧へ", ['controller' => 'ServiceTimes', 'action' => 'index']) ?>
</div>
<style>
    .datetime select {
        padding: 0 18px;
    }
</style>
