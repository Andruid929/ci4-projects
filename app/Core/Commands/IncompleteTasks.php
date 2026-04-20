<?php

namespace App\Core\Commands;

use App\Modules\Tasks\Models\TaskModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class IncompleteTasks extends BaseCommand
{

    protected $group = 'Tasks';
    protected $name = 'task:incomplete';
    protected $description = 'Get all incomplete tasks.';

    public function run(array $params)
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->where('status !=', 'closed')
            ->findAll();

        if (!$tasks) {
            CLI::write('No incomplete tasks found.', 'yellow');
            return EXIT_ERROR;
        }

        CLI::write('Incomplete Tasks:', 'green');
        foreach ($tasks as $task) {
            CLI::write('========================================', 'blue');
            CLI::write("ID: {$task['task_id']}", 'cyan');
            CLI::write("Title: {$task['title']}", 'white');
            CLI::write("Project Code: {$task['project_code']}", 'white');
            CLI::write("Priority: {$task['priority']}", 'white');
            CLI::write("Status: {$task['status']}", 'white');
            CLI::write("Due Date: {$task['due_date']}", 'white');
            CLI::newLine();

            return EXIT_SUCCESS;
        }
    }
}