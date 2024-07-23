<?php

use App\Http\Controllers\ProfileController;
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
    Route::controller(\App\Http\Controllers\ProjectController::class)->group(function () {
        Route::get('/admin/all/project', 'index')->name('admin.all.project');
        Route::get('/admin/add/project', 'create')->name('admin.add.project');
        Route::post('/admin/save-project/', 'store')->name('admin.save-project');
        Route::get('/admin/edit/project/{id}', 'edit')->name('admin.edit.project');
        Route::post('/admin/update/project', 'update')->name('admin.update-project');
        Route::get('/admin/delete/project/{id}', 'destroy')->name('admin.delete.project');

        Route::post('/admin/update/project/status', 'UpdateProjectStatus')->name('admin.update.project.status');

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


}); // End Manager Group Middleware

Route::get('/manager/login', [ManagerController::class, 'ManagerLogin'])->name('manager.login');

