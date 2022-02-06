<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PageController,
    CartController,
    DashboardController,
    ProductController,
    CategoryController,
    ImageController,
    SliderController,
    OrderController,
    SquareController,
    PostController,
    MessageController,
    ServiceController,
    InformationController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Page
Route::get('/services', [PageController::class,'services'])->name('services');
Route::get('/', [PageController::class,'index'])->name('index');
Route::get('/detalle/{product:slug}', [PageController::class,'showdetail'])->name('product-detail');
Route::get('/catalogo/{category:slug}', [PageController::class,'catalog'])->name('catalog');
Route::get('/catalogo', [PageController::class,'allCatalog'])->name('allCatalog');
Route::get('/nosotros', [PageController::class,'about'])->name('about');
Route::get('/contacto', [PageController::class,'contact'])->name('contact');
Route::get('/blog', [PageController::class,'blog'])->name('blog');
Route::get('/blog/{post:slug}', [PageController::class,'blogSingle'])->name('blog-single');

// Route::get('/mi-carrito', [CartController::class,'index'])->name('myCart');

// Route::get('/deposito', [PageController::class,'deposit']);
// Route::get('/transferencia', [PageController::class,'transfer']);
Route::get('/mi-carrito', [PageController::class,'myCart'])->name('my-cart');
Route::get('/destinations', [PageController::class,'destinations']);
// Route::post('/process_payment', [PaymentController::class,'payment'])->name('payment');

//Cart
Route::get('/cart', [CartController::class,'index']);
Route::post('/cart', [CartController::class,'store']);
Route::delete('/cart', [CartController::class,'delete']);
Route::delete('/cart/destroy', [CartController::class,'destroy']);
Route::post('/send-email', [CartController::class,'sendEmail'])->name('sendEmail');

//Pago
Route::post('/payment', [OrderController::class,'payment'])->name('orders.payment');
Route::post('/deposit', [OrderController::class,'deposit'])->name('orders.deposit');
Route::get('/pedido-aceptado', [OrderController::class,'successfulOrder'])->name('successful-order');
Route::get('/pago-en-proceso', [OrderController::class,'inProcessOrder'])->name('in-process-order');
Route::get('/pedido-rechazado', [OrderController::class,'failedOrder'])->name('failed-order');

Route::group(['middleware'=>'auth','prefix'=>'admin'], function () {
//Administración
    //Dashboard
    Route::get('/', function(){
        return redirect(route('products.index'));
    });
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard.index');
    Route::get('/get-income', [DashboardController::class,'getIncome'])->name('dashboard.getIncome');
    Route::get('/get-expenses', [DashboardController::class,'getExpenses'])->name('dashboard.getExpenses');
    //Productos
    Route::get('/productos', [ProductController::class,'index'])->name('products.index');
    Route::get('/productos/table', [ProductController::class,'table'])->name('products.table');
    Route::get('/productos/{product}', [ProductController::class,'show'])
        ->where('product', '[0-9]+')
        ->name('products.show');
    Route::get('/productos/nuevo', [ProductController::class,'create'])->name('products.create');
    Route::get('/get-productos', [ProductController::class,'getProducts'])->name('products.get');
    Route::post('/productos', [ProductController::class,'store'])->name('products.store');
    Route::get('/productos/{product}/editar', [ProductController::class,'edit'])->name('products.edit');
    Route::put('/productos/{product}', [ProductController::class,'update'])->name('products.update');
    Route::get('/productos/papelera', [ProductController::class,'trashed'])->name('products.trashed');
    Route::get('/productosTrashed/table', [ProductController::class,'trashedTable'])->name('products.trashedTable');
    Route::patch('/productos/{product}/papelera', [ProductController::class,'trash'])->name('products.trash');
    Route::get('/productos/restore/{product}', [ProductController::class,'restore'])->name('products.restore');
    Route::delete('/productos/{product}', [ProductController::class,'destroy'])->name('products.destroy');

    //Categorías
    Route::get('/categorias', [CategoryController::class,'index'])->name('categories.index');
    Route::get('/categorias/nuevo', [CategoryController::class,'create'])->name('categories.create');
    Route::post('/categorias', [CategoryController::class,'store'])->name('categories.store');
    Route::get('/categorias/{category}/editar', [CategoryController::class,'edit'])->name('categories.edit');
    Route::put('/categorias/{category}', [CategoryController::class,'update'])->name('categories.update');
    Route::delete('/categorias/{category}', [CategoryController::class,'destroy'])->name('categories.destroy');

    //Servicios
    Route::get('/servicios', [ServiceController::class,'index'])->name('services.index');
    Route::get('/servicios/nuevo', [ServiceController::class,'create'])->name('services.create');
    Route::post('/servicios', [ServiceController::class,'store'])->name('services.store');
    Route::get('/servicios/{service}/editar', [ServiceController::class,'edit'])->name('services.edit');
    Route::put('/servicios/{service}', [ServiceController::class,'update'])->name('services.update');
    Route::delete('/servicios/{service}', [ServiceController::class,'destroy'])->name('services.destroy');

    //Orders
    Route::get('/pedidos', [OrderController::class,'index'])->name('orders.index');
    Route::get('/pedidos/table', [OrderController::class,'table'])->name('orders.table');
    Route::get('/pedidos/{order}', [OrderController::class,'show'])
        ->where('order', '[0-9]+')
        ->name('orders.show');
    // Route::put('/pedidos/{order}', [OrderController::class,'update'])->name('orders.update');
    Route::put('/pedidos/change-state/{order}', [OrderController::class,'changeState'])->name('orders.change-state');
    Route::put('/pedidos/rechazar/{order}', [OrderController::class,'reject'])->name('orders.reject');
    Route::delete('/pedidos/{order}', [OrderController::class,'destroy'])->name('orders.destroy');

    //Square
    Route::get('/cuadre-stock', [SquareController::class,'index'])->name('squares.index');
    Route::get('/cuadre-stock/table', [SquareController::class,'table'])->name('squares.table');
    Route::get('/square-report', [SquareController::class,'report'])->name('squares.report');
    Route::get('/cuadre-stock/nuevo', [SquareController::class,'create'])->name('squares.create');
    Route::get('/cuadre-stock/{square}', [SquareController::class,'show'])
        ->where('square', '[0-9]+')
        ->name('squares.show');
    Route::post('/cuadre-stock', [SquareController::class,'store'])->name('squares.store');
    Route::get('/cuadre-stock/{square}/editar', [SquareController::class,'edit'])->name('squares.edit');
    Route::put('/cuadre-stock/{square}', [SquareController::class,'update'])->name('squares.update');
    Route::delete('/cuadre-stock/{square}', [SquareController::class,'destroy'])->name('squares.destroy');
    Route::get('/template-table', [SquareController::class,'templateTable']);

    //Images
    Route::get('/images/{product}', [ImageController::class,'create'])->name('images.create');
    Route::post('/images/{product}', [ImageController::class,'store'])->name('images.store');
    Route::delete('/images', [ImageController::class,'delete'])->name('images.delete');

    //Posts
    Route::get('/posts', [PostController::class,'index'])->name('posts.index');
    Route::get('/posts/crear', [PostController::class,'create'])->name('posts.create');
    Route::post('/posts', [PostController::class,'store'])->name('posts.store');
    Route::get('/posts/editar/{post}', [PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class,'destroy'])->name('posts.destroy');

    //AdditionalFeatures

    Route::get('/sliders', [SliderController::class,'index'])->name('sliders.index');
    Route::get('/sliders/crear', [SliderController::class,'create'])->name('sliders.create');
    Route::post('/sliders', [SliderController::class,'store'])->name('sliders.store');
    Route::get('/sliders/editar/{slider}', [SliderController::class,'edit'])->name('sliders.edit');
    Route::PUT('/sliders/{slider}', [SliderController::class,'update'])->name('sliders.update');
    Route::delete('/sliders/{slider}', [SliderController::class,'destroy'])->name('sliders.destroy');

    Route::get('/novedades', [ProductController::class,'novelties'])->name('novelties');
    Route::get('/galeria', function(){
        return view('admin.additional.galery');
    })->name('galery');

    //Mensajes
    Route::get('/mensajes', [MessageController::class,'index'])->name('messages.index');
    Route::get('/mensajes/table', [MessageController::class,'table'])->name('messages.table');
    Route::get('/citas', [MessageController::class,'appointmentsIndex'])->name('appointments.index');
    Route::get('/citas/table', [MessageController::class,'appointmentsTable'])->name('appointments.table');

    Route::get('/nosotros', [InformationController::class,'index'])->name('about.index');
    Route::PUT('/nosotros/{information}', [InformationController::class,'update'])->name('about.update');
});

Auth::routes(['register'=>'false']);

Route::get('/home', function(){
    return redirect(route('products.index'));
})->name('home');
