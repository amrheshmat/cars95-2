<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //Main Table 
    //Table Name
        protected $fillable = ['country_desc_ar','country_desc_en','created_by','updated_by'];
    //For index 
        public $dataTable= [
            'id'                => array('search_type'=>'equal'        , 'query_value'=>'id'        , 'query_as'=>'id'),
            'country_desc_ar'   => array('search_type'=>'like'         , 'query_value'=>'country_desc_ar'   , 'query_as'=>'country_desc_ar'),
            'country_desc_en'   => array('search_type'=>'like'         , 'query_value'=>'country_desc_en'   , 'query_as'=>'country_desc_en'),
        ];
    //Create Country 
        public $createAdmin= [
            'country_desc_ar'   => array('type'=>'text','value' =>'','required'=>'required'),
            'country_desc_en'   => array('type'=>'text','value' =>'','required'=>'required'),
        ];
    //Edit Country 
        public $editAdmin= [
            'country_desc_ar'   => array('type'=>'text','value' =>'','required'=>'required'),
            'country_desc_en'   => array('type'=>'text','value' =>'','required'=>'required'),
        ];
    //Relationship
    public function scopeGetDataTable($query,$orderby,$ordertype,$rows,$columns  = ''){
        return $query->selectRaw('*')
        ->Where(function ($query) use ($columns) 
                {
                    if(!empty($columns) and $columns != null) {
                        foreach ($columns as $keys => $values) {
                            if ($values['type'] == 'like') {
                                $query->whereRaw($keys.' like "%'.$values['value'].'%"');
                            }elseif ($values['type'] == 'datatime') {
                                $datatime = explode(' - ', $values['value']);
                                $query->whereBetween($keys, [$datatime[0], $datatime[1]]);
                            }else{
                                $query->whereRaw($keys.'= "'.$values['value'].'"');
                            }
                        }
                    }else{
                            $query->whereNotNull('id');
                    }
        })
        ->orderBy($orderby,$ordertype)
        ->groupBy('id')
        ->paginate($rows);
    }
}


