<?php

namespace Kanboard\Controller;

/**
 * Class CommentMailController
 *
 * @package 
 * @author  Frederic Guillot
 */
class CommentMailController extends BaseController
{
    public function create(array $values = array(), array $errors = array())
    {
        $task = $this->getTask();

        $this->response->html($this->helper->layout->task('comment_mail/create', array(
            'values'  => $values,
            'errors'  => $errors,
            'task'    => $task,
            'members' => $this->projectPermissionModel->getMembersWithEmail($task['project_id']),
        )));
    }

    public function save()
    {
        $task = $this->getTask();
        $values = $this->request->getValues();
        $values['task_id'] = $task['id'];
        $values['user_id'] = $this->userSession->getId();

        list($valid, $errors) = $this->commentValidator->validateEmailCreation($values);
        <?php /*
        if ($valid) {
            $this->sendByEmail($values, $task);
            $values = $this->prepareComment($values);

            if ($this->commentModel->create($values) !== false) {
                $this->flash->success(t('Comment sent by email successfully.'));
            } else {
                $this->flash->failure(t('Unable to create your comment.'));
            }

            $this->response->redirect($this->helper->url->to('TaskViewController', 'show', array('task_id' => $task['id']), 'comments'), true);
        } else {
            $this->create($values, $errors);
        } */ ?>
    }

    protected function sendByEmail(array $values, array $task)
    {
        $html = $this->template->render('comment_mail/email', array('email' => $values, 'task' => $task));
        $emails = explode_csv_field($values['emails']);

        foreach ($emails as $email) {
            $this->emailClient->send(
                $email,
                $email,
                $values['subject'],
                $html
            );
        }
    }

    protected function prepareComment(array $values)
    {
        $values['comment'] .= "\n\n_".t('Sent by email to "%s" (%s)', $values['emails'], $values['subject']).'_';

        unset($values['subject']);
        unset($values['emails']);

        return $values;
    }
}
