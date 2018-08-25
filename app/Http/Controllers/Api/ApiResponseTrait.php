<?php 

namespace App\Http\Controllers\Api;

trait ApiResponseTrait{
	/*
	*[
	*	'date' =>,
	*	'status' => ,
	*	'error' =>
	*]
	*/

	public function apiResponse($date = null,$error = null,$code = 200){

		$array = [
			'date' 		=> $date,
			'status' 	=> in_array($code,$this->successCode())? true : false,
			'error' 	=> $error
		];
		return response($array,$code);
	}

	public function successCode(){
		return [
			200,201,202
		];
	}

	public function notFoundResponse(){
		 return $this->apiResponse(null,$validate->errors(),422);
	}
}