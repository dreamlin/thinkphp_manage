<?php
namespace Home\Controller;
use Think\Controller;
class MyController extends Controller {
    public function index(){
        $this->show('my','utf-8');
    }
    public function info(){
        $this->show('info','utf-8');
    }
    public function address(){
        $this->show('address','utf-8');
    }
}