<?php


//參數只有一個
Route::get('student/{student_no}', function ($student_no) {
    return "學號:".$student_no;
});
Route::get('student/{student_no}/score', function ($student_no) {
    return "學號:".$student_no."的所有成績";
});
//參數有多個

Route::get('student/{student_no}/score/{subject}', function ($student_no,$subject) {
    return "學號:".$student_no."的".$subject."成績";
});

//參數可有可無時
Route::get('student/{student_no}/score/{subject?}', function ($student_no,$subject =null) {
    return "學號:".$student_no."的".((is_null($subject))?"所有科目":$subject)."成績";
});

//正規表達式限制參數 將參數作一些格式限制
Route::get('student/{student_no}', function ($student_no) {
    return "學號:".$student_no;
})->where(['student_no'=>'s[0-9]{10}']);
Route::get('student/{student_no}/score/{subject?}', function ($student_no,$subject =null) {
    return "學號:".$student_no."的".((is_null($subject))?"所有科目":$subject)."成績";
})->where(['student_no'=>'s[0-9]{10}','subject'=>' chiness | english | math)']);
