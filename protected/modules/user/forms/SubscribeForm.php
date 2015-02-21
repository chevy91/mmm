<?php

class SubscribeForm extends User
{
    public function rules()
    {
        return [
			['subscribe_status', 'required'],
		];
    }
}
