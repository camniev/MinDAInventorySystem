<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//echo "hello";
	// return redirect("http://192.168.1.248/login");
//});

Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('index');

Auth::routes();

//<<INSPECTION AND ACCEPTANCE>>

Route::get('/inspection-and-acceptance','Inspection_and_Acceptance_Controller@index');

Route::get('/inspection-and-acceptance/new-inspection','Inspection_and_Acceptance_Controller@new_inspection')->name('New Inspection and Acceptance');

Route::post('/inspection-and-acceptance/save-inspection-title','Inspection_and_Acceptance_Controller@save_inspection_title');

Route::get('/inspection-and-acceptance/inspection-details/{id}','Inspection_and_Acceptance_Controller@new_inspection_details')->name('New Inspection and Acceptance');

Route::post('/inspection-and-acceptance/save-inspection-details/{id}','Inspection_and_Acceptance_Controller@save_inspection_details');

Route::get('/inspection-and-acceptance/add-inspection-details/{id}','Inspection_and_Acceptance_Controller@add_inspection_details')->name('Add Inspection and Acceptance');

Route::get('/inspection-and-acceptance/delete-inspection-details/{id}/{id2}','Inspection_and_Acceptance_Controller@delete_inspection_details');

Route::get('/inspection-and-acceptance/edit-inspection-details/{id}','Inspection_and_Acceptance_Controller@edit_inspection_details');

Route::post('/inspection-and-acceptance/update-inspection-details/{id}','Inspection_and_Acceptance_Controller@update_inspection_details');

Route::get('/inspection-and-acceptance/view-inspection-details/{id}','Inspection_and_Acceptance_Controller@view_inspection_details');

Route::post('/inspection-and-acceptance/delete-inspection-data/{id}','Inspection_and_Acceptance_Controller@delete_inspection_data');

Route::get('/inspection-and-acceptance/inspector/{id}','Inspection_and_Acceptance_Controller@inspector');

Route::post('/inspection-and-acceptance/update-inspector/{id}','Inspection_and_Acceptance_Controller@update_inspector');

Route::get('/inspection-and-acceptance/search-iar-number/{id}','Inspection_and_Acceptance_Controller@iar_number_filter');

//<<REQUESTITION>>

Route::get('/request','RequestController@index')->name('List of all Request');

Route::get('/request/new-request','RequestController@new_request');

Route::post('/request/save-request','RequestController@save_request');

Route::get('/request/request-details/{id}/{id2}','RequestController@new_details')->name('Add Request Details');

Route::post('/request/save-request-detail/{id}','RequestController@save_request_details');

Route::get('/request/request-details-append/{id}/{id2}/{id3}','RequestController@add_details')->name('Add Request Details');

Route::get('/request/respond-request/{id}/{id2}','RequestController@request_respond');

Route::get('/request/detete-detail/{id}/{id2}/{id3}/{id4}/{id5}','RequestController@delete_item');

Route::get('/request/get-stock-info/{id}/{id2}','RequestController@get_stock');

Route::get('/request/view-detail/{id}/{id2}','RequestController@view_item')->name('View Details');

Route::post('/request/delete-request/{id}/{id2}','RequestController@delete_request')->name('Delete Request');

Route::get('/request/update-item-detail/{id}','RequestController@update_item_data');

Route::post('/request/save-respond-detail/{edit_id}/{_request_id}','RequestController@save_item_data');

Route::get('/request/update-personnel-detail/{id}','RequestController@get_info_data');

Route::post('/request/save-personnel-detail/{id}','RequestController@update_info_data');

Route::get('/request/get-stock-balance/{id}','RequestController@get_stock_balance');

Route::get('/request/get-stock-par-ics-type/{id}','RequestController@get_stock_par_ics_type');

Route::get('/request/details-get-stock-balance/{id}','RequestController@details_get_stock_balance');

//<<STOCK CARD>>

Route::get('/stock-card','StockCardController@index')->name('List of Stocks');

Route::get('/stock-card/view-stock-list/{id}/{id2}/{id3}','StockCardController@view_detail')->name('Stock Details View');

Route::get('/stock-card/404','StockCardController@error404');

//<<PROPERTY CARD>>

Route::get('/property-card','PropertyController@index')->name('List of Stocks');

Route::get('/property-card/view-stock-lists/{id}/{id2}/{id3}','PropertyController@view_details')->name('Stock Details View');

Route::get('/property-card/404','PropertyController@error404');

//<<PROPERTY CARD>>

Route::get('/report-on-the-physical-count-of-property-plant-and-equipment','RPCPPEController@index');

Route::get('/report-on-the-physical-count-of-property-plant-and-equipment/details/{id}/{id2}','RPCPPEController@view_details')->name('Detail View');

Route::get('/report-on-the-physical-count-of-property-plant-and-equipment/{id}','RPCPPEController@get_item');

//INVENTORY CUSTODIAN SLIP

Route::get('/inventory-custodian-slip','ICSController@index')->name('Minda Inventory System');

Route::get('/inventory-custodian-slip/list-by-fiscal-year/{id}','ICSController@fiscal_list')->name('Minda Inventory System');

Route::get('/inventory-custodian-slip/list-by-end-user/{id}','ICSController@end_user')->name('Minda Inventory System');

Route::get('/inventory-custodian-slip/list-by-fiscal-year-end-user/{id}/{id2}','ICSController@fiscal_end_user')->name('Minda Inventory System');

//PROPERTY ACKNOWLEDGEMENT RECEIPT

Route::get('/property-acknowledgement-receipt','PARController@index')->name('Minda Inventory System');

Route::get('/property-acknowledgement-receipt/list-by-fiscal-year/{id}','PARController@fiscal_list')->name('Minda Inventory System');

Route::get('/property-acknowledgement-receipt/list-by-end-user/{id}','PARController@end_user')->name('Minda Inventory System');

Route::get('/property-acknowledgement-receipt/list-by-fiscal-year-end-user/{id}/{id2}','PARController@fiscal_end_user')->name('Minda Inventory System');

//<<RSMI>>

Route::get('/supplies-and-materials','SuppliesController@index')->name('Report on Supplies and Materials Issued');

Route::get('/report-on-supplies-and-materials-issued','SuppliesController@get_dates');

Route::get('/report-on-supplies-and-materials-issued/{id}','SuppliesController@issued_list');

//<<RPCI>>

Route::get('/report-on-physical-count-of-inventories','RPCIController@index')->name('REPORT ON PHYSICAL COUNT OF INVENTORIES');

Route::get('/report-on-physical-count-of-inventories/{id}','RPCIController@report_view')->name('REPORT ON PHYSICAL COUNT OF INVENTORIES');

Route::get('/report-on-physical-count-of-inventories-get-dates','RPCIController@get_dates');

Route::get('/report-on-physical-count-of-inventories/get-stock/{id}','RPCIController@get_stock_total');

Route::post('/report-on-physical-count-of-inventories/update-stock/{id}','RPCIController@update_stock_total');

//<<REPAIR AND MAINTENANCE>>

Route::get('/repair-and-maintenance', 'Repair_and_MaintenanceController@index')->name('Lists of Repair and Maintenance');

Route::get('/repair-and-maintenance/new-repair-entry', 'Repair_and_MaintenanceController@new_entry')->name('Lists of Repair and Maintenance');

Route::post('/repair-and-maintenance/save-repair-entry', 'Repair_and_MaintenanceController@save_entry');

Route::get('/repair-and-maintenance/update-repair-item/{id}', 'Repair_and_MaintenanceController@update_repair')->name('Lists of Repair and Maintenance');

Route::post('/repair-and-maintenance/update-repair-item/{id}', 'Repair_and_MaintenanceController@save_update_entry');

Route::get('/repair-and-maintenance/view-details/{id}', 'Repair_and_MaintenanceController@view_details')->name('Details of Repair and Maintenance');

Route::get('/repair-and-maintenance/delete-repair-item-list/{id}', 'Repair_and_MaintenanceController@delete_item')->name('Delete Repair and Maintenance Data');

//<<WASTE MATERIALS>>

Route::get('/waste-materials','WasteController@index');

Route::get('/waste-materials/add-new-waste-materials-entry','WasteController@add_new_entry');

Route::post('/waste-materials/save-waste-materials-entry','WasteController@save_new_entry');

Route::get('/waste-materials/append-details-waste-materials-entry/{id}','WasteController@append_detail_entry');

Route::get('/waste-materials/add-details-waste-materials-entry/{id}','WasteController@add_detail_entry');

Route::post('/waste-materials/save-waste-materials-details-entry','WasteController@save_detail');

Route::post('/waste-materials/save-signature-waste-materials-details/{id}','WasteController@save_signature_waste_materials');

Route::get('/waste-materials/delete-waste-materials-list/{id}','WasteController@delete_waste_entry');

Route::get('/waste-materials/delete-details-waste-materials-entry/{id}/{id2}','WasteController@delete_detail_entry');

Route::get('/waste-materials/view-details-waste-materials-entry/{id}','WasteController@view_detail_entry');

//<<DISPOSAL>>

Route::get('/disposals','DisposalController@index');

Route::get('/disposals/new-disposal-plan-entry','DisposalController@new_entry')->name('Disposal New Entry');

Route::post('/disposals/save-disposal-entry','DisposalController@save_entry');

Route::post('/disposals/save-disposal-activity-entry','DisposalController@save_activity_entry');

Route::get('/disposals/add-disposal-activity-plan/{id}','DisposalController@add_activity');

Route::get('/disposals/update-disposal-activity-plan/{id}','DisposalController@update_activity');

Route::get('/disposals/view-disposal-activity-plan/{id}','DisposalController@view_activity');

Route::get('/disposals/remove-disposal-activity-plan/{id}/{id2}','DisposalController@delete_activity');

Route::get('/disposals/remove-disposal-from-list-plan/{id}','DisposalController@delete_disposal');

Route::get('/disposals/status-disposal-plan/{id}','DisposalController@status_disposal');

Route::post('/disposals/save-disposal-activity-compelete/{id}','DisposalController@save_activity_complete');

Route::get('/disposals-sample','DisposalController@index_sample');

Route::post('disposals-sample/upload', 'FileUploadController@upload')->name('upload');

//<<STOCK LIBRARY>>

Route::get('/supplies-summary','StockLibraryController@re_order_point');

Route::get('/supplies-summary/get-stock/{id}','StockLibraryController@get_stock');

Route::post('/supplies-summary/update-stock/{id}','StockLibraryController@update_stock');

//<<RE-ORDER POINT>>

Route::get('/re-order-lists','StockLibraryController@reorder_stock');

Route::get('/re-order-lists-count','StockLibraryController@count_stock');

//<<SETTINGS>>

Route::get('/settings', 'SettingsController@index')->name('Settings');

Route::post('/signatures-primary-signature','SettingsController@save_basic_info');

Route::post('/signatures-rpci-signature','SettingsController@rpci_info');

Route::get('/error-sign','SettingsController@error_signature');

//<<PAP CODE>>

Route::get('/papcode/get-codes/{id}','PapCodeController@get_code');

//<<STOCK LIBRARY>>

Route::get('/stock-code/{id}','StockLibraryController@get_code');

//<<REPORT GENERATOR

Route::get('/export-pdf-report/iar/{id}','ReportController@iar');

Route::get('/export-pdf-report/ris/{id}/{id2}','ReportController@ris');

Route::get('/export-pdf-report/stock-card/{id}/{id2}/{id3}','ReportController@stock_card');

Route::get('/export-pdf-report/stock-card-finance/{id}/{id2}/{id3}','ReportController@stock_card_finance');

Route::get('/export-pdf-report/property-card/{id}/{id2}/{id3}','ReportController@property_card');

Route::get('/export-pdf-report/property-card-finance/{id}/{id2}/{id3}','ReportController@property_card_finance');

Route::get('/export-excel-rpcppe-details/excel-output/{id}/{id2}/{id3}','ReportController@rcppe');

Route::get('/export-excel-ics/excel-output/list-all','ReportController@ics');

Route::get('/export-excel-ics/excel-output/cy-user/{id}','ReportController@ics_cy_user');

Route::get('/export-excel-ics/excel-output/cy-user-export/{id}/{id2}','ReportController@ics_cy_user_export');

Route::get('/export-excel-par/excel-output/list-all','ReportController@par');

Route::get('/export-excel-par/excel-output/cy-user/{id}','ReportController@par_cy_user');

Route::get('/export-excel-par/excel-output/cy-user-export/{id}/{id2}','ReportController@par_cy_user_export');

Route::get('/export-excel-rsmi/excel-output/rsmi/{id}','ReportController@rsmi_report');

Route::get('/export-excel-waste-materials/excel-output/{id}', 'ReportController@waste_materials_report')->name('export_excel');

Route::get('/export-excel-disposals/excel-output/{id}', 'ReportController@disposal_report')->name('export_excel');

Route::get('/export-excel-repair-and-maintenance/excel-output/{id}', 'ReportController@repairandmaintenance_report')->name('export_excel');

Route::get('/export-excel-rpci-details/excel-output/{id}/{id2}', 'ReportController@rpci_report')->name('export_excel');

Route::get('/export-excel-re-order-point','ReportController@reorder_report')->name('export_excel');

Route::get('/export-excel-iar-list','ReportController@iar_list_all');

Route::get('/export-excel-iar-number-list/{iarnumber}','ReportController@iar_list_filtered');

Route::get('/export-excel-library-list','ReportController@library_list');

//LIBRARY

Route::get('/library','SettingsController@library_entry');

Route::post('/library/add-new-stock','SettingsController@save_new_stock');

Route::post('/library/remove-stock/{id}','StockLibraryController@remove_stock');

//<REPORTS

Route::get('/{id}');
