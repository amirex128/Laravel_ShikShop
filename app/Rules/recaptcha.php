<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class recaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        $client=new Client();
	
	    $res=$client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
		    'form_params' => [
			    'secret' => '6LcN95IUAAAAAK3hklLdmxseCEl8J513_GZRAblf',
			    'response' => $value
		    ]
	    ]);
	    return json_decode($res->getBody())->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
