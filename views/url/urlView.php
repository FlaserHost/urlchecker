<?php
/** @var $urlTable */
?>
<table>
    <tr>
        <th>Дата создания</th>
        <th>URL</th>
        <th>Частота (сек)</th>
        <th>Повторов в сек.</th>
        <th>ID запросивший проверку</th>
    </tr>
    <?php foreach($urlTable as $row): ?>
        <tr>
            <td><?= $row->creation_date ?></td>
            <td><?= $row->url ?></td>
            <td><?= $row->frequency ?></td>
            <td><?= $row->repeat_count ?></td>
            <td><?= $row->user_id ?></td>
        </tr>
    <?php endforeach; ?>
</table>
