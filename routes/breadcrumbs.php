<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Models\Project;
use App\Models\Company;
use App\Models\Contract;
use App\Models\Protocol;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Ana səhifə', route('home'));
});

// Home - Company
Breadcrumbs::for('company', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Şirkətlər', route('companies.index'));
});

// Home - Company - Project
Breadcrumbs::for('project', function (BreadcrumbTrail $trail, Company $company) {
    $trail->parent('company');
    $trail->push($company->name, route('companies.projects.index', $company));
});

// Home - Company - Project - Folder
Breadcrumbs::for('folder', function (BreadcrumbTrail $trail, Company $company, Project $project) {
    $trail->parent('project', $company, $project);
    $trail->push($project->name, route('companies.projects.folders.index', [$company, $project]));
});

// Home - Contract
Breadcrumbs::for('contract', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Müqavilələr', route('contracts.index'));
});

// Home - Contract - Edit
Breadcrumbs::for('contract-edit', function (BreadcrumbTrail $trail, Contract $contract) {
    $trail->parent('contract');
    $trail->push($contract->name, route('contracts.edit', $contract->id));
});

// Home - Protocol
Breadcrumbs::for('protocol', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Protokollar', route('protocols.index'));
});

// Home - Protocol - Edit
Breadcrumbs::for('protocol-edit', function (BreadcrumbTrail $trail, Protocol $protocol) {
    $trail->parent('contract');
    $trail->push($protocol->name, route('contracts.edit', $protocol->id));
});

// Home - ContractAddition
Breadcrumbs::for('contract-addition', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Müqaviləyə Əlavə', route('documents.index'));
});

//// Home - ContractAddition - Edit
//Breadcrumbs::for('protocol-edit', function (BreadcrumbTrail $trail, Protocol $protocol) {
//    $trail->parent('contract');
//    $trail->push($protocol->name, route('contracts.edit', $protocol->id));
//});


// Home - DeliveryStatement
Breadcrumbs::for('delivery-statement', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Təhvil-təslim aktı', route('documents.index'));
});

//// Home - DeliveryStatement - Edit
//Breadcrumbs::for('delivery-statement-edit', function (BreadcrumbTrail $trail, Protocol $protocol) {
//    $trail->parent('contract');
//    $trail->push($protocol->name, route('contracts.edit', $protocol->id));
//});

// Home - User
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('İstifadəçilər', route('users.index'));
});

