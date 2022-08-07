<?php
/** @var $checkTable */
?>
<table>
    <tr>
        <th>Дата проверки</th>
        <th>URL</th>
        <th>HTTP код</th>
        <th>Попытка</th>
        <th>ID запросивший проверку</th>
    </tr>
    <?php foreach($checkTable as $row): ?>
        <tr>
            <td><?= $row->check_date ?></td>
            <td><?= $row->url ?></td>
            <td><?= $row->http_code ?></td>
            <td><?= $row->attempt ?></td>
            <td><?= $row->user_id ?></td>
        </tr>
    <?php endforeach; ?>
</table>
