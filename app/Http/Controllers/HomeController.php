<?php namespace App\Http\Controllers;


class HomeController extends Controller{

    public function index(){
        echo "Home > index()";
    }
    public function create(){
        echo "Home > create()";
    }
    public function store(){
        echo "Home > store()";
    }
    public function edit($id){
        echo "Home > edit({$id})";
    }
    public function update($id){
        echo "Home > update({$id})";
    }
    public function destroy($id){
        echo "Home > destroy({$id})";
    }
}