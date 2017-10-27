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

