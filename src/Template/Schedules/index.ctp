<h1>予約一覧</h1>
<table>
    <tr>
        <th>予約ID</th>
        <th>ユーザーＩＤ</th>
        <th>メニューＩＤ</th>
        <th>開始時間記録</th>
        <th>終了時間記録</th>
        <th>施術時間</th>
    </tr>

    <?php foreach ($reservations as $r): ?>
        <tr>
            <td>
                <?= $r['id'] ?>
            </td>
            <td>
                <?= $r['user_id'] ?>
            </td>
            <td>
                <?= $r['menu_id'] ?>
            </td>
            <td>
                <?php if (is_null($r['start_time'])) { ?>
                    <?= $this->Form->postLink(
                        'スタート！',
                        ['controller' => 'ServiceTimes', 'action' => 'addStartTime', $r['id']],
                        ['confirm' => '開始してよいですか?'])
                    ?>
                <?php } else { ?>
                    (<?= $r['start_time'] ?>)スタート済
                <?php } ?>
            </td>
            <td>
                <?php if (is_null($r['end_time'])) { ?>
                    <?= $this->Form->postLink(
                        '終了！',
                        ['controller' => 'ServiceTimes', 'action' => 'addEndTime', $r['id']],
                        ['confirm' => '終了してよいですか?'])
                    ?>
                <?php } else { ?>
                    (<?= $r['end_time'] ?>)終了処理済
                <?php } ?>
            </td>
            <td>
                <?php if (is_null($r['elapsed_time'])) { ?>
                    -
                <?php } else { ?>
                    (<?= $r['elapsed_time'] ?>)
                <?php } ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div>
    <?= $this->Html->link("＞＞ 接客時間一覧へ", ['controller' => 'ServiceTimes', 'action' => 'index']) ?>
</div>
