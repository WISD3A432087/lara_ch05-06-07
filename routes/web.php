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

//正規表達式限制參數 使用param方法來替較為常用的參數進行統一的格式定義
Route::pattern('student_no','s[0-9]{10}');
Route::get('student/{student_no}', function ($student_no) {
    return "學號:".$student_no;
});
Route::get('student/{student_no}/score/{subject?}', function ($student_no,$subject =null) {
    return "學號:".$student_no."的".((is_null($subject))?"所有科目":$subject)."成績";
})->where(['subject'=>'chinese | english | math']);

//路由前綴 透過路由群組的方式 將路由網址前皆套上student
Route::pattern('student_no','s[0-9]{10}');
Route::group(['prefix'=>'student'],function(){
    Route::get('{student_no}', function ($student_no) {
        return "學號:".$student_no;
    });
    Route::get('student/{student_no}/score/{subject?}', function ($student_no,$subject =null) {
        return "學號:".$student_no."的".((is_null($subject))?"所有科目":$subject)."成績";
    })->where(['subject'=>'chinese | english | math']);
});


//路由命名 使用as來指定路由的識別名稱
Route::pattern('student_no','s[0-9]{10}');
Route::group(['prefix'=>'student'],function(){

    Route::get('{student_no}',[
        'as'=>'student',
        'uses'=>function($student_no){
        return '學號:'.$student_no;
        }
    ]);
    Route::get('{student_no}/score/{subject?}',[
        'as'=>'student.score',
        'uses'=>function($student_no,$subject =null){
            return "學號:".$student_no."的".((is_null($subject))?"所有科目":$subject)."成績";
        }
        ])->where(['subject'=>'chinese | english | math']);

});

//HomeController內加入index函數
Route::get('/','HomeController@index');

//修改路由，使之成為路由群組'student'當中的路由，使之可執行StudentController內的getStudentData及getStudentScore函數
Route::group(['prefix'=>'student'],function(){

    Route::get('{student_no}',[
        'as'=>'student',
        'uses'=>'StudentController@getStudentData'
    ]);

    Route::get('{student_no}/score/{subject?}',[
        'as'=>'student.score',
        'uses'=>'StudentController@getStudentScore'
    ])->where(['subject'=>'chinese | english | math']);
});

//新增路由'Cool'
Route::get('cool','Cool\TestController@index');

