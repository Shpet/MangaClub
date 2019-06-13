<?php
	//запрос => класс/метод/параметры
	return array('' => 'Main/MainPage',
				 "book/([0-9]+)" => "Book/BookIndex/$1",
				 'book/popular'=> 'Book/PopularBook',
				 'book' => 'Book/AllBook',
				 'user' => 'User/profile',);