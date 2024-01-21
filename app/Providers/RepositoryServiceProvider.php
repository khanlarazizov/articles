<?php

namespace App\Providers;

use App\Interfaces\ICompany;
use App\Interfaces\IContract;
use App\Interfaces\IFolder;
use App\Interfaces\IProject;
use App\Interfaces\IProtocol;
use App\Repositories\CompanyRepository;
use App\Repositories\ContractRepository;
use App\Repositories\FolderRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ProtocolRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICompany::class,CompanyRepository::class);
        $this->app->bind(IProject::class,ProjectRepository::class);
        $this->app->bind(IFolder::class,FolderRepository::class);
        $this->app->bind(IContract::class,ContractRepository::class);
        $this->app->bind(IProtocol::class,ProtocolRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
