<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Curso'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cursos'), ['controller' => 'Cursos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Curso'), ['controller' => 'Cursos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersCursos index large-9 medium-8 columns content">
    <h3><?= __('Users Cursos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('curso_id') ?></th>
                <th><?= $this->Paginator->sort('ciudad') ?></th>
                <th><?= $this->Paginator->sort('fecha_diplomado') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersCursos as $usersCurso): ?>
            <tr>
                <td><?= $this->Number->format($usersCurso->id) ?></td>
                <td><?= $usersCurso->has('user') ? $this->Html->link($usersCurso->user->name, ['controller' => 'Users', 'action' => 'view', $usersCurso->user->id]) : '' ?></td>
                <td><?= $usersCurso->has('curso') ? $this->Html->link($usersCurso->curso->id, ['controller' => 'Cursos', 'action' => 'view', $usersCurso->curso->id]) : '' ?></td>
                <td><?= h($usersCurso->ciudad) ?></td>
                <td><?= h($usersCurso->fecha_diplomado) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersCurso->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersCurso->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersCurso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersCurso->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
