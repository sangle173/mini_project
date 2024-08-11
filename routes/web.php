<?php

use App\Http\Controllers\BoardConfigController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ManagerProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\WorkingStatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index'])->name('index');


Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');

});

require __DIR__ . '/auth.php';

///// Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

// Project All Route
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/admin/all/projects', 'index')->name('admin.all.projects');
        Route::get('/admin/add/projects', 'create')->name('admin.add.projects');
        Route::post('/admin/save-projects/', 'store')->name('admin.save-projects');
        Route::get('/admin/edit/projects/{id}', 'edit')->name('admin.edit.projects');
        Route::post('/admin/update/projects', 'update')->name('admin.update-projects');
        Route::get('/admin/delete/projects/{id}', 'destroy')->name('admin.delete.projects');

        Route::post('/admin/update/projects/status', 'UpdateProjectStatus')->name('admin.update.projects.status');

    });
// Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all/category', 'AllCategory')->name('all.category');
        Route::get('/admin/add/category', 'AddCategory')->name('add.category');
        Route::post('/admin/store/category', 'StoreCategory')->name('store.category');
        Route::get('/admin/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/admin/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/admin/delete/category/{id}', 'DeleteCategory')->name('delete.category');

    });


// SubCategory All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/admin/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/admin/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/admin/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/admin/update/subcategory', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/admin/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
    });


// Manager All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/all/users', 'AllUser')->name('admin.all.users');
        Route::get('/admin/add/users', 'AddUser')->name('admin.add.users');
        Route::post('/admin/save-user/', 'SaveUser')->name('admin.save-user');
        Route::get('/admin/edit/user/{id}', 'EditUser')->name('admin.edit.user');
        Route::post('/admin/update/user', 'UpdateUser')->name('admin.update-user');
        Route::get('/admin/delete/user/{id}', 'DeleteUser')->name('admin.delete.user');

        Route::post('/admin/update/user/status', 'UpdateUserStatus')->name('admin.update.user.status');
    });


}); // End Admin Group Middleware


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::get('/become/users', [AdminController::class, 'BecomeManager'])->name('become.users');
Route::post('/users/register', [AdminController::class, 'ManagerRegister'])->name('users.register');


///// Manager Group Middleware
Route::middleware(['auth', 'roles:manager'])->group(function () {

    Route::get('/manager/dashboard', [ManagerController::class, 'ManagerDashboard'])->name('manager.dashboard');
    Route::get('/manager/logout', [ManagerController::class, 'ManagerLogout'])->name('manager.logout');

    Route::get('/manager/profile', [ManagerController::class, 'ManagerProfile'])->name('manager.profile');
    Route::post('/manager/profile/store', [ManagerController::class, 'ManagerProfileStore'])->name('manager.profile.store');

    Route::get('/manager/change/password', [ManagerController::class, 'ManagerChangePassword'])->name('manager.change.password');
    Route::post('/manager/password/update', [ManagerController::class, 'ManagerPasswordUpdate'])->name('manager.password.update');


// Manager All Route
    Route::controller(CourseController::class)->group(function () {
        Route::get('/all/course', 'AllCourse')->name('all.course');
        Route::get('/add/course', 'AddCourse')->name('add.course');

        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');

        Route::post('/store/course', 'StoreCourse')->name('store.course');
        Route::get('/edit/course/{id}', 'EditCourse')->name('edit.course');
        Route::post('/update/course', 'UpdateCourse')->name('update.course');
        Route::post('/update/course/image', 'UpdateCourseImage')->name('update.course.image');
        Route::post('/update/course/video', 'UpdateCourseVideo')->name('update.course.video');
        Route::post('/update/course/goal', 'UpdateCourseGoal')->name('update.course.goal');
        Route::get('/delete/course/{id}', 'DeleteCourse')->name('delete.course');

    });


// Course Section and Lecture All Route
    Route::controller(CourseController::class)->group(function () {
        Route::get('/add/course/lecture/{id}', 'AddCourseLecture')->name('add.course.lecture');
        Route::post('/add/course/section/', 'AddCourseSection')->name('add.course.section');

        Route::post('/save-lecture/', 'SaveLecture')->name('save-lecture');

        Route::get('/edit/lecture/{id}', 'EditLecture')->name('edit.lecture');
        Route::post('/update/course/lecture', 'UpdateCourseLecture')->name('update.course.lecture');
        Route::get('/delete/lecture/{id}', 'DeleteLecture')->name('delete.lecture');
        Route::post('/delete/section/{id}', 'DeleteSection')->name('delete.section');
    });

    // Project All Route
    Route::controller(ManagerProjectController::class)->group(function () {
        Route::get('/manager/all/projects', 'index')->name('manager.all.projects');
    });

    // Board All Route
    Route::controller(BoardController::class)->group(function () {

        Route::get('/manager/all/board/{id}', 'index')->name('manager.all.boards');
        Route::get('/manager/add/board/{id}', 'create')->name('manager.add.board');
        Route::get('/manager/show/board/{id}', 'show')->name('manager.show.board');
        Route::post('/manager/save-board/', 'store')->name('manager.save-board');
        Route::get('/manager/edit/board/{id}', 'edit')->name('manager.edit.board');
        Route::post('/manager/update/board', 'update')->name('manager.update-board');
        Route::get('/manager/delete/board/{id}', 'destroy')->name('manager.delete.board');

        Route::post('/manager/update/board/status', 'UpdateProjectStatus')->name('manager.update.board.status');
    });

    // Board All Route
    Route::controller(BoardConfigController::class)->group(function () {
        Route::get('/manager/board/config/{id}', 'create')->name('manager.config.board');
        Route::get('/manager/board/config/edit/{id}', 'edit')->name('manager.edit.config.board');
        Route::post('/manager/save-board-config', 'store')->name('manager.save-board-config');
        Route::post('/manager/update-board-config', 'update')->name('manager.update-board-config');
    });

    // Teams All Route
    Route::controller(TeamController::class)->group(function () {

        Route::get('/manager/all/board/team/{id}', 'index')->name('manager.all.boardteams');
        Route::get('/manager/add/board/team/{id}', 'create')->name('manager.add.boardteam');
        Route::post('/manager/board/save-team/', 'store')->name('manager.board.save-team');
        Route::get('/manager/edit/board/team/{id}', 'edit')->name('manager.edit.boardteam');
        Route::post('/manager/update/board/team', 'update')->name('manager.update-boardteam');
        Route::get('/manager/delete/board/team/{id}', 'destroy')->name('manager.delete.boardteam');

        Route::post('/manager/update/board/team/status', 'UpdateTeamStatus')->name('manager.update.boardteam.status');
    });

    // Type All Route
    Route::controller(TypeController::class)->group(function () {

        Route::get('/manager/all/board/type/{id}', 'index')->name('manager.all.boardtypes');
        Route::get('/manager/add/board/type/{id}', 'create')->name('manager.add.boardtype');
        Route::post('/manager/board/save-type/', 'store')->name('manager.board.save-type');
        Route::get('/manager/edit/board/type/{id}', 'edit')->name('manager.edit.boardtype');
        Route::post('/manager/update/board/type', 'update')->name('manager.update-boardtype');
        Route::get('/manager/delete/board/type/{id}', 'destroy')->name('manager.delete.boardtype');

        Route::post('/manager/update/board/type/status', 'UpdateTeamStatus')->name('manager.update.boardtype.status');
    });

    // Working Status All Route
    Route::controller(WorkingStatusController::class)->group(function () {

        Route::get('/manager/all/board/working_status/{id}', 'index')->name('manager.all.boardworking_statuses');
        Route::get('/manager/add/board/working_status/{id}', 'create')->name('manager.add.boardworking_status');
        Route::post('/manager/board/save-working_status/', 'store')->name('manager.board.save-working_status');
        Route::get('/manager/edit/board/working_status/{id}', 'edit')->name('manager.edit.boardworking_status');
        Route::post('/manager/update/board/working_status', 'update')->name('manager.update-boardworking_status');
        Route::get('/manager/delete/board/working_status/{id}', 'destroy')->name('manager.delete.boardworking_status');

        Route::post('/manager/update/board/working_status/status', 'UpdateTeamStatus')->name('manager.update.boardworking_status.status');
    });

    // Ticket Status All Route
    Route::controller(TicketStatusController::class)->group(function () {

        Route::get('/manager/all/board/ticket_status/{id}', 'index')->name('manager.all.boardticket_statuses');
        Route::get('/manager/add/board/ticket_status/{id}', 'create')->name('manager.add.boardticket_status');
        Route::post('/manager/board/save-ticket_status/', 'store')->name('manager.board.save-ticket_status');
        Route::get('/manager/edit/board/ticket_status/{id}', 'edit')->name('manager.edit.boardticket_status');
        Route::post('/manager/update/board/ticket_status', 'update')->name('manager.update-boardticket_status');
        Route::get('/manager/delete/board/ticket_status/{id}', 'destroy')->name('manager.delete.boardticket_status');

        Route::post('/manager/update/board/ticket_status/status', 'UpdateTeamStatus')->name('manager.update.boardticket_status.status');
    });

    // Task All Route
    Route::controller(TaskController::class)->group(function () {

        Route::get('/manager/all/board/tasks/{id}', 'index')->name('manager.all.tasks');
        Route::get('/manager/add/board/tasks/{id}', 'create')->name('manager.add.task');
        Route::post('/manager/board/save-task', 'store')->name('manager.tasks.save');
//        Route::get('/manager/edit/board/ticket_status/{id}', 'edit')->name('manager.edit.boardticket_status');
//        Route::post('/manager/update/board/ticket_status', 'update')->name('manager.update-boardticket_status');
//        Route::get('/manager/delete/board/ticket_status/{id}', 'destroy')->name('manager.delete.boardticket_status');

//        Route::post('/manager/update/board/ticket_status/status', 'UpdateTeamStatus')->name('manager.update.boardticket_status.status');
    });


}); // End Manager Group Middleware

Route::get('/manager/login', [ManagerController::class, 'ManagerLogin'])->name('manager.login');

