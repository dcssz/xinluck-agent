<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

Class Period extends Model
{ 
    use SoftDeletes;
    //protected $hidden = ['deleted_at'];

    //结转项目
    public static function getCkoutItemName($value) {
        switch ($value) {
            case 1:
                return '退佣';
                break;
            case 2:
                return "退水";
                break;
            case 3:
                return "總輸贏";
                break;
            default;
                return '';
                break;
        }
    }

    //结转项目
    public static function getCkoutTypeName($value) {
        switch ($value) {
            case 1:
                return '固定月結';
                break;
            case 2:
                return "固定周結";
                break;
            case 3:
                return "固定日結";
                break;
            case 4:
                return "手動設定";
                break;
            default;
                return '';
                break;
        }
    }
}
