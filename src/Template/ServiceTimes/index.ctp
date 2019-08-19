<h1>接客時間一覧</h1>
<table>
    <tr>
        <th>予約ID</th>
        <th>サービス開始日時</th>
        <th>サービス終了日時</th>
        <th>経過時間</th>
        <th>編集</th>
    </tr>

    <!-- ここで、$articles クエリーオブジェクトを繰り返して、記事の情報を出力します -->

    <?php foreach ($service_times as $st): ?>
        <tr>
            <td>
                <?= $st->reservation_id ?>
            </td>
            <td>
                <?php if ($st->start_time) {
                    echo $st->start_time->format('Y/m/d H:i:s');
                } ?>
            </td>
            <td>
                <?php if ($st->end_time) {
                    echo $st->end_time->format('Y/m/d H:i:s');
                } ?>
            </td>
            <td>
                <?php if ($st->elapsed_time) {
                    echo $st->elapsed_time->format('H:i:s');
                } ?>
            </td>
            <td>
                <?= $this->Html->link('編集', ['action' => 'edit', $st->reservation_id]) ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div>
    <?= $this->Html->link("＞＞ 予約一覧へ", ['controller' => 'Schedules', 'action' => 'index']) ?>
</div>
