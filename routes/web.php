<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BoardConfigController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QRcodeGenerateController;
use App\Http\Controllers\ReportConfigController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkingStatusController;
use Illuminate\Support\Facades\Route;

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

    // SubCategory All Route
    Route::controller(CategoryController::class)->group(function(){
//    Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory')->middleware('permission:subcategory.all');
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');

    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
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

    // Board All Route
    Route::controller(BoardController::class)->group(function () {

        Route::get('/manager/all/board/', 'index')->name('manager.all.boards');
        Route::get('/manager/add/board/', 'create')->name('manager.add.board');
        Route::get('/manager/show/board/', 'show')->name('manager.show.board');
        Route::post('/manager/save-board/', 'store')->name('manager.save-board');
        Route::get('/manager/edit/board/{id}', 'edit')->name('manager.edit.board');
        Route::post('/manager/update/board', 'update')->name('manager.update-board');
        Route::get('/manager/delete/board/{id}', 'destroy')->name('manager.delete.board');

        Route::post('/manager/update/board/status', 'UpdateProjectStatus')->name('manager.update.board.status');
    });

    // BoardConfigController All Route
    Route::controller(BoardConfigController::class)->group(function () {
        Route::get('/manager/board/config/{id}', 'create')->name('manager.config.board');
        Route::get('/manager/board/config/edit/{id}', 'edit')->name('manager.edit.config.board');
        Route::post('/manager/save-board-config', 'store')->name('manager.save-board-config');
        Route::post('/manager/update-board-config', 'update')->name('manager.update-board-config');
    });

    // ReportConfigController All Route
    Route::controller(ReportConfigController::class)->group(function () {
        Route::get('/manager/board/report-config/{id}', 'create')->name('manager.report-config.board');
        Route::get('/manager/board/report-config/edit/{id}', 'edit')->name('manager.edit.report-config.board');
        Route::post('/manager/save-board-report-config', 'store')->name('manager.save-report-config');
        Route::post('/manager/update-board-report-config', 'update')->name('manager.update-report-config');
    });

    // Teams All Route
    Route::controller(TeamController::class)->group(function () {

        Route::get('/manager/all/team/', 'index')->name('manager.all.teams');
        Route::get('/manager/add/team/', 'create')->name('manager.add.boardteam');
        Route::post('/manager/save-team/', 'store')->name('manager.board.save-team');
        Route::get('/manager/edit/team/{id}', 'edit')->name('manager.edit.boardteam');
        Route::post('/manager/update/team', 'update')->name('manager.update-boardteam');
        Route::get('/manager/delete/team/{id}', 'destroy')->name('manager.delete.boardteam');

        Route::post('/manager/update/board/team/status', 'UpdateTeamStatus')->name('manager.update.boardteam.status');
    });

    // Type All Route
    Route::controller(TypeController::class)->group(function () {

        Route::get('/manager/all/type/', 'index')->name('manager.all.types');
        Route::get('/manager/add/type/', 'create')->name('manager.add.boardtype');
        Route::post('/manager/save-type/', 'store')->name('manager.board.save-type');
        Route::get('/manager/edit/type/{id}', 'edit')->name('manager.edit.boardtype');
        Route::post('/manager/update/type', 'update')->name('manager.update-boardtype');
        Route::get('/manager/delete/type/{id}', 'destroy')->name('manager.delete.boardtype');

        Route::post('/manager/update/board/type/status', 'UpdateTeamStatus')->name('manager.update.boardtype.status');
    });

    // Working Status All Route
    Route::controller(WorkingStatusController::class)->group(function () {

        Route::get('/manager/all/working_status/', 'index')->name('manager.all.working_statuses');
        Route::get('/manager/add/working_status/', 'create')->name('manager.add.boardworking_status');
        Route::post('/manager/save-working_status/', 'store')->name('manager.board.save-working_status');
        Route::get('/manager/edit/working_status/{id}', 'edit')->name('manager.edit.boardworking_status');
        Route::post('/manager/update/working_status', 'update')->name('manager.update-boardworking_status');
        Route::get('/manager/delete/working_status/{id}', 'destroy')->name('manager.delete.boardworking_status');

        Route::post('/manager/update/board/working_status/status', 'UpdateTeamStatus')->name('manager.update.boardworking_status.status');
    });

    // Ticket Status All Route
    Route::controller(TicketStatusController::class)->group(function () {

        Route::get('/manager/all/ticket_status/', 'index')->name('manager.all.ticket_statuses');
        Route::get('/manager/add/ticket_status/', 'create')->name('manager.add.boardticket_status');
        Route::post('/manager/save-ticket_status/', 'store')->name('manager.board.save-ticket_status');
        Route::get('/manager/edit/ticket_status/{id}', 'edit')->name('manager.edit.boardticket_status');
        Route::post('/manager/update/ticket_status', 'update')->name('manager.update-boardticket_status');
        Route::get('/manager/delete/ticket_status/{id}', 'destroy')->name('manager.delete.boardticket_status');

        Route::post('/manager/update/board/ticket_status/status', 'UpdateTeamStatus')->name('manager.update.boardticket_status.status');
    });

    // Priority All Route
    Route::controller(PriorityController::class)->group(function () {

        Route::get('/manager/all/priority/', 'index')->name('manager.all.priorities');
        Route::get('/manager/add/priority/', 'create')->name('manager.add.boardpriority');
        Route::post('/manager/save-priority/', 'store')->name('manager.board.save-priority');
        Route::get('/manager/edit/priority/{id}', 'edit')->name('manager.edit.boardpriority');
        Route::post('/manager/update/priority', 'update')->name('manager.update-boardpriority');
        Route::get('/manager/delete/priority/{id}', 'destroy')->name('manager.delete.boardpriority');

        Route::post('/manager/update/board/priority/status', 'UpdateTeamStatus')->name('manager.update.boardpriority.status');
    });

    // Task All Route
    Route::controller(TaskController::class)->group(function () {
        Route::get('/manager/all/board/tasks/{id}', 'index')->name('manager.all.tasks');
        Route::get('/manager/all/tasks/', 'all_task')->name('manager.tasks');
        Route::get('/manager/add/board/tasks/{id}', 'create')->name('manager.add.task');
        Route::post('/manager/board/save-task', 'store')->name('manager.tasks.save');
        Route::get('/manager/edit/board/task/{id}', 'edit')->name('manager.edit.task');
        Route::get('/manager/details/task/{id}', 'show')->name('task.details');
        Route::post('/manager/review/task', 'update_status')->name('task.review');
        Route::post('/manager/comment/save', 'save_comment')->name('comment.save');
        Route::get('/manager/chart/show', 'chart_show')->name('chart.show');
        Route::get('/manager/clone/board/task/{id}', 'cloneTask')->name('manager.clone.task');
        Route::post('/manager/update/board/task', 'update')->name('manager.update-task');
        Route::post('/manager/clone/board/task', 'cloneTaskAction')->name('manager.clone-task');
        Route::get('/manager/delete/board/task/{id}', 'destroy')->name('manager.delete.task');
        Route::get('/manager/all/tasks/filter', 'filter')->name('manager.task.filter');
        Route::get('/manager/task/export/',  'export')->name('manager.task.export');
        Route::get('/manager/task/export-html/',  'exportToHtml')->name('manager.task.export.html');
        Route::get('/manager/task/export-pdf/',  'exportToPdf')->name('manager.task.export.pdf');

        Route::get('/manager/add/board/sub-tasks/{id}', 'create_sub_task')->name('manager.add.sub-task');
        Route::post('/manager/save/board/sub-tasks', 'save_sub_task')->name('manager.save.sub-task');
        Route::get('/manager/edit/board/sub-tasks/{id}', 'edit_sub_task')->name('manager.edit.sub-task');
        Route::post('/manager/update/board/sub-tasks', 'update_sub_task')->name('manager.update.sub-task');
    });

    // Manager Env
    Route::controller(EnvironmentController::class)->group(function () {
        Route::get('/manager/add/env/{id}', 'create')->name('manager.add.env');
        Route::get('/manager/edit/env/{id}', 'edit')->name('manager.edit.env');
        Route::get('/manager/show/env/{id}', 'show')->name('manager.show.env');
        Route::post('/manager/save/env/', 'store')->name('manager.save.env');
        Route::post('/manager/update/env/', 'update')->name('manager.update.env');
    });

    // Manager Comment
    Route::controller(CommentController::class)->group(function () {
        Route::get('/add/comment/{id}', 'create')->name('comment.add');
    });

    // Manager All User Route
    Route::controller(ManagerController::class)->group(function () {
        Route::get('/manager/all/users', 'AllUser')->name('manager.all.users');
        Route::get('/manager/add/users', 'AddUser')->name('manager.add.users');
        Route::post('/manager/save-user/', 'SaveUser')->name('manager.save-user');
        Route::get('/manager/edit/user/{id}', 'EditUser')->name('manager.edit.user');
        Route::post('/manager/update/user', 'UpdateUser')->name('manager.update-user');
        Route::get('/manager/delete/user/{id}', 'DeleteUser')->name('manager.delete.user');

        Route::post('/manager/update/user/status', 'UpdateUserStatus')->name('manager.update.user.status');
    });

    Route::controller(FileController::class)->group(function () {
        Route::get('/all/file', 'index')->name('all.file');
        Route::get('/share/file', 'ShareFile')->name('share.file');
        Route::get('/add/file', 'create')->name('add.file');

        Route::post('/store/file', 'StoreFile')->name('store.file');
        Route::get('/delete/file/{id}', 'DeleteFile')->name('delete.file');
        Route::post('/update/file/status', 'UpdateFileStatus')->name('update.file.status');
    });

    // Blog Post All Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog/post', 'BlogPost')->name('blog.post');
        Route::get('/add/blog/post', 'AddBlogPost')->name('add.blog.post');
        Route::post('/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
        Route::get('/edit/post/{id}', 'EditBlogPost')->name('edit.post');
        Route::post('/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
        Route::get('/delete/post/{id}', 'DeleteBlogPost')->name('delete.post');
        Route::get('/view/post/{id}', 'BlogDetails')->name('view.post');
    });

// Blog Category All Route
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blog/category', 'AllBlogCategory')->name('blog.category');
        Route::post('/blog/category/store', 'StoreBlogCategory')->name('blog.category.store');
        Route::get('/edit/blog/category/{id}', 'EditBlogCategory');
        Route::post('/blog/category/update', 'UpdateBlogCategory')->name('blog.category.update');
        Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
    });
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

// Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all/category', 'AllCategory')->name('admin.all.category');
        Route::get('/admin/add/category', 'AddCategory')->name('admin.add.category');
        Route::post('/admin/store/category', 'StoreCategory')->name('admin.store.category');
        Route::get('/admin/edit/category/{id}', 'EditCategory')->name('admin.edit.category');
        Route::post('/admin/update/category', 'UpdateCategory')->name('admin.update.category');
        Route::get('/admin/delete/category/{id}', 'DeleteCategory')->name('admin.delete.category');

    });


// SubCategory All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all/subcategory', 'AllSubCategory')->name('admin.all.subcategory');
        Route::get('/admin/add/subcategory', 'AddSubCategory')->name('admin.add.subcategory');
        Route::post('/admin/store/subcategory', 'StoreSubCategory')->name('admin.store.subcategory');
        Route::get('/admin/edit/subcategory/{id}', 'EditSubCategory')->name('admin.edit.subcategory');
        Route::post('/admin/update/subcategory', 'UpdateSubCategory')->name('admin.update.subcategory');
        Route::get('/admin/delete/subcategory/{id}', 'DeleteSubCategory')->name('admin.delete.subcategory');
    });


// Manager All User Route
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
// End Manager Group Middleware
Route::get('/manager/login', [ManagerController::class, 'ManagerLogin'])->name('manager.login');
Route::get('/manager/all/board/', [BoardController::class, 'index'])->name('manager.all.boards');
Route::get('/manager/show/board/{id}', [BoardController::class, 'show'])->name('manager.show.board');
Route::get('/manager/all/board/filter', [BoardController::class, 'filter'])->name('task.filter');

Route::controller(FileController::class)->group(function () {
    Route::get('/all/file', 'index')->name('all.file');
    Route::get('/share/file', 'ShareFile')->name('share.file');
    Route::get('/add/file', 'create')->name('add.file');

    Route::post('/store/file', 'StoreFile')->name('store.file');
    Route::get('/delete/file/{id}', 'destroy')->name('delete.file');
    Route::post('/update/file/status', 'UpdateFileStatus')->name('update.file.status');
    Route::get('/upload/files/', 'show')->name('upload.files');
    Route::get('/upload/file/user', 'UploadFileByUserId')->name('upload.files.user');
    Route::post('upload/file/post', 'UserStoreFile')->name('user.uploadfile.post');
});

Route::controller(QRcodeGenerateController::class)->group(function () {
    Route::get('/qrcode', 'index')->name('qrcode');
    Route::get('/qrcode/result', 'generate')->name('qrcode.result');
});

