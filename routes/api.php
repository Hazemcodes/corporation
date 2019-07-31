<?php

Route::get("/users", 'UserController@index');
Route::post("/users/create", 'UserController@store');
Route::put("/users/{user}/update", 'UserController@update');
Route::delete("/users/{user}/delete", 'UserController@delete');

Route::get("/countries", 'CountryController@index');
Route::post("/countries/create", 'CountryController@store');
Route::put("/countries/{country}/update", 'CountryController@update');
Route::delete("/countries/{country}/delete", 'CountryController@delete');

Route::get("/cities", 'CityController@index');
Route::post("/cities/create", 'CityController@store');
Route::put("/cities/{city}/update", 'CityController@update');
Route::delete("/cities/{city}/delete", 'CityController@delete');

Route::get("/companies", 'CompanyController@index');
Route::post("/companies/create", 'CompanyController@store');
Route::put("/companies/{company}/update", 'CompanyController@update');
Route::delete("/companies/{company}/delete", 'CompanyController@delete');

Route::get("/jobs", 'JobController@index');
Route::post("/jobs/create", 'JobController@store');
Route::put("/jobs/{job}/update", 'JobController@update');
Route::delete("/jobs/{job}/delete", 'JobController@delete'); 

Route::get("/skills", 'SkillController@index');
Route::post("/skills/create", 'SkillController@store');
Route::put("/skills/{skill}/update", 'SkillController@update');
Route::delete("/skills/{skill}/delete", 'SkillController@delete'); 

Route::post('jobs/best/{user}', 'JobSearchController@best');

// The task
// Users should be able to look for jobs
// Retreive the best suitable 3 jobs for a given user 

// Hazem, 10000, 4