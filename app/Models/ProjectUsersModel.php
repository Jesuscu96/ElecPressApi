<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectUsersModel extends Model
{
    protected $table = 'project_users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['project_id', 'user_id'];
    protected array $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'project_id' => 'integer',
        
    ];

    protected $validationRules = [
        'project_id' => 'required|integer',
        'user_id' => 'required|integer',
    ];

    public function getAllExpanded($idProject = null)
    {
        $builder = $this->select("
                project_users.id,
                project_users.project_id,
                projects.name as project_name,
                project_users.user_id,
                CONCAT(users.first_name,' ',users.last_name) as user_name,
                users.image as user_image
            ")
                ->join('projects', 'projects.id = project_users.project_id', 'left')
                ->join('users', 'users.id = project_users.user_id', 'left');
        if ($idProject !== null) {
            $builder->where('project_users.project_id', (int) $idProject);
        }
        return $builder->findAll();
    }
    public function getAllExpandedByProject($projectId)
    {
        return $this->select("
            project_users.id,
            project_users.project_id,
            projects.name as project_name,
            project_users.user_id,
            CONCAT(users.first_name,' ',users.last_name) as user_name,
            users.image as user_image
        ")
            ->join('projects', 'projects.id = project_users.project_id', 'left')
            ->join('users', 'users.id = project_users.user_id', 'left')
            ->where('project_users.project_id', $projectId)
            ->findAll();
    }


    public function getOneExpanded($id)
    {
        return $this->select("
                project_users.id,
                project_users.project_id,
                projects.name as project_name,
                project_users.user_id,
                CONCAT(users.first_name,' ',users.last_name) as user_name
            ")
            ->join('projects', 'projects.id = project_users.project_id', 'left')
            ->join('users', 'users.id = project_users.user_id', 'left')
            ->where('project_users.id', $id)
            ->first();
    }
}
