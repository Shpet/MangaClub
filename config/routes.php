<?php
	//запрос => класс/метод/параметры
	return array("book/([a-z]+)/([0-9]+)" => "Book/BookIndex/$1/$2",
				 'book/new' => 'Book/NewBook',
				 'book/popular'=> 'Book/PopularBook',
				 'book' => 'Book/AllBook',
				 'user' => 'User/profile',);