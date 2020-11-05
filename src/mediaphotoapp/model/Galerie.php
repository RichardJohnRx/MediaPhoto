<?php

namespace mediaphotoapp\model;

class Galerie extends \Illuminate\Database\Eloquent\Model{

	protected $table ='galerie';
	protected $primaryKey ='idGalerie';
	public $timestamps=false;

	public function createur(){
		return this->belongsTo('\mediaphotoapp\model\Utilisateur','idUser');
	}
}