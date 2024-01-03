<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard-monthly', [App\Http\Controllers\HomeController::class, 'Monthly'])->name('monthly');
Route::get('/dashboard-stock-card', [App\Http\Controllers\HomeController::class, 'StockCard'])->name('stockcard');

//Admin
//Route::get('/admin_dashboard', [App\Http\Controllers\admin\AdminDashboard::class, 'index'])->middleware('role:admin');
//Route::get('/dashboard-production', [App\Http\Controllers\admin\AdminDashboard::class, 'DashboardProduction'])->name('DashboardProduction');
Route::get('/admin_dashboard', [App\Http\Controllers\admin\AdminDashboard::class, 'DashboardProduction'])->middleware('role:admin')->name('MyleaDashboardProduction');
Route::post('/dashboard-production-target-submit', [App\Http\Controllers\admin\AdminDashboard::class, 'DashboardProductionTargetChanged'])->name('DashboardProduction');
Route::get('/admin/baglog', [App\Http\Controllers\admin\AdminDashboard::class, 'baglog'])->middleware('role:admin');
Route::get('/admin/mylea', [App\Http\Controllers\admin\MyleaController::class, 'Dashboard'])->middleware('role:admin');

//Baglog
Route::get('/admin/baglog/data-recipe', [App\Http\Controllers\admin\BaglogController::class, 'DataRecipe'])->middleware('role:admin');
Route::get('/admin/baglog/data-recipe/approve/{id}', [App\Http\Controllers\admin\BaglogController::class, 'ApproveResep'])->middleware('role:admin');
Route::get('/admin/baglog/report', [App\Http\Controllers\admin\BaglogController::class, 'Report'])->middleware('role:admin');
Route::get('/admin/baglog/report-details/{KodeProduksi}', [App\Http\Controllers\admin\BaglogController::class, 'ReportDetails'])->middleware('role:admin')->name('BaglogDetails');
Route::post('/admin/baglog/report-details-submit', [App\Http\Controllers\admin\BaglogController::class, 'ReportDetailsSubmit'])->middleware('role:admin');
Route::get('/admin/baglog/inkubasi-baglog', [App\Http\Controllers\admin\BaglogController::class, 'InkubasiBaglog'])->middleware('role:admin');
Route::get('/admin/baglog/inkubasi-baglog/konta/{id}', [App\Http\Controllers\admin\BaglogController::class, 'InkubasiBaglogKonta'])->middleware('role:admin');
Route::post('/admin/baglog/inkubasi-baglog/konta-submit', [App\Http\Controllers\admin\BaglogController::class, 'InkubasiBaglogKontaSubmit'])->middleware('role:admin');
Route::get('/admin/baglog/inkubasi-baglog/crushing/{id}', [App\Http\Controllers\admin\BaglogController::class, 'InkubasiBaglogCrushing'])->middleware('role:admin');
Route::get('/admin/baglog/inkubasi-baglog/undo-crushing/{id}', [App\Http\Controllers\admin\BaglogController::class, 'InkubasiBaglogCrushingUndo'])->middleware('role:admin');
Route::get('/admin/baglog/inkubasi-baglog/panen/{id}', [App\Http\Controllers\admin\BaglogController::class, 'InkubasiBaglogPanen'])->middleware('role:admin');
Route::get('/admin/baglog/report-delete/{id}', [App\Http\Controllers\admin\BaglogController::class, 'DeletePembibitan'])->middleware('role:admin')->name('DeletePembibitan');
Route::get('/admin/baglog/report/{KodeProduksi}', [App\Http\Controllers\admin\BaglogController::class, 'konta'])->middleware('role:admin')->name('BaglogKonta');
Route::post('/admin/baglog/report/konta-update', [App\Http\Controllers\admin\BaglogController::class, 'UpdateKonta'])->middleware('role:admin')->name('UpdateKonta');
Route::get('/admin/baglog/kontaminasi-delete/{id}', [App\Http\Controllers\admin\BaglogController::class, 'deletekonta'])->middleware('role:admin')->name('DeleteKontaBaglog');
Route::get('/admin/baglog/report-pengayakan', [App\Http\Controllers\admin\BaglogController::class, 'Pengayakan'])->middleware('role:admin');
Route::get('/admin/baglog/pengayakan-delete/{id}', [App\Http\Controllers\admin\BaglogController::class, 'DeletePengayakan'])->middleware('role:admin')->name('DeletePengayakan');
Route::get('/admin/baglog/report-mixing', [App\Http\Controllers\admin\BaglogController::class, 'Mixing'])->middleware('role:admin');
Route::get('/admin/baglog/mixing-delete/{id}', [App\Http\Controllers\admin\BaglogController::class, 'DeleteMixing'])->middleware('role:admin')->name('DeleteMixing');
Route::post('/admin/baglog/mixing-update', [App\Http\Controllers\admin\BaglogController::class, 'UpdateMixing'])->middleware('role:admin')->name('UpdateMixing');
Route::get('/admin/baglog/report-sterilisasi', [App\Http\Controllers\admin\BaglogController::class, 'Sterilisasi'])->middleware('role:admin');
Route::get('/admin/baglog/sterilisasi-delete/{id}', [App\Http\Controllers\admin\BaglogController::class, 'DeleteSterilisasi'])->middleware('role:admin')->name('DeleteSterilisasi');
Route::post('/admin/baglog/sterilisasi-update', [App\Http\Controllers\admin\BaglogController::class, 'UpdateSterilisasi'])->middleware('role:admin')->name('UpdateSterilisasi');
Route::post('/admin/baglog/report/crushing-update', [App\Http\Controllers\admin\BaglogController::class, 'UpdateCrushing'])->middleware('role:admin')->name('UpdateKonta');


//Mylea
Route::get('/admin/mylea/report', [App\Http\Controllers\admin\MyleaController::class, 'Report'])->middleware('role:admin');
Route::get('/admin/mylea/harvest-schedule', [App\Http\Controllers\admin\MyleaController::class, 'HarvestSchedule'])->middleware('role:admin');
Route::post('/admin/mylea/produksi-edit', [App\Http\Controllers\admin\MyleaController::class, 'ProduksiEdit'])->middleware('role:admin');
Route::get('/admin/mylea/report/data-produksi-delete/{id}/{KPMylea}', [App\Http\Controllers\admin\MyleaController::class, 'ProduksiDelete'])->middleware('role:admin');
Route::get('/admin/mylea/report/form-kontaminasi/{KodeProduksi}', [App\Http\Controllers\admin\MyleaController::class, 'FormKontaminasi'])->middleware('role:admin');
Route::post('/admin/mylea/report/kontaminasi-submit', [App\Http\Controllers\admin\MyleaController::class, 'KontaminasiSubmit'])->middleware('role:admin');
Route::get('/admin/mylea/report/kontaminasi-delete/{id}', [App\Http\Controllers\admin\MyleaController::class, 'DeleteKontaminasi'])->middleware('role:admin');
Route::post('/admin/mylea/report/panen-update', [App\Http\Controllers\admin\MyleaController::class, 'UpdatePanen'])->middleware('role:admin');
Route::get('/admin/mylea/report/panen-delete/{id}', [App\Http\Controllers\admin\MyleaController::class, 'DeletePanen'])->middleware('role:admin');
Route::get('/admin/mylea/report/elus-delete/{id}', [App\Http\Controllers\admin\MyleaController::class, 'DeleteElus'])->middleware('role:admin');
Route::get('/admin/mylea/report/baglog-delete/{id}', [App\Http\Controllers\admin\MyleaController::class, 'DeleteBaglog'])->middleware('role:admin');
Route::get('/admin/mylea/report/form-elus/{KodeProduksi}', [App\Http\Controllers\admin\MyleaController::class, 'FormElus'])->middleware('role:admin');
Route::post('/admin/mylea/report/elus-submit', [App\Http\Controllers\admin\MyleaController::class, 'ElusSubmit'])->middleware('role:admin');
Route::post('/admin/mylea/report/baglog-submit', [App\Http\Controllers\admin\MyleaController::class, 'BaglogSubmit'])->middleware('role:admin');

//Post Treatment
Route::get('/admin/post-treatment-index', [App\Http\Controllers\admin\PostTreatmentController::class, 'Index'])->middleware('auth');
Route::get('/admin/post-treatment', [App\Http\Controllers\admin\PostTreatmentController::class, 'Monitoring'])->middleware('auth');
Route::get('/admin/post-treatment/data-panen', [App\Http\Controllers\admin\PostTreatmentController::class, 'MyleaPanen'])->middleware('auth');
Route::post('/admin/post-treatment/data-panen/submit-kerik', [App\Http\Controllers\admin\PostTreatmentController::class, 'KerikSubmit'])->middleware('auth');
Route::post('/admin/post-treatment/data-panen/update-kerik', [App\Http\Controllers\admin\PostTreatmentController::class, 'KerikUpdate'])->middleware('auth');
Route::get('/admin/post-treatment/data-panen/delete-kerik/{ID}', [App\Http\Controllers\admin\PostTreatmentController::class, 'KerikDelete'])->middleware('auth');
Route::get('/admin/post-treatment/report', [App\Http\Controllers\admin\PostTreatmentController::class, 'Report'])->middleware('auth');
Route::get('/admin/post-treatment/delete-all/{PanenID}', [App\Http\Controllers\admin\PostTreatmentController::class, 'DeleteAll'])->middleware('auth');
Route::get('/admin/post-treatment/delete/{ID}', [App\Http\Controllers\admin\PostTreatmentController::class, 'DeleteAll'])->middleware('auth');
Route::post('/admin/post-treatment/data-panen/submit-rebus', [App\Http\Controllers\admin\PostTreatmentController::class, 'RebusSubmit'])->middleware('auth');
Route::post('/admin/post-treatment/data-panen/update-rebus', [App\Http\Controllers\admin\PostTreatmentController::class, 'RebusUpdate'])->middleware('auth');
Route::get('/admin/post-treatment/data-panen/delete-rebus/{ID}', [App\Http\Controllers\admin\PostTreatmentController::class, 'RebusDelete'])->middleware('auth');
Route::post('/admin/post-treatment-details/update-jumlah-mylea', [App\Http\Controllers\admin\PostTreatmentController::class, 'UpdateJumlahMyleaDetails'])->middleware('auth');

// Recreate Post Treatment
Route::get('/post-treatment/mylea-harvest', [App\Http\Controllers\admin\PostTreatmentController::class, 'MyleaHarvest'])->middleware('auth');
Route::get('/post-treatment/I', [App\Http\Controllers\admin\PostTreatmentController::class, 'PostTreatmentI'])->middleware('auth');
Route::get('/post-treatment/II', [App\Http\Controllers\admin\PostTreatmentController::class, 'PostTreatmentII'])->middleware('auth');
Route::get('/post-treatment/III', [App\Http\Controllers\admin\PostTreatmentController::class, 'PostTreatmentIII'])->middleware('auth');

Route::get('/curing/', [App\Http\Controllers\admin\CuringController::class, 'CuringIndex'])->name('CuringIndex')->middleware('auth');
Route::post('/admin/curing/actual-finish-curing', [App\Http\Controllers\admin\CuringController::class,'UpdateActualFinishCuring'])->name('UpdateActualFinishCuring')->middleware('auth');
Route::post('/admin/curing/curing-size', [App\Http\Controllers\admin\CuringController::class,'UpdateCuringSize'])->name('UpdateCuringSize')->middleware('auth');


Route::get('/reinforce/', [App\Http\Controllers\admin\ReinforceController::class, 'ReinforceIndex'])->name('ReinforceIndex')->middleware('auth');
Route::post('/admin/reinforce/submit/', [App\Http\Controllers\admin\ReinforceController::class, 'ReinforceSubmit'])->name('ReinforceSubmit')->middleware('auth');
Route::post('/admin/reinforce/update/', [App\Http\Controllers\admin\ReinforceController::class, 'ReinforceUpdate'])->name('ReinforceUpdate')->middleware('auth');
Route::get('/admin/reinforce/delete/{id}', [App\Http\Controllers\admin\ReinforceController::class, 'ReinforceDelete'])->name('ReinforceDelete')->middleware('auth');



//Operator
Route::get('/operator_dashboard', [App\Http\Controllers\operator\OperatorDashboard::class, 'index'])->middleware('auth');
Route::get('/operator/baglog', [App\Http\Controllers\operator\OperatorDashboard::class, 'baglog'])->middleware('auth');
Route::get('/operator/mylea', [App\Http\Controllers\operator\OperatorDashboard::class, 'mylea'])->middleware('auth');
Route::get('/operator/post-treatment', [App\Http\Controllers\operator\OperatorDashboard::class, 'PostTreatment'])->middleware('auth');

Route::get('/operator/post-treatment/data-panen', [App\Http\Controllers\operator\PostTreatmentController::class, 'MyleaPanen'])->middleware('auth');


//Baglog
Route::get('/operator/baglog/pengayakan', [App\Http\Controllers\operator\BaglogController::class, 'Pengayakan'])->middleware('auth');
Route::post('/operator/baglog/pengayakan-submit/{id}', [App\Http\Controllers\operator\BaglogController::class, 'PengayakanSubmit'])->middleware('auth');
Route::get('/operator/baglog/calcrecipe', [App\Http\Controllers\operator\BaglogController::class, 'CalcRecipe'])->middleware('auth');
Route::post('/operator/baglog/recipe-submit/{id}', [App\Http\Controllers\operator\BaglogController::class, 'CalcRecipeSubmit'])->middleware('auth');
Route::get('/operator/baglog/mixing', [App\Http\Controllers\operator\BaglogController::class, 'Mixing'])->middleware('auth');
Route::post('/operator/baglog/edit-resep', [App\Http\Controllers\operator\BaglogController::class, 'EditResep'])->middleware('auth');
Route::get('/operator/baglog/mixing-form/{resep_id}', [App\Http\Controllers\operator\BaglogController::class, 'MixingForm'])->middleware('auth');
Route::post('/operator/baglog/mixing-form-submit/{resep_id}', [App\Http\Controllers\operator\BaglogController::class, 'MixingFormSubmit'])->middleware('auth');
Route::get('/operator/baglog/sterilisasi-option', [App\Http\Controllers\operator\BaglogController::class, 'SterilisasiOption'])->middleware('auth');
Route::get('/operator/baglog/sterilisasi/{data}', [App\Http\Controllers\operator\BaglogController::class, 'Sterilisasi'])->name('FormSterilisasi')->middleware('auth');
Route::post('/operator/baglog/sterilisasi-submit', [App\Http\Controllers\operator\BaglogController::class, 'SterilisasiSubmit'])->middleware('auth');
Route::get('/operator/baglog/pembibitan', [App\Http\Controllers\operator\BaglogController::class, 'Pembibitan'])->middleware('auth');
Route::post('/operator/baglog/pembibitan-submit', [App\Http\Controllers\operator\BaglogController::class, 'PembibitanSubmit'])->middleware('auth');
Route::get('/operator/baglog/inkubasi-baglog', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiBaglog'])->middleware('auth');
Route::get('/operator/baglog/inkubasi-baglog/konta/{id}', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiBaglogKonta'])->middleware('auth');
Route::get('/operator/baglog/inkubasi-baglog/konta-data/{KodeProduksi}', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiKontaData'])->middleware('auth');
Route::post('/operator/baglog/inkubasi-baglog/konta-submit', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiBaglogKontaSubmit'])->middleware('auth');
Route::post('/operator/baglog/inkubasi-baglog/konta-update', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiKontaDataUpdate'])->middleware('auth');
Route::get('/operator/baglog/inkubasi-baglog/crushing/{id}', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiBaglogCrushing'])->middleware('auth');
Route::post('/operator/baglog/inkubasi-baglog/crushing-submit', [App\Http\Controllers\operator\BaglogController::class, 'BaglogCrushingSubmit'])->middleware('auth');
Route::get('/operator/baglog/inkubasi-baglog/undo-crushing/{id}', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiBaglogCrushingUndo'])->middleware('auth');
Route::get('/operator/baglog/inkubasi-baglog/panen/{id}', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiBaglogPanen'])->middleware('auth');
Route::get('/operator/baglog/inkubasi-baglog/archive/{id}', [App\Http\Controllers\operator\BaglogController::class, 'InkubasiBaglogArchive'])->middleware('auth');
Route::get('/operator/baglog/baglog-rnd', [App\Http\Controllers\operator\BaglogController::class, 'BaglogRnD'])->middleware('auth');
Route::post('/operator/baglog/baglog-rnd-submit', [App\Http\Controllers\operator\BaglogController::class, 'BaglogRnDSubmit'])->middleware('auth');
Route::post('/operator/baglog/baglog-rnd-update', [App\Http\Controllers\operator\BaglogController::class, 'BaglogRnDUpdate'])->middleware('auth');
Route::get('/operator/baglog/baglog-rnd-delete/{id}', [App\Http\Controllers\operator\BaglogController::class, 'BaglogRnDDelete'])->middleware('auth');

//Mylea
Route::get('/operator/mylea/form-produksi', [App\Http\Controllers\operator\MyleaController::class, 'FormProduksi'])->middleware('auth');
Route::post('/operator/mylea/form-produksi-submit', [App\Http\Controllers\operator\MyleaController::class, 'FormProduksiSubmit'])->middleware('auth');
Route::get('/operator/mylea/monitoring', [App\Http\Controllers\operator\MyleaController::class, 'Monitoring'])->middleware('auth');
Route::get('/operator/mylea/monitoring/form-kontaminasi/{KodeProduksi}', [App\Http\Controllers\operator\MyleaController::class, 'FormKontaminasi'])->middleware('auth');
Route::post('/operator/mylea/form-kontaminasi-submit', [App\Http\Controllers\operator\MyleaController::class, 'FormKontaminasiSubmit'])->middleware('auth');
Route::get('/operator/mylea/monitoring/data-kontaminasi/{KodeProduksi}', [App\Http\Controllers\operator\MyleaController::class, 'DataKontaminasi'])->middleware('auth');
Route::post('/operator/mylea/monitoring/konta-update', [App\Http\Controllers\operator\MyleaController::class, 'UpdateKontaminasi'])->middleware('auth');
Route::get('/operator/mylea/form-elus', [App\Http\Controllers\operator\MyleaController::class, 'FormElus'])->middleware('auth');
Route::post('/operator/mylea/form-elus-submit', [App\Http\Controllers\operator\MyleaController::class, 'FormElusSubmit'])->middleware('auth');
Route::get('/operator/mylea/monitoring/form-panen/{KodeProduksi}', [App\Http\Controllers\operator\MyleaController::class, 'FormPanen'])->middleware('auth');
Route::post('/operator/mylea/form-panen-submit', [App\Http\Controllers\operator\MyleaController::class, 'FormPanenSubmit'])->middleware('auth');

//Post Treatment
Route::post('/operator/post-treatment/form-post-treatment-submit', [App\Http\Controllers\operator\PostTreatmentController::class, 'FormPostTreatmentSubmit'])->middleware('auth');
Route::post('/operator/post-treatment/add-mylea', [App\Http\Controllers\operator\PostTreatmentController::class, 'AddMylea'])->middleware('auth');
Route::post('/operator/post-treatment/proses-post-treatment-submit', [App\Http\Controllers\operator\PostTreatmentController::class, 'ProsesPostTreatment'])->middleware('auth');
Route::get('/operator/post-treatment/monitoring', [App\Http\Controllers\operator\PostTreatmentController::class, 'Monitoring'])->middleware('auth');
Route::get('/operator/post-treatment/delete/{id}', [App\Http\Controllers\operator\PostTreatmentController::class, 'DeleteProses'])->middleware('auth');
Route::get('/operator/post-treatment/delete-mylea/{id}', [App\Http\Controllers\operator\PostTreatmentController::class, 'DeleteMylea'])->middleware('auth');
Route::get('/operator/post-treatment/archive/{id}', [App\Http\Controllers\operator\PostTreatmentController::class, 'Archive'])->middleware('auth');


// Environtment
Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/environment/', [App\Http\Controllers\admin\EnvirontmentController::class, 'index']);
    Route::get('/admin/environment/temperature/mylea', [App\Http\Controllers\admin\EnvirontmentController::class, 'TemperatureHumidityMylea'])->name('temperature-humidity.mylea');
    Route::get('/admin/environment/temperature/baglog', [App\Http\Controllers\admin\EnvirontmentController::class, 'TemperatureHumidityBaglog'])->name('temperature-humidity.baglog');
    Route::get('/admin/environment/temperature/working-station', [App\Http\Controllers\admin\EnvirontmentController::class, 'TemperatureHumidityWstation'])->name('temperature-humidity.working-station');
    Route::post('/admin/environment/temperature/import', [App\Http\Controllers\admin\EnvirontmentController::class, 'ImportTemperatureHumidity'])->name('temperature-humidity.import');
    Route::post('/admin/environment/temperature/mylea/import', [App\Http\Controllers\admin\EnvirontmentController::class, 'ImportTemperatureHumidityMylea'])->name('temperature-humidity-mylea.import');
    Route::post('/admin/environment/baglog/mylea/import', [App\Http\Controllers\admin\EnvirontmentController::class, 'ImportTemperatureHumidityBaglog'])->name('temperature-humidity-baglog.import');
    Route::post('/admin/environment/baglog/working-station/import', [App\Http\Controllers\admin\EnvirontmentController::class, 'ImportTemperatureHumidityWstation'])->name('temperature-humidity-wstation.import');
    Route::get('/admin/environment/co2', [App\Http\Controllers\admin\EnvirontmentController::class, 'CO2']);
});


// External Data
Route::get('/test-api', [App\Http\Controllers\admin\ExternalController::class, 'rnd_data']);