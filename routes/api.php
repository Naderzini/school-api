<?php

use Illuminate\Http\Request;
use App\Model\Admin;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//****************** login Route for admins **************************/
    Route::post('loginAdmin','Admin\AuthController@loginAdmin');
    Route::post('resetAdmin/password','Admin\ForgetPasswordController@resetPassword');
//*****************All Admins Router *********************************/
Route::group(['prefix' => 'admin','middleware' => 'auth:admin','checkrole:superadmin,admin'], function () {
    Route::post('addParent','ChildParent\ChildParentController@create');
    Route::get('getAllParents','ChildParent\ChildParentController@index');
    Route::delete('deleteParent/{id}','ChildParent\ChildParentController@destroy');
    Route::post('updateParent/{id}','ChildParent\ChildParentController@update');
    Route::get('getParents','ChildParent\ChildParentController@getParents');
    Route::get('parentsNumber','ChildParent\ChildParentController@parentsNumber');
    Route::get('parentsMenNumber','ChildParent\ChildParentController@parentsMenNumber');
    Route::get('parentsWomenNumber','ChildParent\ChildParentController@parentsWomenNumber');
    //*********** Save device token Route *****************************
    Route::post('saveToken/{id}','Admin\AdminController@saveToken');
    //*************childrens Routes ***********************************/
    Route::post('addChildren','Children\ChildrenController@create');
    Route::get('getAllChildrens','Children\ChildrenController@index');
    Route::delete('deleteChildren/{id}','Children\ChildrenController@destroy');
    Route::post('updateChildren/{id}','Children\ChildrenController@update');
    Route::get('childrensNumber','Children\ChildrenController@childrensNumber');
    //*************Sujects Routs *************************************/
    Route::post('addSubject','Subject\SubjectController@create');
    Route::get('getAllSubjects','Subject\SubjectController@index');
    Route::put('updateSubject/{id}','Subject\SubjectController@update');
    Route::delete('deleteSubject/{id}','Subject\SubjectController@destroy');
    Route::get('getSubjects','Subject\SubjectController@getSubjects');
    //*************SchoolEventes Route *******************************/
    Route::post('addEvent','SchoolEvent\SchoolEventController@create');
    Route::get('getAllEvents','SchoolEvent\SchoolEventController@index');
    Route::delete('deleteEvent/{id}','SchoolEvent\SchoolEventController@destroy');
    //*************Classes Route ************************************/
    Route::post('addClasse','Group\GroupController@create');
    Route::get('getAllClasses','Group\GroupController@index');
    Route::put('updateClasse/{id}','Group\GroupController@update');
    Route::delete('deleteClasse/{id}','Group\GroupController@destroy');
    Route::get('getClasses','Group\GroupController@getGroups');
    //*************Teacher Route ***********************************/
    Route::post('addTeacher','Teacher\TeacherController@create');
    Route::get('getAllTeachers','Teacher\TeacherController@index');
    Route::delete('deleteTeacher/{id}','Teacher\TeacherController@destroy');
    Route::get('teachersNumber','Teacher\TeacherController@teachersNumber');
    Route::get('teachersWomenNumber','Teacher\TeacherController@teachersWomenNumber');
    Route::get('techersMenNumber','Teacher\TeacherController@techersMenNumber');
    //*************Claim Route for admin***********************************/
    Route::get('getAllClaims','Claim\ClaimController@index');
    Route::put('answerClaim/{id}','Claim\ClaimController@update');
    Route::delete('deleteClaim/{id}','Claim\ClaimController@destroy');
    //*************Message Routes ***********************************/
     Route::post('addMessage','Message\MessageController@create');
     Route::get('getMessages/{id}','Message\MessageController@index');
    //*************change password Route ***********************************/
    Route::post('changePasword/{id}','Admin\AdminController@changePasword');
});
//**************** Super Admin Router ********************
Route::group(['prefix' => 'admin','middleware' => ['auth:admin','checkrole:superadmin']], function () {
    Route::post('addAdmin','Admin\AdminController@create');
    Route::get('getAllAdmins','Admin\AdminController@index');
    Route::get('findAdmin/{first_Name}','Admin\AdminController@findAdmin');
    Route::get('adminsNumber','Admin\AdminController@adminsNumber');
    Route::delete('deleteAdmin/{id}','Admin\AdminController@destroy');
    Route::post('updateAdmin/{id}','Admin\AdminController@update');
});

//*********** Parent Routers ************************************************
//*********** login Routers *****************************
Route::group(['prefix' => 'parent'], function () {
    Route::post('loginParent','ChildParent\AuthController@loginParent');
    Route::post('reset/password','ChildParent\ForgetPasswordController@resetPassword');});
    Route::group(['prefix' => 'parent','middleware' => 'auth:childparent'], function () {
//*********** Events Routers *****************************
    Route::get('getAllEventsMobile','SchoolEvent\SchoolEventController@getAllEventsMobile');
//*********** Claim Routers *****************************
    Route::post('addClaim','Claim\ClaimController@create');
    Route::get('getMyClaims/{id}','Claim\ClaimController@getMyClaims');
//*********** Children Routers *****************************
    Route::get('getMyChildrens/{id}','Children\ChildrenController@getMyChildrens');
    Route::get('getChildrenSubjects/{id}','Children\ChildrenController@getChildrenSubjects');
    Route::get('getChildrenTeachers/{id}','Children\ChildrenController@getChildrenTeachers');
//*********** Save device token Route *****************************
    Route::post('saveTokenDevice/{id}','ChildParent\ChildParentController@saveTokenDevice');
//*************Message Routes ***********************************/
    Route::post('addMessage','Message\MessageController@create');
    Route::get('getMessages/{id}','Message\MessageController@index');
    //*************change password Route ***********************************/
    Route::post('changePasword/{id}','ChildParent\ChildParentController@changePasword');
    });

