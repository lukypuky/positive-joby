<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

use App\Orchid\Screens\Experience\ExperienceEditScreen;
use App\Orchid\Screens\Experience\ExperienceListScreen;
use App\Orchid\Screens\Experience\ExperienceCreateScreen;

use App\Orchid\Screens\Homeoffice\HomeofficeEditScreen;
use App\Orchid\Screens\Homeoffice\HomeofficeListScreen;
use App\Orchid\Screens\Homeoffice\HomeofficeCreateScreen;

use App\Orchid\Screens\EmploymentType\EmploymentTypeEditScreen;
use App\Orchid\Screens\EmploymentType\EmploymentTypeListScreen;
use App\Orchid\Screens\EmploymentType\EmploymentTypeCreateScreen;

use App\Orchid\Screens\SalaryType\SalaryTypeEditScreen;
use App\Orchid\Screens\SalaryType\SalaryTypeListScreen;
use App\Orchid\Screens\SalaryType\SalaryTypeCreateScreen;

use App\Orchid\Screens\SalaryText\SalaryTextEditScreen;
use App\Orchid\Screens\SalaryText\SalaryTextListScreen;
use App\Orchid\Screens\SalaryText\SalaryTextCreateScreen;

use App\Orchid\Screens\Reference\ReferenceEditScreen;
use App\Orchid\Screens\Reference\ReferenceListScreen;
use App\Orchid\Screens\Reference\ReferenceCreateScreen;

use App\Orchid\Screens\Job\JobEditScreen;
use App\Orchid\Screens\Job\JobListScreen;
use App\Orchid\Screens\Job\JobCreateScreen;


/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push('Example screen');
    });

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', Idea::class, 'platform.screens.idea');

Route::screen('skusenost/{skusenost?}', ExperienceEditScreen::class)
    ->name('platform.experience.edit');
Route::screen('skusenosti', ExperienceListScreen::class)
    ->name('platform.experience.list');
Route::screen('skusenost-create', ExperienceCreateScreen::class)
    ->name('platform.experience.create');

Route::screen('homeoffice/{homeoffice?}', HomeofficeEditScreen::class)
    ->name('platform.homeoffice.edit');
Route::screen('homeoffices', HomeofficeListScreen::class)
    ->name('platform.homeoffice.list');
Route::screen('homeoffice-create', HomeofficeCreateScreen::class)
    ->name('platform.homeoffice.create');

Route::screen('druh-pracovneho-pomeru/{druhpracovnehopomeru?}', EmploymentTypeEditScreen::class)
    ->name('platform.employmentType.edit');
Route::screen('druhy-pracovneho-pomeru', EmploymentTypeListScreen::class)
    ->name('platform.employmentType.list');
Route::screen('druh-pracovneho-pomeru-create', EmploymentTypeCreateScreen::class)
    ->name('platform.employmentType.create');

Route::screen('typ-platu/{typplatu?}', SalaryTypeEditScreen::class)
    ->name('platform.salaryType.edit');
Route::screen('typy-platu', SalaryTypeListScreen::class)
    ->name('platform.salaryType.list');
Route::screen('typ-platu-create', SalaryTypeCreateScreen::class)
    ->name('platform.salaryType.create');

Route::screen('text-platu/{textplatu?}', SalaryTextEditScreen::class)
    ->name('platform.salaryText.edit');
Route::screen('texty-platu', SalaryTextListScreen::class)
    ->name('platform.salaryText.list');
Route::screen('text-platu-create', SalaryTextCreateScreen::class)
    ->name('platform.salaryText.create');

Route::screen('referencia/{referencia?}', ReferenceEditScreen::class)
    ->name('platform.reference.edit');
Route::screen('referencie', ReferenceListScreen::class)
    ->name('platform.reference.list');
Route::screen('referencia-create', ReferenceCreateScreen::class)
    ->name('platform.reference.create');

Route::screen('job/{job?}', JobEditScreen::class)
    ->name('platform.job.edit');
Route::screen('joby', JobListScreen::class)
    ->name('platform.job.list');
Route::screen('job-create', JobCreateScreen::class)
    ->name('platform.job.create');