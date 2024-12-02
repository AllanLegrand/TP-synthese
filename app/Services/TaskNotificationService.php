<?php

namespace App\Services;

use CodeIgniter\Email\Email;
use App\Models\TaskModel;

class TaskNotificationService
{
	protected $taskModel;
	protected $email;

	public function __construct()
	{
		$this->taskModel = new TacheModel();
		$this->email = \Config\Services::email();
	}

	public function sendOverdueTaskNotifications()
	{
		$tasks = $this->taskModel->getOverdueTasks();
		$sentTasks = [];

		foreach ($tasks as $task) {
			$emailContent = "<p>La tâche <strong>{$task['titre']}</strong> est en retard !</p><p>Description : {$task['description']}</p>";

			$this->email->setFrom('votre_email@domaine.com', 'Gestionnaire de Tâches');
			$this->email->setTo($task['mail']);
			$this->email->setSubject('Notification : Tâche en retard');
			$this->email->setMessage($emailContent);

			if ($this->email->send()) {
				$sentTasks[] = $task['idTache'];
			}
		}

		return $sentTasks; // Optionnel pour debug ou logs
	}
}
