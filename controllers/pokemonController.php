<?php


//pokemon (поля: id, name, image, power, speed)  реализовать методы №1,№2,№3,№4,№5

class pokemonController extends Controller
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
        if((isset($data['name'])) && (isset($data['image'])) && (isset($data['power'])) && (isset($data['speed']))){
            // мы передаем в модель массив с данными
            // модель должна вернуть boolean
            $examples=$this->model->load(); //просим все записи
            $id=1;
            foreach($examples as $key => $value){
                if ($examples[$key]->id > $id) {
                    $id=$examples[$key]->id;
                }
            }
            $id++;
            $dataToSave=array('id'=>$id,'name'=>$data['name'],'image'=>$data['image'],'power'=>$data['power'],'speed'=>$data['speed']);
            $addedItem=$this->model->create($dataToSave);
            $this->setResponce($addedItem);
        }
    }

    public function edit($data){
        if(isset($data['id']) && isset($data['name'])&& isset($data['image'])&& isset($data['power'])&& isset($data['speed'])) {
            $example = $this->model->save($data);
            $this->setResponce($example);
        }
    }
    public function delete($data){
        $example=$this->model->delete($data['id']);
        $this->setResponce($example);
    }
}