<?php

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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('areas', 'AreaController');
Route::get('/area/get-data-json', "AreaController@getDataForDataTable")->name('areaJson');
Route::resource('branches', 'BranchController');
Route::get('/branch/get-data-json', "BranchController@getDataForDataTable")->name('branchJson');
Route::resource('shifts', 'ShiftController');
Route::get('/shift/get-data-json', "ShiftController@getDataForDataTable")->name('shiftJson');
Route::resource('sessions', 'SessionController');
Route::resource('terms', 'TermController');
Route::get('/session/get-data-json', "SessionController@getDataForDataTable")->name('sessionJson');
Route::resource('teachers', 'TeacherController');
Route::get('teacher/get-data-json', "TeacherController@getDataForDataTable")->name('teacherJson');
Route::resource('levels', 'LevelController');
Route::get('/level/get-data-json', "LevelController@getDataForDataTable")->name('levelJson');
Route::resource('sections', 'SectionController');
Route::get('/section/get-data-json', "SectionController@getDataForDataTable")->name('sectionJson');
Route::resource('students', 'StudentController');
Route::get('/student/get-data-json', "StudentController@getDataForDataTable")->name('studentJson');
Route::resource('subjects', 'SubjectController');
Route::get('/subject/get-data-json', "SubjectController@getDataForDataTable")->name('subjectJson');
Route::post('/show-result/', 'ResultController@showResult');
Route::resource('results', 'ResultController');
Route::get('result/add/', 'ResultController@chooseTestNumber');
Route::get('result/mark/', 'ResultController@showSubjects');
Route::get('/weekly_result', 'ResultController@weeklyResult');
Route::get('/result/get-data-json',"ResultController@getDataForDataTable")->name('resultJson');
Route::get('/result/view_by_test_number', "ResultController@viewByNumber");
Route::get('/result/get_student/{id}', "ResultController@chooseNumber");
Route::post('/level_enrolls', "LevelController@enrollment");
Route::get('/section/assign_student/{id}', "SectionController@assignStudent");
Route::post('/section/save_student', "SectionController@saveStudents");
Route::get('/section/assign_subject/{id}', "SectionController@assignSubject");
Route::post('/section/save_subject', "SectionController@saveSubject");
Route::resource('weeklytests', 'WeeklyTestController');
Route::get('/weekly_test/view_subjects/', "WeeklyTestController@showSubjects");
Route::get('/weekly_test/proceed/', "WeeklyTestController@proceedWithSubject");
Route::get('/weekly_test/mark', "WeeklyTestController@proceedWithTestNumber");
Route::get('/weekly_tests/subjectWise', "WeeklyTestController@subjectWiseResult");
Route::get('/weekly_test/view_subject_wise_result/', "WeeklyTestController@viewSubjectWiseResult");
Route::get('/weekly_test/view_by_number', "WeeklyTestController@viewNumberWiseResult");
Route::get('/weeklytest_updateMarks', "WeeklyTestController@updateMarks");
Route::get('/weeklytest/deleteResult', "WeeklyTestController@deleteResult");
Route::get('/weeklytest/storeMarks', "WeeklyTestController@storeMarks");
Route::get('/weekly_test/proceed_with_student_id/', "WeeklyTestController@viewStudentWiseResult");
Route::get('/weekly_test/generate_term_result', "WeeklyTestController@generateTermResult");
Route::get('/weekly_test/regenerate_term_result', "WeeklyTestController@reGenerateTermResult");
Route::get('/weekly_test/view_term_result/', "WeeklyTestController@viewTermResult");
Route::resource('termresults', 'TermResultController');
Route::get('/view_report', "WeeklyTestController@viewTermReport");

Route::post('level_enrolls_assign', 'LevelController@enrollment');
Route::get('/level_enroll/get-data-json', "LevelEnrollController@getDataForDataTable")->name('level_enrollJson');
Route::resource('levelEnrolls', 'LevelEnrollController');
Route::get('/section_student/get-data-json',"WeeklyTestController@getDataForDataTable")->name('studentSectionJson');
Route::get('/term/get-data-json',"TermController@getDataForDataTable")->name('termJson');
Route::get('/pdf', "WeeklyTestController@downloadPDF");
Route::resource('sectionStudents', 'SectionStudentController');
Route::get('/section_enroll/get-data-json',"SectionStudentController@getDataForDataTable")->name('sectionStudentJson');
Route::resource('sectionSubjectTeachers', 'SectionSubjectTeacherController');
Route::get('/section_subject_enroll/get-data-json',"SectionSubjectTeacherController@getDataForDataTable")->name('sectionSubjectTeacherJson');

Route::get('/pdf/report-weekly-test/{id}','ReportController@weeklyTest')->name('reportWeeklyTest');

Route::resource('accounts', 'AccountController');
Route::get('/account/get-data-json',"AccountController@getDataForDataTable")->name('accountJson');

Route::resource('final_reports', "FinalReportController");
Route::get('/final_report/view_students', "FinalReportController@viewStudents");
Route::get('/final_report/process_students', "FinalReportController@processStudents");
Route::get('/final_report/reprocess_students', "FinalReportController@reProcessStudents");
Route::get('/final_report_view/process_student/{id}', "FinalReportController@processSpecificStudents");

Route::get('/pdf/report-final/{id}','FinalReportController@pdfReportFinal')->name('reportPdfFinal');

Route::resource('fiscal_years', 'FiscalYearController');
Route::get('/fiscal_year/get-data-json',"FiscalYearController@getDataForDataTable")->name('FiscalYearJson');

Route::resource('business_months', 'BusinessMonthController');
Route::get('/business_month/get-data-json',"BusinessMonthController@getMonthDataForDataTable")->name('businessMonthJson');

Route::resource('fees_books', 'FeesBookController');
Route::post('fees_book/check', 'FeesBookController@checkPrefixLeaf');
Route::get('/fees_book/get-data-json',"FeesBookController@getDataForDataTable")->name('feesBookJson');

Route::resource('fees_types', 'FeesTypeController');
Route::get('/fees_type/get-data-json',"FeesTypeController@getDataForDataTable")->name('feesTypeJson');

Route::resource('section_wise_fees', 'SectionWiseFeesController');
Route::get('/section_wise_fee/get-data-json',"SectionWiseFeesController@getDataForDataTable")->name('sectionWiseFeesJson');

Route::resource('payment_methods', 'PaymentMethodController');
Route::get('/payment_method/get-data-json',"PaymentMethodController@getDataForDataTable")->name('paymentMethodJson');

Route::resource('collected_fees', 'CollectedFeesController');
Route::get('/collected_fee/invoice/{id}', 'CollectedFeesController@pdfInvoice');
Route::get('/collected_fee/calculate', 'CollectedFeesController@calculateFees');
Route::get('/collected_fee/get-data-json',"CollectedFeesController@getDataForDataTable")->name('paymentMethodJson');

Route::resource('categories', 'CategoryController');
Route::get('/category/get-data-json',"CategoryController@getDataForDataTable")->name('categoryJson');

Route::resource('suppliers', 'SupplierController');
Route::get('/supplier/get-data-json',"SupplierController@getDataForDataTable")->name('supplierJson');

Route::resource('vouchers', 'VoucherController');
Route::get('/voucher/get-data-json',"VoucherController@getDataForDataTable")->name('voucherJson');

Route::resource('financial_reports', 'FinancialReportController');
Route::post('financial_report/date_wise_report', 'FinancialReportController@dateWiseReport');
Route::post('financial_report/month_wise_report', 'FinancialReportController@monthWiseReport');
Route::post('financial_report/year_wise_report', 'FinancialReportController@yearWiseReport');
Route::post('financial_report/student_wise_report', 'FinancialReportController@studentWiseReport');
Route::get('/payment_history/get-data-json',"FinancialReportController@getDataForDataTable")->name('payHistoryJson');

Route::resource('prefixes', 'PrefixController');
Route::get('/prefix/get-data-json',"PrefixController@getDataForDataTable")->name('prefixJson');

Route::get('/pdf/student-financial-history/{id}', 'FinancialReportController@studentWiseReportView');


