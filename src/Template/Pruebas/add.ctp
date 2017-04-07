<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pruebas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="pruebas form large-9 medium-8 columns content">
    <?= $this->Form->create($prueba) ?>
    <fieldset>
        <legend><?= __('Add Prueba') ?></legend>
        <?php
            echo $this->Form->input('pruyeba');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
