<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Prueba'), ['action' => 'edit', $prueba->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Prueba'), ['action' => 'delete', $prueba->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prueba->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pruebas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Prueba'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pruebas view large-9 medium-8 columns content">
    <h3><?= h($prueba->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Pruyeba') ?></th>
            <td><?= h($prueba->pruyeba) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($prueba->id) ?></td>
        </tr>
    </table>
</div>
