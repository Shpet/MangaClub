<?php
	//запрос => класс/метод/параметры
	return array('' => 'Main/MainPage',
				 'newBook' => 'Book/NewBook',
				 "book/([0-9]+)" => "Book/BookIndex/$1",
				 'book/popular'=> 'Book/PopularBook',
				 'book' => 'Book/AllBook',
				 'user' => 'User/profile',
				 'test' => 'Main/Test');