<?php

function guestId($request)
{
    return $request->session()->get('guestId');
   
}