<h1>Feed</h1>
<?= $this->Html->link('Post', ['action' => 'add']) ?>
<table>
    <?php foreach ($t_feed as $t_feed): ?>
    <tr>
        <td>
            <?= $t_feed->name ?>
        </td>
        <td>
            <?= $t_feed->message ?>
        </td>
        <td>
            <?= $t_feed->create_at->format('Y/M/d H:m:s')?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>