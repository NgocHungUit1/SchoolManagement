<?php

namespace App\Http\Controllers;
use App\Http\Requests\ClassRequest;
use App\Services\ClassService;

class ClassController extends Controller
{

    private $service;

    public function __construct(ClassService $service)
    {
        $this->service = $service;
    }

    public function list()
    {
        return $this->service->list();
    }

    public function getData()
    {
        return $this->service->getData();
    }

    public function add()
    {
        return $this->service->add();
    }

    public function insertClass(ClassRequest $request)
    {
        return $this->service->insertClass($request);
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function view($id)
    {
        return $this->service->view($id);
    }

    public function myClass()
    {
        return $this->service->myClass();
    }

    public function editClass(ClassRequest $request, $id)
    {
        return $this->service->editClass($request, $id);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

}
