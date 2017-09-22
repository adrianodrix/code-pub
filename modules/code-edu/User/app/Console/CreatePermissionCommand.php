<?php

namespace CodeEdu\User\Console;

use CodeEdu\User\Repositories\Contracts\PermissionRepository;
use Illuminate\Console\Command;
use CodeEdu\User\Facade\PermissionReaderFacade as PermissionReader;

class CreatePermissionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'codeeduuser:make-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criação de permissões baseado em controllers e actions.';

    /**
     * @var PermissionRepository
     */

    private $repository;


    /**
     * Create a new command instance.
     *
     * @param PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $count = 0;

        foreach (PermissionReader::getPermissions() as $permission) {
            if(!$this->existsPermission($permission)) {
                $count++;
                $this->repository->create($permission);
            }
        }
        $this->info("<info>{$count} Permissões Carregadas</info>");
    }

    /**
     * If exists Permission
     *
     * @param $permission
     * @return bool
     */
    private function existsPermission($permission) {
        $permission = $this->repository->findWhere([
            'name' =>  $permission['name'],
            'resource_name' => $permission['resource_name']
        ])->first();
        return !is_null($permission);
    }
}
