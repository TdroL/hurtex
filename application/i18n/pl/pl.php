<?php defined('SYSPATH') or die('No direct script access.');

return array(
	// date
	'January'	=> 'Styczeń',
	'February'	=> 'Luty',
	'March'		=> 'Marzec',
	'April'		=> 'Kwiecień',
	'May'		=> 'Maj',
	'June'		=> 'Czerwiec',
	'July'		=> 'Lipiec',
	'August'	=> 'Sierpień',
	'September'	=> 'Wrzesień',
	'October'	=> 'Październik',
	'November'	=> 'Listopad',
	'December'	=> 'Grudzień',

	'name' => 'Nazwa',

	// errors
	'Internal error: :param1'			=> 'Wystąpił błąd serwera: :param1',
	'page ":link" does not exists'		=> 'Strona ":link" nie istnieje',
	':field must not be empty'			=> 'Pole ":field" nie może być puste',
	':field must be the same as :param1'					=> 'Pole ":field" musi być takie samo jak pole :param1',
	':field does not match the required format'				=> 'Pole ":field" nie pasuje so formatu',
	':field must be exactly :param1 characters long'		=> 'Pole ":field" musi mieć :param1 znaków',
	':field must be at least :param1 characters long'		=> 'Pole ":field" musi posiadać przynajmniej :param1 znaków',
	':field must be less than :param1 characters long'		=> 'Pole ":field" musi posiadać najwyżej :param1 znaków',
	':field must be one of the available options'			=> 'Pole ":field" musi być jedną z dostepnych opcji',
	':field must be a digit'								=> 'Pole ":field" musi być cyfrą',
	':field must be a decimal with :param1 places'			=> 'Pole ":field" musi być liczbą z :param1 liczbami po przecinku',
	':field must be within the range of :param1 to :param2'	=> 'Pole ":field" musi zawierać się pomiędzy :param1 a :param2',
	'file :field must be valid'							=> 'Plik :field musi być prawidłowy',
	'file :field must not be empty'						=> 'Pole ":field" nie może być puste',
	'file :field (":param1") has wrong file type'		=> 'Plik :field posiada zły typ pliku',
	'file :field (":param1") is too big'				=> 'Plik :field jest zbyt duży',
	'file :field (":param1") already exists'			=> 'Plik :field (":param1") już istnieje',
	'file :field - file ":param1" not found'			=> ':field: nie znaziono pliku ":param1"',
	':field - such category does not exist'				=> ':field - wybrana kategoria nie istnieje',
	':field - folder ":param1" does not exist'			=> ':field - katalog ":param1" nie istnieje',
	':field must be valid url'							=> 'Pole ":field" musi być poprawnym adresem URL',
	':field must be unique'								=> 'Pole ":field" musi być unikalne - taka wartość już istnieje',
	':field must contain only letters, digits, dashes and underscores characters'	=> 'Pole ":field" może zawierać jedynie litery (bez polskich znaków), cyfry, myślniki i pokreślenia',
	':field must be a valid email'						=> 'Pole ":field" musi być poprawnym adresem email',
	':field must contain only letters without spaces'	=> 'Pole ":field" musi zawierać tylko litery bez spacji',
	':field must be a phone number'						=> 'Pole ":field" musi być poprawnym numerem telefonu', 
	// pagination
	'First'		=> 'Pierwsza',
	'Previous'	=> 'Poprzednie',
	'Next'		=> 'Następne',
	'Last'		=> 'Ostatnia',
	'Loading'	=> 'Ładuję',
	
	// admin
	'Rendered in :time seconds using :memory of memory.' => 'Wygenerowno w :time sekundy używając :memory KB pamięci.',
);