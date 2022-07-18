<?php namespace system\Database\ORM;

use system\Database\Traits\HasCRUD;
use system\Database\Traits\HasAttributes;
use system\Database\Traits\HasMethodColor;
use system\Database\Traits\HasQueryBuilder;
use system\Database\Traits\HasRelation;
//use system\Database\Traits\HasSoftDelete;

abstract class Model{

use HasCRUD,HasRelation,HasQueryBuilder,HasMethodColor,/*HasSoftDelete,*/HasAttributes;

protected $table;
protected $fillable=[];
protected $hidden=[];
protected $casts=[];
protected $primaryKey='id';
protected $createdAt='created_at';
protected $updatedAt='updated_at';
protected $deletedAt=null;
protected $collection=[];



}