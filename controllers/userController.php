<?php


//user (поля: id, name, score) реализовать методы №1,№2,№3,№4,№5

class userController extends Controller
{
    public function index(){
        $examples=$this->model->load();		// просим у модели все записи
        $this->setResponce($examples);		// возвращаем ответ
    }

    public function view($data){
        $example=$this->model->load($data['id']-1); // просим у модели конкретную запись
        $this->setResponce($example);
    }

    public function add($data){
        if(isset($data['name'])&& isset($data['score'])){
            // мы передаем в модель массив с данными
            // модель должна вернуть boolean

            $examples=$this->model->load(); //просим все записи
            $size=count($examples)+1;
            $dataToSave=array('id'=>$size,'name'=>$data['name'],'score'=>$data['score']);
            $addedItem=$this->model->create($dataToSave);
            $this->setResponce($addedItem);
        }
    }
    public function edit($data){

        if(isset($data['id']) && isset($data['name'])&& isset($data['score'])) {
            $example = $this->model->save($data);
            $this->setResponce($example);
        }
    }

    public function delete($data){
        $example=$this->model->delete($data['id']); // просим у модели конкретную запись
        $this->setResponce($example);
    }
}