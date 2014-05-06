<?php
function getApp(){
	return Yii::app();
}

function getBaseUrl(){
	return getApp()->baseUrl;
}

function getCS(){
	return getApp()->clientScript;
}

function getRequest(){
	return getApp()->request;
}

function url($route,$params=array()){
	return getApp()->createUrl($route, $params);
}

function getParams($key){
	return getApp()->params[$key];
}

function pdd($data){
	echo '<pre>';
	print_r($data);
	die();
}