<?php
	//запрос => класс/метод/параметры
	return array('' => 'Main/MainPage',
				 // books
				 'newBook' => 'Book/NewBook',
				 "book/([0-9]+)" => "Book/BookIndex/$1",
				 "book/([0-9]+)/read" => "Book/ReadBook/$1",
				 "book/([0-9]+)/chapter(.+)" => "Book/SelectChapter/$1/$2",
				 "book/([0-9]+)/img_content(.+)" => "Book/CreateContent/$1",
				 // user
				 "register" => "User/Register",
				 "signIn" => "User/SignIn",
				 "profile" => "Profile/Index",
				 "logout" => "User/Logout",
				 "editProfile" => "Profile/Edit",
				 //admin
				 "admin" => "Admin/Index",
				 "admin/add" => "Admin/Add",
				 "admin/delete" => "Admin/AdminDelete",

				 "admin/update" => "Admin/AdminUpdate",
				 "admin/update/(.+)" => "Admin/AdminUpdateByName/$1",
				 "book/update/([0-9]+)" => "Admin/Update/$1",
				 "book/delete/([0-9]+)" => "Admin/Delete/$1",
				 ".+" => 'Main/MainPage');