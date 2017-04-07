<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Curso'), ['action' => 'edit', $usersCurso->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Curso'), ['action' => 'delete', $usersCurso->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersCurso->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Cursos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Curso'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cursos'), ['controller' => 'Cursos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Curso'), ['controller' => 'Cursos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersCursos view large-9 medium-8 columns content">
    <h3><?= h($usersCurso->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $usersCurso->has('user') ? $this->Html->link($usersCurso->user->name, ['controller' => 'Users', 'action' => 'view', $usersCurso->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Curso') ?></th>
            <td><?= $usersCurso->has('curso') ? $this->Html->link($usersCurso->curso->id, ['controller' => 'Cursos', 'action' => 'view', $usersCurso->curso->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Ciudad') ?></th>
            <td><?= h($usersCurso->ciudad) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersCurso->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha Diplomado') ?></th>
            <td><?= h($usersCurso->fecha_diplomado) ?></td>
        </tr>
    </table>
</div>
