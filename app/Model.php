<?php

class Model{

	// здесь будем хранить название файла данных для этой модель
	public $dataFileName;

	public function __construct($modelName){
		// конструируем название файла данных
		// должно получиться примерно /data/modelname.json
		$this->dataFileName=DATA_FOLDER.DS.$modelName.'.json';
	}
	
	// общие методы для всех моделей
//id=false
	public function load($id=false){
		// считаем файл
		$data=file_get_contents($this->dataFileName);
		// декодируем 
		$data=json_decode($data);

		// если id не передан - то возвращаем все записи, иначе только нужную
		if($id===false){
			return $data;
		}else{
			if(array_key_exists($id, $data)){
				return $data[$id];	
			}	
		}
		return false;
	}


	public function create(array $item){
		// считываем нашу "базу данных"
		$data=file_get_contents($this->dataFileName);
		// декодируем
		$data=json_decode($data);
		// добавляем элемент
		array_push($data, $item);
		// сохраняем файл, и возврfщаем результат сохранения (успех или провал)
		return file_put_contents($this->dataFileName, json_encode($data));
	}


	public function save($newData){ //изменяет запись

		$data=file_get_contents($this->dataFileName);
		$data=json_decode($data);

		foreach($data as $key => $value){
				if ($data[$key]->id==$newData['id']) {
					$data[$key]=$newData;
				}
		}
		return file_put_contents($this->dataFileName, json_encode($data));
	}


	public function delete($id){
		$data=file_get_contents($this->dataFileName);
		$data=json_decode($data);

		foreach($data as $key => $value){
			if ($data[$key]->id==$id) {
					unset($data[$key]);
					sort($data);
				}
		}

		// сохраняем файл, и возврfщаем результат сохранения (успех или провал)
		return file_put_contents($this->dataFileName, json_encode($data));
	}
}