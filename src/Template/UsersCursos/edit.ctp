<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersCurso->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersCurso->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users Cursos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cursos'), ['controller' => 'Cursos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Curso'), ['controller' => 'Cursos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersCursos form large-9 medium-8 columns content">
    <?= $this->Form->create($usersCurso) ?>
    <fieldset>
        <legend><?= __('Edit Users Curso') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('curso_id', ['options' => $cursos]);
            echo $this->Form->input('ciudad');
            echo $this->Form->input('fecha_diplomado');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
