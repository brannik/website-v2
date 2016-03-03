<?php
include $_SERVER['DOCUMENT_ROOT']."/config/connect.php";
$QueryPostNews = "";
$QueryEditNews = "";
$QueryDeleteNews = "";
$QueryCreateForum = "";
$QueryEditForum = "";
$QueryDeleteForum = "";
$QueryCommentInForum = "";
$QueryDellCommentInForum = "";
$QuerySendWebMail = "";
$QueryDelInGameMail = "";
$QueryDellWebMail = "";
$QuerySaveProfile = "";
$QueryChangeAnnounce = "";

function PostNews($title,$text,$autor){
	//dobavqne na post v novini
	$QueryPostNews = "INSERT INTO news (title,text,autor) VALUES ('". $title ."','". $text ."','". $autor ."')";
	
}
function EditNews($id/* new data */){
	// promqna na post ot nachelnata stranica
}
function DeleteNews($id){
	//iztrivane na post ot novini
}
function CreateForum(/* parameters */){
	//suzdavane na nov forum
}
function EditForum($id/* new data */){
	// promqna na sushtestvuvasht forum
}
function DeleteForum($id){
	//iztrivane na forum + vsichki postove ot DB
}
function CommentInForum($forumId/* more */){
	//otgovor vuv forum
}
function DellCommentFromForum($forumId,$commentId){
	//premahvane na otgovor vuv forum
}
function SendWebsiteMail(/* mail,from,to */){
	//izpreashtane na mail na website profila
}
function DeleteInGmeMail(/* mail id */){
	// iztrivane na mail v igrata
}
function DeleteWebSiteMail(/* mail id */){
	//iztrivane na mail ot websaita
}
function SaveProfile(/* new data */){
	//zapazvane na nastroikite na profila
}
function SetAnnounce($text){
	// promqna na announce-a
}

function BanAcc($id,$time,$reason){
	// ban na account
}
?>