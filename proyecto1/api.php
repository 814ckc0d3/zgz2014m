<?php
/**
 * Combustibles y Precio
 *
 * Fuel + solicita al sistema el listado de combustibles disponibles
 * en su estaci�n con el precio por litro de cada uno de los combustibles.
 * Se indicar� el c�digo identificativo de la estaci�n de servicio.
 * Para cada combustible se indicar� el producto, marca comercial (si procede),
 * unidad de medida, precio en euros con 3 decimales por unidad de medida.
 *
 */

GET api.servotal.com/stations/1

{
    "_links": {
        "self": {
        "href": "http://api.servotal.com/stations/1"
        }
    }
    "idstation": "1",
    "_embedded": {
        "fuels": [
            {
                "product": "Product 1",
                "commercial_name": "Commercial name 1",
                "unit": "lts",
                "price": "10.000"
            },
            {
                "product": "Product 2",
                "commercial_name": "Commercial name 2",
                "unit": "lts",
                "price": "10.000"
            }
        ]
    }
}



/**
 * Surtidores y Mangueras
 *
 * Fuel+ interroga al sistema por los surtidores disponibles y sus mangueras.
 * Se indicar� el c�digo identificativo de la estaci�n de servicio.
 * El sistema responder� con un listado con la siguiente informaci�n;
 * C�digo de identificaci�n de manguera, surtidor, producto, marca comercial,
 * unidad de medida, precio en euros por unidad de medida con 3 decimales y
 * el estado de cada uno de los surtidores.
 */

GET api.servotal.com/pumps?station=1

{
    "_links": {
        "self": {
        "href": "http://api.servotal.com/pumps?station=1"
        }
    },
    "_embedded": {
        "pumps": [
            {
                "idpump": "1",
                "fuel_station_idstation": "1",
                "fuel_pump_statuses_idpumpstatus": "1",
                "fuel_pump_payment_type": "1",
                "fuel_pump_payment_available_units": "10",
                "fuel_pump_payment_available_price": "10.000",
                "_links": {
                    "self": {
                    "href": "http://api.servotal.com/pumps/1"
                }
            }
                "_embedded": {
                    "hoses": [
                        {
                            "idhose": "1",
                            "hose_status":"1",
                            "product": "Product 1",
                            "commercial_name": "Comemrcial name 1",
                            "unit": "lts",
                            "price": "10.000"
                        },
                        {
                            "idhose": "2",
                            "hose_status":"1",
                            "product": "Product 1",
                            "commercial_name": "Comemrcial name 1",
                            "unit": "lts",
                            "price": "10.000"
                        },
                    ]
                }
            },
            {
                "idpump": "2",
                "fuel_station_idstation": "1",
                "fuel_pump_statuses_idpumpstatus": "1",
                "fuel_pump_payment_type": "1",
                "fuel_pump_payment_available_units": "10",
                "fuel_pump_payment_available_price": "10.000",
                "_links": {
                    "self": {
                    "href": "http://api.servotal.com/pumps/2"
                    }
                }
                "_embedded": {
                    "hoses": [
                        {
                            "idhose": "1",
                            "hose_status":"1",
                            "product": "Product 1",
                            "commercial_name": "Comemrcial name 1",
                            "unit": "lts",
                            "price": "10.000"
                        },
                        {
                            "idhose": "1",
                            "hose_status":"1",
                            "fuel_pump_group": "1",
                            "product": "Product 1",
                            "commercial_name": "Comemrcial name 1",
                            "unit": "lts",
                            "price": "10.000"
                        },
                    ]
                }
            }        
        ]
    },
    "page_count": 1,
    "page_size": 25,
    "total_items": 2
}

/**
 * Estatus Manguera/Surtidor
 * 
 * Fuel+ solicita el estado en el que se encuentra un surtidor, 
 * el sistema informar� si est� operativo y en tal caso se indicar� 
 * si est� en uno de los posibles estados: en uso, bloqueado, 
 * desbloqueado para repostar sin l�mite, desbloqueado para una cantidad 
 * de euros (se informar� la cantidad de euros), desbloqueado para 
 * una cantidad de litros (se indicar� la cantidad de litros). 
 * En uso y litros consumidos. Al mismo tiempo se incluir� informaci�n 
 * de si la manguera se encuentra colgada o descolgada.
 */



GET api.servotal.com/pumps/1

{
    "idpump": "1",
    "fuel_station_idstation": "1",
    "fuel_pump_statuses_idpumpstatus": "1",
    "fuel_pump_payment_type": "1",
    "fuel_pump_payment_available_units": "10",
    "fuel_pump_payment_available_price": "10.000",
    "_links": {
            "self": {
            "href": "http://api.servotal.com/pumps/2"
        }
    }
    "_embedded": {
        "hoses": [
            {
                "idhose": "1",
                "hose_status":"1",
                "product": "Product 1",
                "commercial_name": "Comemrcial name 1",
                "unit": "lts",
                "price": "10.000"
            },
            {
                "idhose": "1",
                "hose_status":"1",
                "fuel_pump_group": "1",
                "product": "Product 1",
                "commercial_name": "Comemrcial name 1",
                "unit": "lts",
                "price": "10.000"
            },
        ]
    }
}

/**
 * Abrir e iniciar reportaje
 * 
 * Fuel+ indicar� el c�digo de transacci�n de Fuel+, 
 * el cliente (c�digo num�rico de fuel+) y c�digo de cliente 
 * de la estaci�n si existiera, tambi�n informar� de las 
 * promociones aplicables en funci�n de las campa�as de 
 * fidelizaci�n a las que est� adscrito el cliente y la matr�cula 
 * del veh�culo. Siempre se incluir� el NIF del cliente
 */


POST api.servotal.com/refuel

{
    "idrefuel": "100",
    "idstation":"1",
    "idpump":"1",
    "product":"product 1",
    "client_nif":"123456789",
    "client_vehicle_registration":"123456789",
    "idclient": "1",
    "unit": "lts",
    "price": "10.000",
    "refuel_quantity":"80.000"
}
        
RESULT
{
    "idtransaction":"10",
    "idrefuel":"100",
    "idstation":"1",
    "idpump":"1",
    "product":"product 1",
    "client_nif":"123456789",
    "client_vehicle_registration":"123456789",
    "idclient": "1",
    "unit": "lts",
    "price": "10.000",
    "refuel_quantity":"80.000"
}


/**
 * Descolgar manguera (to Fuel +)
 * 
 */

PATCH api.servotal.com/refuel/10

{
    "idrefuel": "100",
    "idstation":"1",
    "idstatus":"1"
}

/**
 * Iniciar repostaje (to Fuel +)
 * 
 */

PATCH api.servotal.com/refuel/10

{
    "idrefuel": "100",
    "idstation":"1",
    "idstatus":"2"
}

/**
 * Colgar manguera (to Fuel +)
 * 
 */

PATCH api.servotal.com/refuel/10

{
    "idrefuel": "100",
    "idstation":"1",
    "idstatus":"3",
    "quantity":"28" // informa en units o en price?
}


/**
 * Finalizar repostaje espontaneo (to Fuel +)
 * 
 */

PATCH api.servotal.com/refuel/10

{
    "idrefuel": "100",
    "idstation":"1"',
    "idstatus":"4",
    "ALBARAN"
}

/**
 * Finalizar repostaje
 * 
 */

POST api.servotal.com/transaction

{
    "idrefuel": "100",
    "id_transaction":"10",
    "idstatus":"5",
    "ALBARAN"
}

RESULT
{
    "idrefuel": "100",
    "id_transaction":"10",
    "idstatus":"5",
    "ALBARAN"   //?
}




/**
 * Albaran
 * 
 * Fuel+ indica el n�mero de operaci�n sobre el cual se quiere obtener el albar�n. 
 * Se podr� indicar tanto el c�digo de transacci�n de fuel+ como el de 
 * la estaci�n. Poder consultar una transacci�n en funci�n del identificador 
 * de fuel+ es necesario para controlar la excepci�n en la que se produzca 
 * un error en las comunicaciones una vez iniciado el repostaje pero sin 
 * confirmaci�n por parte del sistema. El sistema solamente contestar� con 
 * informaci�n sobre los albaranes realizados mediante la plataforma Fuel+. 
 * Informa del albar�n con los datos de cabecera y las l�neas 
 * (habitualmente solamente una) de las operaciones realizadas en esa transacci�n. 
 * Entre los datos de cabecera se incluir� obligatoriamente el c�digo de cliente 
 * (Fuel +), c�digo del centro y datos fiscales. Para cada l�nea de albar�n 
 * debe incluir el identificador de la operaci�n, la fecha y hora, tipo de combustible, 
 * unidad de medida, n�mero de unidades solicitadas, n�mero de unidades servidas, 
 * surtidor utilizado, manguera utilizada,
 */

GET api.servotal.com/receipts/1
{
    "station_name":"Name",
    "station_nif":"NIF",
    "station_address":"Address",
    "station_phone":"Phone",
    "client_name":"Name",
    "client_nif":"NIF",
    "client_address":"Address",
    "client_phone":"Phone",
    "product": "Product 1",
    "commercial_name": "Comemrcial name 1",
    "unit": "lts",
    "price": "10.000",
    "quantity":"45"     // en lts o en price?   
}

/**
 * Factura
 * 
 * Fuel+ indica el n�mero o n�meros de albar�n sobre el cual se quiere 
 * obtener la factura. El sistema Informa de la factura con los 
 * datos de cabecera de la factura, todos los albaranes y las 
 * l�neas (habitualmente solamente una) de las operaciones 
 * realizadas en esa transacci�n. La informaci�n suministrada ser� la 
 * misma que en el caso de la l�nea de albar�n. Se generar� factura
 * simplificada siempre que se haya informado del NIF del cliente al 
 * Iniciar Repostaje.
 */

GET api.servotal.com/invoices
{
    "id_transaction":"1",
    "id_transaction":"2",   
}

RESULT
GET api.servotal.com/receipts/1
{
    "_embedded": {
        "receipts": [
            {
                "id_transaction":"1",
                "station_name":"Name",
                "station_nif":"NIF",
                "station_address":"Address",
                "station_phone":"Phone",
                "client_name":"Name",
                "client_nif":"NIF",
                "client_address":"Address",
                "client_phone":"Phone",
                "product": "Product 1",
                "commercial_name": "Comemrcial name 1",
                "unit": "lts",
                "price": "10.000",
                "quantity":"45"     // en lts o en price?
            },
            {
                "id_transaction":"2",
                "station_name":"Name",
                "station_nif":"NIF",
                "station_address":"Address",
                "station_phone":"Phone",
                "client_name":"Name",
                "client_nif":"NIF",
                "client_address":"Address",
                "client_phone":"Phone",
                "product": "Product 1",
                "commercial_name": "Comemrcial name 1",
                "unit": "lts",
                "price": "10.000",
                "quantity":"45"     // en lts o en price?
            }            
        ]
    }    
}


/**
 * Informar Comisi�n operaci�n
 * Informar Comisi�n alta
 * 
 * Fuel+ Indicar� a la estaci�n cual es la comisi�n que se 
 * aplicar� a Fuel+ por las operativas realizadas a trav�s 
 * de su plataforma. Ser� un porcentaje utilizando 3 decimales. 
 * La tarifa tendr� un periodo de tiempo de vigencia con una fecha 
 * inicio y otra de fin. En el caso de que la fecha de fin no est� 
 * informada se considerar� sin caducidad. En caso de conflicto de 
 * periodo con comisiones anteriormente definidas prevalecer� la �ltima 
 * informada.
 */

POST api.servotal.com/commisions
{
    "commision_type":"1",
    "commision_unit":"percentage|price",
    "commision_value":"2",
    "start_date":"DATE",
    "end_date":"DATE"
}



/**
 * Registro Cliente
 * 
 */

POST api.servotal.com/clients
{
    "id_statione":"Name",
    "client_name":"Name",
    "client_nif":"NIF",
    "client_address":"Address",
    "client_phone":"Phone",
    "_embedded": {
        "loyalty_programs": [
            {
                "id_program":"1"
                "name":"Extra Discount",
                "discount":"10%",
            },
            {
                "id_program":"2"
                "name":"Super Discount",
                "discount":"20%",
            },        
        ]
    }  
}