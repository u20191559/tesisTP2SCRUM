<div class="dropdown">
    <a href="#" class="dropdown-menu dropdown-menu-link-icon"><strong>#<?= $task['id'] ?> <i class="fa fa-caret-down"></i></strong></a>
    <ul>
        <?= $this->hook->render('template:task:dropdown:before-actions', array('task' => $task)) ?>

        <?php if ($this->projectRole->canUpdateTask($task)): ?>
            <?php if ($this->projectRole->canChangeAssignee($task) && array_key_exists('owner_id', $task) && $task['owner_id'] != $this->user->getId()): ?>
            <li>
                <?= $this->url->icon('hand-o-right', t('Assign to me'), 'TaskModificationController', 'assignToMe', ['task_id' => $task['id'], 'csrf_token' => $this->app->getToken()->getReusableCSRFToken(), 'redirect' => isset($redirect) ? $redirect : '']) ?>
            </li>
            <?php endif ?>
            <?php if (array_key_exists('date_started', $task) && empty($task['date_started'])): ?>
            <li>
                <?= $this->url->icon('play', t('Set the start date automatically'), 'TaskModificationController', 'start', ['task_id' => $task['id'], 'csrf_token' => $this->app->getToken()->getReusableCSRFToken(), 'redirect' => isset($redirect) ? $redirect : '']) ?>
            </li>
            <?php endif ?>
            <li>
                <?= $this->modal->large('edit', t('Edit the task'), 'TaskModificationController', 'edit', array('task_id' => $task['id'])) ?>
            </li>
        <?php endif ?>
        <li>
            <?= $this->modal->medium('plus', t('Add a sub-task'), 'SubtaskController', 'create', array('task_id' => $task['id'])) ?>
        </li>
        <?= $this->hook->render('template:task:dropdown:after-basic-actions', array('task' => $task)) ?>

        <li>
            <?= $this->modal->medium('code-fork', t('Add internal link'), 'TaskInternalLinkController', 'create', array('task_id' => $task['id'])) ?>
        </li>
        <li>
            <?= $this->modal->medium('external-link', t('Add external link'), 'TaskExternalLinkController', 'find', array('task_id' => $task['id'])) ?>
        </li>
        <?= $this->hook->render('template:task:dropdown:after-add-links', array('task' => $task)) ?>

        <li>
            <?= $this->modal->small('comment-o', t('Add a comment'), 'CommentController', 'create', array('task_id' => $task['id'])) ?>
        </li>
        <?= $this->hook->render('template:task:dropdown:after-add-comment', array('task' => $task)) ?>

        <li>
            <?= $this->modal->medium('file', t('Attach a document'), 'TaskFileController', 'create', array('task_id' => $task['id'])) ?>
        </li>
        <li>
            <?= $this->modal->medium('camera', t('Add a screenshot'), 'TaskPopoverController', 'screenshot', array('task_id' => $task['id'])) ?>
        </li>
        <?= $this->hook->render('template:task:dropdown:after-add-attachments', array('task' => $task)) ?>

        <li>
            <?= $this->modal->small('files-o', t('Duplicate'), 'TaskDuplicationController', 'duplicate', array('task_id' => $task['id'])) ?>
        </li>
        <li>
            <?= $this->modal->small('clipboard', t('Duplicate to project'), 'TaskDuplicationController', 'copy', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
        </li>
        <?= $this->hook->render('template:task:dropdown:after-duplicate-task', array('task' => $task)) ?>

        <li>
            <?= $this->modal->small('clone', t('Move to project'), 'TaskDuplicationController', 'move', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
        </li>
        <?php /*
        <li>
            <?= $this->modal->small('paper-plane', t('Send by email'), 'TaskMailController', 'create', array('task_id' => $task['id'])) ?>
        </li>
        */ ?>

        <?= $this->hook->render('template:task:dropdown:after-send-mail', array('task' => $task)) ?>

        <?php if ($this->projectRole->canRemoveTask($task)): ?>
            <li>
                <?= $this->modal->confirm('trash-o', t('Remove'), 'TaskSuppressionController', 'confirm', array('task_id' => $task['id'])) ?>
            </li>
        <?php endif ?>
        <?php if (isset($task['is_active']) && $this->projectRole->canChangeTaskStatusInColumn($task['project_id'], $task['column_id'])): ?>
        <li>
            <?php if ($task['is_active'] == 1): ?>
                <?= $this->modal->confirm('times', t('Close this task'), 'TaskStatusController', 'close', array('task_id' => $task['id'])) ?>
            <?php else: ?>
                <?= $this->modal->confirm('check-square-o', t('Open this task'), 'TaskStatusController', 'open', array('task_id' => $task['id'])) ?>
            <?php endif ?>
        </li>
        <?php endif ?>

        <?= $this->hook->render('template:task:dropdown', array('task' => $task)) ?>
    </ul>
</div>
