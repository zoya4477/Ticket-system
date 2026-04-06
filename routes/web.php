<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InternalNoteController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\KnowledgeBaseController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Welcome Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Public Landing Page
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('home'); 
// })->name('home');
// Homepage
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Search Routes
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search/ajax', [HomeController::class, 'ajaxSearch'])->name('search.ajax');


/*
|--------------------------------------------------------------------------
| Knowledge Base Routes 
|--------------------------------------------------------------------------
*/
Route::prefix('knowledge-base')->group(function() {

    Route::get('/', [KnowledgeBaseController::class, 'index'])->name('kb.index');
    Route::get('/article/{id}', [KnowledgeBaseController::class, 'showArticle'])->name('kb.article');
    Route::get('/faq', [KnowledgeBaseController::class, 'faq'])->name('kb.faq');
    Route::get('/search', [KnowledgeBaseController::class, 'search'])->name('kb.search');
    Route::get('/category/{id}', [KnowledgeBaseController::class, 'category'])->name('kb.category');
    Route::get('/kb/create', [AdminArticleController::class, 'create'])->name('kb.create');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Redirect to dashboard based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role_id == 1) return redirect()->route('admin.dashboard');
        if ($user->role_id == 2) return redirect()->route('agent.dashboard');
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tickets
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/comment', [TicketController::class, 'addComment'])->name('tickets.comment');
    Route::post('tickets/{ticket}/attachment', [TicketController::class, 'uploadAttachment'])->name('tickets.uploadAttachment');
    Route::post('tickets/{ticket}/assign', [TicketController::class, 'assign'])
        ->name('tickets.assign')
        ->middleware('role:Admin');
        // ✅ Add this route for escalation
    Route::post('tickets/{ticket}/escalate', [TicketController::class, 'escalate'])
       ->name('tickets.escalate')->middleware('role:Agent,Admin'); // Only agents/admins can escalate
  
    
       // ✅ Resolve ticket (agent only)
    Route::post('tickets/{ticket}/resolve', [TicketController::class, 'resolve'])
       ->name('tickets.resolve')
       ->middleware('role:Agent');
       
    Route::post('/tickets/{ticket}/attachment', [TicketController::class, 'uploadAttachment'])
    ->name('tickets.uploadAttachment');

    Route::post('/agent/tickets/{ticket}/resolve', [AgentDashboardController::class, 'resolve'])->name('tickets.resolve');
// Delete comment
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/tickets/{ticket}/confirm', [TicketController::class, 'confirmTicket'])->name('tickets.confirm');
    // Categories
    Route::resource('categories', CategoryController::class);

    // Internal Notes
    Route::post('/internal-notes', [InternalNoteController::class, 'store'])
        ->name('internal-notes.store')
        ->middleware('role:Admin,Agent');

    /*
|--------------------------------------------------------------------------
| Notification System Routes
|--------------------------------------------------------------------------
*/

    // 1. Mark all notifications as read
    Route::get('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'All notifications marked as read.');
    })->name('notifications.markAllRead');

    // 2. Single Notification Read & Redirect
    Route::get('/notifications/{id}/read', function ($id) {
        // Sirf wahi notification dhoonde jo is user ki ho
        $notification = auth()->user()->notifications()->findOrFail($id);
        
        // Read mark karein
        $notification->markAsRead();

        // Safety Check: Agar link exist karta hai toh wahan bhejain, warna dashboard par
        $targetUrl = $notification->data['link'] ?? route('dashboard');
        
        return redirect($targetUrl);
    })->name('notifications.read');


});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Users, Agents, Departments
        Route::resource('users', UserController::class);
        Route::resource('agents', AgentController::class);
        Route::resource('departments', DepartmentController::class);

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/export-csv', [ReportController::class, 'exportCSV'])->name('reports.exportCSV');
        Route::get('/export-pdf', [ReportController::class, 'exportPDF'])->name('reports.exportPDF');

        // Articles (resource route)
        Route::resource('articles', AdminArticleController::class)
            ->names([
                'index' => 'articles.index',
                'create' => 'articles.create',
                'store' => 'articles.store',
                'show' => 'articles.show',
                'edit' => 'articles.edit',
                'update' => 'articles.update',
                'destroy' => 'articles.destroy'
            ]);
        

        // Assign Tickets
        Route::get('/assign-tickets', [AdminTicketController::class,'index'])->name('tickets.assign');
        Route::post('/assign-tickets', [AdminTicketController::class,'assignTicket'])->name('tickets.assign.store');
});

/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:Agent'])->group(function() {
    Route::get('/agent/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');
});


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:Customer'])->group(function(){
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';