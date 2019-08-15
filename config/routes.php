<?php
	//запрос => класс/метод/параметры
	return array('' => 'Main/MainPage',
				 'newBook' => 'Book/NewBook',
				 "book/([0-9]+)" => "Book/BookIndex/$1",
				 "book/([0-9]+)/read" => "Book/ReadBook/$1",
				 "book/([0-9]+)/chapter(.+)" => "Book/SelectChapter/$1/$2",
				 "book/([0-9]+)/img_content(.+)" => "Book/CreateContent/$1",
				 "register" => "User/Register",
				 "signIn" => "User/SignIn",
				 "profile" => "Profile/Index",
				 "logout" => "User/Logout",
				 "editProfile" => "Profile/Edit",
				 ".+" => 'Main/MainPage');