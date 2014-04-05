<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"         => ":attribute moet geaccepteerd zijn.",
	"active_url"       => ":attribute is geen geldige url.",
	"after"            => ":attribute moet een datum zijn na :date.",
	"alpha"            => ":attribute mag alleen letter bevatten.",
	"alpha_dash"       => ":attribute mag alleen letters, getallen of dashes bevatten",
	"alpha_num"        => ":attribute mag alleen letters en getallen bevatten.",
	"array"            => ":attribute moet een array zijn.",
	"before"           => ":attribute moet een datum zijn voor :date.",
	"between"          => array(
		"numeric" => " :attribute moet een waarde zijn tussen :min en :max.",
		"file"    => " :attribute mag min. :min en max. :max kilobytes bevatten.",
		"string"  => " :attribute mag min. :min en :max aantal karakters bevatten.",
		"array"   => " :attribute mag min. :min en :max items bevatten.",
	),
	"confirmed"        => " :attribute confirmatie komt niet overeen.",
	"date"             => " :attribute is geen geldige datum.",
	"date_format"      => " :attribute komt niet overeen met :format.",
	"different"        => " :attribute en :or moeten verschillend zijn.",
	"digits"           => " :attribute moet minstens :digits getallen bevatten.",
	"digits_between"   => " :attribute moet min. :min en :max getallen bevatten.",
	"email"            => " :attribute is geen geldige email.",
	"exists"           => " :attribute is niet geldig.",
	"image"            => " :attribute moet een afbeelding zijn.",
	"in"               => " :attribute is ongeldig.",
	"integer"          => " :attribute moet een integer zijn.",
	"ip"               => " :attribute moet een geldig IP-adres zijn.",
	"max"              => array(
		"numeric" => " :attribute mag niet groter zijn dan :max.",
		"file"    => " :attribute mag niet groter zijn dan :max kilobytes.",
		"string"  => " :attribute mag niet meer dan :max karakters bevatten.",
		"array"   => " :attribute mag max. :max items bevatten.",
	),
	"mimes"            => " :attribute moet een bestand zijn van het type: :values.",
	"min"              => array(
		"numeric" => " :attribute is min. :min.",
		"file"    => " :attribute bevat min. :min kilobytes.",
		"string"  => " :attribute bevat min. :min karakters.",
		"array"   => " :attribute bevat min. :min items.",
	),
	"not_in"           => " Geselecteerde :attribute is ongeldig.",
	"numeric"          => " :attribute moet een getal zijn.",
	"regex"            => " :attribute is een ongeldig formaat.",
	"required"         => " Het :attribute veld is vereist.",
	"required_if"      => " :attribute veld is vereist wanneer when :or of :value.",
	"required_with"    => " :attribute veld is vereist wanneer :values aanwezig zijn.",
	"required_without" => " :attribute veld is vereist wanneer :values niet aanwezig zijn.",
	"same"             => " :attribute en :or moeten hetzelfde zijn.",
	"size"             => array(
		"numeric" => " :attribute is gelijk aan :size.",
		"file"    => " :attribute is gelijk aan :size kilobytes.",
		"string"  => " :attribute is gelijk aan :size characters.",
		"array"   => " :attribute bevat :size items.",
	),
	"unique"           => " :attribute is al reeds ingenomen.",
	"url"              => " :attribute is een ongeldig formaat.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
        'givenname'       => 'voornaam',
        'surname'         => 'achternaam',
        'email'           => 'email adres',
        'password'        => 'wachtwoord',
        'password_repeat' => 'wachtwoord herhalen',
        'role'            => 'gebruiker'
    ),

);
