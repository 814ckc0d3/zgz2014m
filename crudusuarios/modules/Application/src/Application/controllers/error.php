<?php

switch ($request['action'])
{
    case '404':
        echo "Error 404: Por m�s que busco, no encuentro.";
    break;
    case '405':
        echo "Error 405: La direcci�n est� muy mal puesta";
    break;
}


