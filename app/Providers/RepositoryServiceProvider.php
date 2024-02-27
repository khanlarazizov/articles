<?php

namespace App\Providers;

use App\Lib\Repositories\CompanyRepository;
use App\Lib\Repositories\ContractRepository;
use App\Lib\Repositories\FolderRepository;
use App\Lib\Repositories\Interfaces\ICompanyRepository;
use App\Lib\Repositories\Interfaces\IContractRepository;
use App\Lib\Repositories\Interfaces\IFolderRepository;
use App\Lib\Repositories\Interfaces\IProjectRepository;
use App\Lib\Repositories\Interfaces\IProtocolRepository;
use App\Lib\Repositories\ProjectRepository;
use App\Lib\Repositories\ProtocolRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICompanyRepository::class,CompanyRepository::class);
        $this->app->bind(IProjectRepository::class,ProjectRepository::class);
        $this->app->bind(IFolderRepository::class,FolderRepository::class);
        $this->app->bind(IContractRepository::class,ContractRepository::class);
        $this->app->bind(IProtocolRepository::class,ProtocolRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
