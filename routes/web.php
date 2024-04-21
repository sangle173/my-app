<?php

use App\Http\Controllers\Backend\ActionController;
use App\Http\Controllers\Backend\AdminTaskController;
use App\Http\Controllers\Backend\FileController;
use App\Http\Controllers\Backend\InstructorBlogController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\TicketStatusController;
use App\Http\Controllers\Backend\WorkingStatusController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\InstructorCategoryController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;

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
})->middleware(['auth','roles:user','verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');


    // User Wishlist All Route
Route::controller(WishListController::class)->group(function(){
    Route::get('/user/wishlist','AllWishlist')->name('user.wishlist');
    Route::get('/get-wishlist-course/','GetWishlistCourse');
    Route::get('/wishlist-remove/{id}','RemoveWishlist');


});


    // User My Course All Route
    Route::controller(OrderController::class)->group(function(){
        Route::get('/my/course','MyCourse')->name('my.course');
        Route::get('/course/view/{course_id}','CourseView')->name('course.view');
        Route::get('/course/lecture/details/{id}','ViewCourseLectureGet')->name('course.lecture.details');
    });


     // User Question All Route
     Route::controller(QuestionController::class)->group(function(){
        Route::post('/user/question','UserQuestion')->name('user.question');

    });





});
///// End Auth Middleware


require __DIR__.'/auth.php';

///// Admin Group Middleware
Route::middleware(['auth','roles:admin'])->group(function(){

Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

// Category All Route
Route::controller(CategoryController::class)->group(function(){
//    Route::get('/all/category','AllCategory')->name('all.category')->middleware('permission:category.all');;
    Route::get('/all/category','AllCategory')->name('all.category');
    Route::get('/add/category','AddCategory')->name('add.category');
    Route::post('/store/category','StoreCategory')->name('store.category');
    Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
    Route::post('/update/category','UpdateCategory')->name('update.category');
    Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
});

// Team All Route
    Route::controller(TeamController::class)->group(function(){
        Route::get('/all/team','AllTeam')->name('all.team');
        Route::get('/add/team','AddTeam')->name('add.team');
        Route::post('/store/team','StoreTeam')->name('store.team');
        Route::get('/edit/team/{id}','EditTeam')->name('edit.team');
        Route::post('/update/team','UpdateTeam')->name('update.team');
        Route::get('/delete/team/{id}','DeleteTeam')->name('delete.team');
    });

    // Action All Route
    Route::controller(ActionController::class)->group(function(){
        Route::get('/all/action','AllAction')->name('all.action');
        Route::get('/add/action','AddAction')->name('add.action');
        Route::post('/store/action','StoreAction')->name('store.action');
        Route::get('/edit/action/{id}','EditAction')->name('edit.action');
        Route::post('/update/action','UpdateAction')->name('update.action');
        Route::get('/delete/action/{id}','DeleteAction')->name('delete.action');
    });

    // Working Status All Route
    Route::controller(WorkingStatusController::class)->group(function(){
        Route::get('/all/workingstatus','AllWorkingStatus')->name('all.workingstatus');
        Route::get('/add/workingstatus','AddWorkingStatus')->name('add.workingstatus');
        Route::post('/store/workingstatus','StoreWorkingStatus')->name('store.workingstatus');
        Route::get('/edit/workingstatus/{id}','EditWorkingStatus')->name('edit.workingstatus');
        Route::post('/update/workingstatus','UpdateWorkingStatus')->name('update.workingstatus');
        Route::get('/delete/workingstatus/{id}','DeleteWorkingStatus')->name('delete.workingstatus');
    });

    // Ticket Status All Route
    Route::controller(TicketStatusController::class)->group(function(){
        Route::get('/all/ticketstatus','AllTicketStatus')->name('all.ticketstatus');
        Route::get('/add/ticketstatus','AddTicketStatus')->name('add.ticketstatus');
        Route::post('/store/ticketstatus','StoreTicketStatus')->name('store.ticketstatus');
        Route::get('/edit/ticketstatus/{id}','EditTicketStatus')->name('edit.ticketstatus');
        Route::post('/update/ticketstatus','UpdateTicketStatus')->name('update.ticketstatus');
        Route::get('/delete/ticketstatus/{id}','DeleteTicketStatus')->name('delete.ticketstatus');
    });

    // Task All Task Route
    Route::controller(AdminTaskController::class)->group(function(){
        Route::get('/admin/all/task','AdminAllTask')->name('admin.all.task');
        Route::get('/admin/add/task','AdminAddTask')->name('admin.add.task');

        Route::post('/admin/store/task','AdminStoreTask')->name('admin.store.task');
        Route::get('/admin/edit/task/{id}','AdminEditTask')->name('admin.edit.task');
        Route::post('/admin/update/task','AdminUpdateTask')->name('admin.update.task');
        Route::get('/admin/delete/task/{id}','AdminDeleteTask')->name('admin.delete.task');
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



// Instructor All Route
Route::controller(AdminController::class)->group(function(){
    Route::get('/all/instructor','AllInstructor')->name('all.instructor');
    Route::post('/update/user/stauts','UpdateUserStatus')->name('update.user.stauts');
});

// Admin Coruses All Route
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/all/course','AdminAllCourse')->name('admin.all.course');
    Route::post('/update/course/stauts','UpdateCourseStatus')->name('update.course.stauts');
    Route::get('/admin/course/details/{id}','AdminCourseDetails')->name('admin.course.details');
});


// Admin Coupon All Route
Route::controller(CouponController::class)->group(function(){
    Route::get('/admin/all/coupon','AdminAllCoupon')->name('admin.all.coupon');
    Route::get('/admin/add/coupon','AdminAddCoupon')->name('admin.add.coupon');
    Route::post('/admin/store/coupon','AdminStoreCoupon')->name('admin.store.coupon');
    Route::get('/admin/edit/coupon/{id}','AdminEditCoupon')->name('admin.edit.coupon');
    Route::post('/admin/update/coupon','AdminUpdateCoupon')->name('admin.update.coupon');
    Route::get('/admin/delete/coupon/{id}','AdminDeleteCoupon')->name('admin.delete.coupon');

});


// SMPT All Route
Route::controller(SettingController::class)->group(function(){
    Route::get('/smtp/setting','SmtpSetting')->name('smtp.setting');
    Route::post('/update/smtp','SmtpSetting')->name('update.smtp');


});



// Site Setting All Route
Route::controller(SettingController::class)->group(function(){
    Route::get('/site/setting','SiteSetting')->name('site.setting');
    Route::post('/update/site','UpdateSite')->name('update.site');


});


// Admin All Order Route
Route::controller(OrderController::class)->group(function(){
    Route::get('/admin/pending/order','AdminPendingOrder')->name('admin.pending.order');
    Route::get('/admin/order/details/{id}','AdminOrderDetails')->name('admin.order.details');

    Route::get('/pending-confrim/{id}','PendingToConfirm')->name('pending-confrim');
    Route::get('/admin/confirm/order','AdminConfirmOrder')->name('admin.confirm.order');
});



// Admin Report All Route
Route::controller(ReportController::class)->group(function(){
    Route::get('/report/view','ReportView')->name('report.view');
    Route::get('/search/by/date','ReportView')->name('report');
    Route::post('/search/by/date','SearchByDate')->name('search.by.date');
    Route::post('/search/by/month','SearchByMonth')->name('search.by.month');
    Route::post('/search/by/year','SearchByYear')->name('search.by.year');

});

// Admin Review All Route
Route::controller(ReviewController::class)->group(function(){
    Route::get('/admin/pending/review','AdminPendingReview')->name('admin.pending.review');
    Route::post('/update/review/stauts','UpdateReviewStatus')->name('update.review.stauts');
    Route::get('/admin/active/review','AdminActiveReview')->name('admin.active.review');


});


// Admin All user and Instructor All Route
Route::controller(ActiveUserController::class)->group(function(){
    Route::get('/all/user','AllUser')->name('all.user');
    Route::get('/all/instructor','AllInstructor')->name('all.instructor');
});


// Permission All Route
Route::controller(RoleController::class)->group(function(){
    Route::get('/all/permission','AllPermission')->name('all.permission');
    Route::get('/add/permission','AddPermission')->name('add.permission');
    Route::post('/store/permission','StorePermission')->name('store.permission');
    Route::get('/edit/permission/{id}','EditPermission')->name('edit.permission');
    Route::post('/update/permission','UpdatePermission')->name('update.permission');
    Route::get('/delete/permission/{id}','DeletePermission')->name('delete.permission');


    Route::get('/import/permission','ImportPermission')->name('import.permission');
    Route::get('/export','Export')->name('export');
    Route::post('/import','Import')->name('import');
});


// Role All Route
Route::controller(RoleController::class)->group(function(){
    Route::get('/all/roles','AllRoles')->name('all.roles');
    Route::get('/add/roles','AddRoles')->name('add.roles');
    Route::post('/store/roles','StoreRoles')->name('store.roles');
    Route::get('/edit/roles/{id}','EditRoles')->name('edit.roles');
    Route::post('/update/roles','UpdateRoles')->name('update.roles');
    Route::get('/delete/roles/{id}','DeleteRoles')->name('delete.roles');


    Route::get('/add/roles/permission','AddRolesPermission')->name('add.roles.permission');

    Route::post('/role/permission/store','RolePermissionStore')->name('role.permission.store');
    Route::get('/all/roles/permission','AllRolesPermission')->name('all.roles.permission');
    Route::get('/admin/edit/roles/{id}','AdminEditRoles')->name('admin.edit.roles');
    Route::post('/admin/roles/update/{id}','AdminUpdateRoles')->name('admin.roles.update');
    Route::get('/admin/delete/roles/{id}','AdminDeleteRoles')->name('admin.delete.roles');

});


// Admin User All Route
Route::controller(AdminController::class)->group(function(){
    Route::get('/all/admin','AllAdmin')->name('all.admin');
    Route::get('/add/admin','AddAdmin')->name('add.admin');
    Route::get('/add/instructor','AddInstructor')->name('add.instructor');
    Route::get('/add/user','AddUser')->name('add.user');
    Route::post('/store/admin','StoreAdmin')->name('store.admin');
    Route::post('/store/instructor','StoreInstructor')->name('store.instructor');
    Route::post('/store/user','StoreUser')->name('store.user');
    Route::get('/edit/admin/{id}','EditAdmin')->name('edit.admin');
    Route::get('/edit/instructor/{id}','EditInstructor')->name('edit.instructor');
    Route::get('/edit/user/{id}','EditUser')->name('edit.user');
    Route::post('/update/admin/{id}','UpdateAdmin')->name('update.admin');
    Route::post('/update/instructor/{id}','UpdateInstructor')->name('update.instructor');
    Route::post('admin/reset/user/{id}','AdminResetUserPassword')->name('admin.reset.user.password');
    Route::get('admin/reset/user/{id}','AdminResetUser')->name('admin.reset.user');
    Route::post('/update/user/{id}','UpdateUser')->name('update.user');
    Route::get('/delete/admin/{id}','DeleteAdmin')->name('delete.admin');
});



}); // End Admin Group Middleware


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/become/instructor', [AdminController::class, 'BecomeInstructor'])->name('become.instructor');
Route::post('/instructor/register', [AdminController::class, 'InstructorRegister'])->name('instructor.register');


///// Instructor Group Middleware
Route::middleware(['auth','roles:instructor'])->group(function(){
Route::get('/instructor/dashboard', [InstructorController::class, 'InstructorDashboard'])->name('instructor.dashboard');
Route::get('/instructor/logout', [InstructorController::class, 'InstructorLogout'])->name('instructor.logout');

Route::get('/instructor/profile', [InstructorController::class, 'InstructorProfile'])->name('instructor.profile');
Route::post('/instructor/profile/store', [InstructorController::class, 'InstructorProfileStore'])->name('instructor.profile.store');

Route::get('/instructor/change/password', [InstructorController::class, 'InstructorChangePassword'])->name('instructor.change.password');
Route::post('/instructor/password/update', [InstructorController::class, 'InstructorPasswordUpdate'])->name('instructor.password.update');

// Category All Route
    Route::controller(InstructorCategoryController::class)->group(function(){
//    Route::get('/all/category','AllCategory')->name('all.category')->middleware('permission:category.all');;
        Route::get('instructor/all/category','AllCategory')->name('instructor.all.category');
        Route::get('instructor/add/category','AddCategory')->name('instructor.add.category');
        Route::post('instructor/store/category','StoreCategory')->name('instructor.store.category');
        Route::get('instructor/edit/category/{id}','EditCategory')->name('instructor.edit.category');
        Route::post('instructor/update/category','UpdateCategory')->name('instructor.update.category');
        Route::get('instructor/delete/category/{id}','DeleteCategory')->name('instructor.delete.category');
    });

    // SubCategory All Route
    Route::controller(InstructorCategoryController::class)->group(function(){
//    Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory')->middleware('permission:subcategory.all');
        Route::get('instructor/all/subcategory','AllSubCategory')->name('instructor.all.subcategory');
        Route::get('instructor/add/subcategory','AddSubCategory')->name('instructor.add.subcategory');
        Route::post('instructor/store/subcategory','StoreSubCategory')->name('instructor.store.subcategory');
        Route::get('instructor/edit/subcategory/{id}','EditSubCategory')->name('instructor.edit.subcategory');
        Route::post('instructor/update/subcategory','UpdateSubCategory')->name('instructor.update.subcategory');
        Route::get('instructor/delete/subcategory/{id}','DeleteSubCategory')->name('instructor.delete.subcategory');

    });

// Instructor All Route
Route::controller(CourseController::class)->group(function(){
    Route::get('/all/course','AllCourse')->name('all.course');
    Route::get('/add/course','AddCourse')->name('add.course');

    Route::get('/subcategory/ajax/{category_id}','GetSubCategory');

    Route::post('/store/course','StoreCourse')->name('store.course');
    Route::get('/edit/course/{id}','EditCourse')->name('edit.course');
    Route::post('/update/course','UpdateCourse')->name('update.course');
    Route::post('/update/course/image','UpdateCourseImage')->name('update.course.image');
    Route::post('/update/course/video','UpdateCourseVideo')->name('update.course.video');
    Route::post('/update/course/goal','UpdateCourseGoal')->name('update.course.goal');
    Route::get('/delete/course/{id}','DeleteCourse')->name('delete.course');
    Route::post('/update/course/status','UpdateCourseStatus')->name('update.course.status');
});


// Task All Task Route
    Route::controller(TaskController::class)->group(function(){
        Route::get('/all/task','MyTask')->name('all.task');
        Route::get('/add/task','AddTask')->name('add.task');

        Route::post('/store/task','StoreTask')->name('store.task');
        Route::get('/edit/task/{id}','EditTask')->name('edit.task');
        Route::post('/update/task','UpdateTask')->name('update.task');
        Route::get('/delete/task/{id}','DeleteTask')->name('delete.task');
        Route::get('/report/generate','ReportGenerate')->name('report.generate');

    });
// File All Task Route

    Route::controller(FileController::class)->group(function(){
        Route::get('/all/file','AllFile')->name('all.file');
        Route::get('/add/file','AddFile')->name('add.file');

        Route::post('/store/file','StoreFile')->name('store.file');
        Route::get('/delete/file/{id}','DeleteFile')->name('delete.file');
    });


// Course Section and Lecture All Route
Route::controller(CourseController::class)->group(function(){
    Route::get('/add/course/lecture/{id}','AddCourseLecture')->name('add.course.lecture');
    Route::get('/course/all/lecture/{id}','AllCourseLecture')->name('course.all.lecture');
    Route::post('/add/course/section/','AddCourseSection')->name('add.course.section');
    Route::post('/update/course/section/','UpdateCourseSection')->name('update.course.section');
    Route::post('/update/course/lecture/document','UpdateLectureDocument')->name('update.course.lecture.document');
    Route::post('/update/course/lecture/video','UpdateLectureVideo')->name('update.course.lecture.video');
    Route::get('/add/section/{id}','AddCourseSectionGet')->name('add.section');
    Route::get('/edit/section/{id}','EditCourseSectionGet')->name('edit.section');

    Route::post('/save-lecture/','SaveLecture')->name('save-lecture');

    Route::get('/edit/lecture/{id}','EditLecture')->name('edit.lecture');
    Route::post('/update/course/lecture','UpdateCourseLecture')->name('update.course.lecture.content');
    Route::get('/delete/lecture/{id}','DeleteLecture')->name('delete.lecture');
    Route::get('/delete/section/{id}','DeleteSection')->name('delete.section');
});



// Admin All Order Route
Route::controller(OrderController::class)->group(function(){
    Route::get('/instructor/all/order','InstructorAllOrder')->name('instructor.all.order');
    Route::get('/instructor/order/details/{payment_id}','InstructorOrderDetails')->name('instructor.order.details');
    Route::get('/instructor/order/invoice/{payment_id}','InstructorOrderInvoice')->name('instructor.order.invoice');
    Route::get('/instructor/order/add','InstructorOrderAddGet')->name('instructor.order.add');
    Route::post('/instructor/order/update','UpdateOrder')->name('instructor.order.update');
});


// Question All Order Route
Route::controller(QuestionController::class)->group(function(){
    Route::get('/instructor/all/question','InstructorAllQuestion')->name('instructor.all.question');
    Route::get('/question/details/{id}','QuestionDetails')->name('question.details');
    Route::post('/instructor/replay','InstructorReplay')->name('instructor.replay');


});

// Instructor Coupon All Route
Route::controller(CouponController::class)->group(function(){
    Route::get('/instructor/all/coupon','InstructorAllCoupon')->name('instructor.all.coupon');
    Route::get('/instructor/add/coupon','InstructorAddCoupon')->name('instructor.add.coupon');
    Route::post('/instructor/store/coupon','InstructorStoreCoupon')->name('instructor.store.coupon');
    Route::get('/instructor/edit/coupon/{id}','InstructorEditCoupon')->name('instructor.edit.coupon');
    Route::post('/instructor/update/coupon','InstructorUpdateCoupon')->name('instructor.update.coupon');
    Route::get('/instructor/delete/coupon/{id}','InstructorDeleteCoupon')->name('instructor.delete.coupon');

});


// Instructor Review All Route
Route::controller(ReviewController::class)->group(function(){
    Route::get('/instructor/all/review','InstructorAllReview')->name('instructor.all.review');

});



}); // End Instructor Group Middleware


///// Route Accessable for All
Route::get('/instructor/login', [InstructorController::class, 'InstructorLogin'])->name('instructor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/course/details/{id}/{slug}', [IndexController::class, 'CourseDetails']);
Route::get('/course/all', [IndexController::class, 'AllCourses']);

Route::get('/category/{id}/{slug}', [IndexController::class, 'CategoryCourse']);
Route::get('/subcategory/{id}/{slug}', [IndexController::class, 'SubCategoryCourse']);
Route::get('/instructor/details/{id}', [IndexController::class, 'InstructorDetails'])->name('instructor.details');

Route::post('/add-to-wishlist/{course_id}', [WishListController::class, 'AddToWishList']);

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::post('/buy/data/store/{id}', [CartController::class, 'AddToCart']);

Route::get('/cart/data/', [CartController::class, 'CartData']);

// Get Data from Minicart
Route::get('/course/mini/cart/', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/course/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);


// Cart All Route
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-course','GetCartCourse');
    Route::get('/cart-remove/{rowId}','CartRemove');

});


Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::post('/inscoupon-apply', [CartController::class, 'InsCouponApply']);


Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

/// Checkout Page Route
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::post('/payment', [CartController::class, 'Payment'])->name('payment');
Route::post('/stripe_order', [CartController::class, 'StripeOrder'])->name('stripe_order');


Route::post('/store/review', [ReviewController::class, 'StoreReview'])->name('store.review');

Route::get('/blog/details/{slug}', [BlogController::class, 'BlogDetails']);
Route::get('/blog/cat/list/{id}', [BlogController::class, 'BlogCatList']);
Route::get('/blog', [BlogController::class, 'BlogList'])->name('blog');

Route::post('/mark-notification-as-read/{notification}', [CartController::class, 'MarkAsRead']);

///// End Route Accessable for All
// Instructor All Route
Route::controller(InstructorController::class)->group(function(){
    Route::get('instructor/all/user','InstructorAllUser')->name('instructor.all.user');
    Route::get('instructor/add/user','InstructorAddUser')->name('instructor.add.user');
    Route::get('instructor/user/course/list/{id}','InstructorUserCourseList')->name('instructor.user.course');
    Route::post('instructor/store/user','InstructorStoreUser')->name('instructor.store.user');
    Route::get('instructor/edit/user/{id}','InstructorEditUser')->name('instructor.edit.user');
    Route::post('instructor/update/user/{id}','InstructorUpdateUser')->name('instructor.update.user');
    Route::get('instructor/delete/user/{id}','InstructorDeleteUser')->name('instructor.delete.user');
    Route::post('instructor/reset/user/{id}','InstructorResetUserPassword')->name('instructor.reset.user.password');
    Route::get('instructor/reset/user/{id}','InstructorResetUser')->name('instructor.reset.user');
    Route::get('/instructor/course/details/{id}','InstructorCourseDetails')->name('instructor.course.details');
    Route::get('/instructor/course/addstudent/{id}','InstructorCourseAddStudent')->name('instructor.course.addstudent');
    Route::get('instructor/import/user','ImportUser')->name('instructor.import.user');
    Route::get('instructor/export','Export')->name('instructor.export');
    Route::post('instructor/import','Import')->name('instructor.import');
});

// Blog Category All Route
Route::controller(BlogController::class)->group(function(){
    Route::get('/blog/category','AllBlogCategory')->name('blog.category');
    Route::post('/blog/category/store','StoreBlogCategory')->name('blog.category.store');
    Route::get('/edit/blog/category/{id}','EditBlogCategory');
    Route::post('/blog/category/update','UpdateBlogCategory')->name('blog.category.update');
    Route::get('/delete/blog/category/{id}','DeleteBlogCategory')->name('delete.blog.category');

});

Route::controller(InstructorBlogController::class)->group(function(){
    Route::get('instructor/blog/category','InstructorAllBlogCategory')->name('instructor.blog.category');
    Route::post('instructor/blog/category/store','InstructorStoreBlogCategory')->name('instructor.blog.category.store');
    Route::get('instructor/edit/blog/category/{id}','InstructorEditBlogCategory');
    Route::post('instructor/blog/category/update','InstructorUpdateBlogCategory')->name('instructor.blog.category.update');
    Route::get('instructor/delete/blog/category/{id}','InstructorDeleteBlogCategory')->name('instructor.delete.blog.category');
});

// Blog Post All Route
Route::controller(InstructorBlogController::class)->group(function(){
    Route::get('instructor/blog/post','InstructorBlogPost')->name('instructor.blog.post');
    Route::get('instructor/add/blog/post','InstructorAddBlogPost')->name('instructor.add.blog.post');
    Route::post('instructor/store/blog/post','InstructorStoreBlogPost')->name('instructor.store.blog.post');
    Route::get('instructor/edit/post/{id}','InstructorEditBlogPost')->name('instructor.edit.post');
    Route::post('instructor/update/blog/post','InstructorUpdateBlogPost')->name('instructor.update.blog.post');
    Route::get('instructor/delete/post/{id}','InstructorDeleteBlogPost')->name('instructor.delete.post');
});

// Blog Post All Route
Route::controller(BlogController::class)->group(function(){
    Route::get('/blog/post','BlogPost')->name('blog.post');
    Route::get('/add/blog/post','AddBlogPost')->name('add.blog.post');
    Route::post('/store/blog/post','StoreBlogPost')->name('store.blog.post');
    Route::get('/edit/post/{id}','EditBlogPost')->name('edit.post');
    Route::post('/update/blog/post','UpdateBlogPost')->name('update.blog.post');
    Route::get('/delete/post/{id}','DeleteBlogPost')->name('delete.post');
});
