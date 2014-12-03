<?php

/** 
 * Header
 
 * Aplica para llamadas a: api.alvic.com y api.fuelplus.com
 * 
 * Ha de contener la firma de cada request.
 * Trabaja con una pareja de llave publica y privada
 * La llave publica se envia como identificador en el request
 * y la privada se usa para cifrar el mensaje que se envia como 
 * firma en el request. 
 * Authentication: <Prefix> <PublicKey>:<Signature>
 */

GET /stations/1 HTTP/1.1
Host: api.alvic.com
Authentication: <Prefix> <PublicKey>:<Signature>
Cache-Control: no-cache

/**
 * Combustibles y Precio
 *
 * Fuel + solicita al sistema el listado de combustibles disponibles
 * en su estaci�n con el precio por litro de cada uno de los combustibles.
 * Se indicará el código identificativo de la estaci�n de servicio.
 * Para cada combustible se indicará el producto, marca comercial (si procede),
 * unidad de medida, precio en euros con 3 decimales por unidad de medida.
 *
 */

// GET api.alvic.com/stations/<idstation>
GET api.alvic.com/stations/1

{
    "_links": {
        "self": {
        "href": "http://api.alvic.com/stations/1"
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
 * Se indicará el código identificativo de la estaci�n de servicio.
 * El sistema responderá con un listado con la siguiente información;
 * Código de identificación de manguera, surtidor, producto, marca comercial,
 * unidad de medida, precio en euros por unidad de medida con 3 decimales y
 * el estado de cada uno de los surtidores.
 */

// GET api.alvic.com/pumps?station=<idstation>
GET api.alvic.com/pumps?station=1

{
    "_links": {
        "self": {
        "href": "http://api.alvic.com/pumps?station=1"
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
                    "href": "http://api.alvic.com/pumps/2"
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
 * el sistema informará si está operativo y en tal caso se indicará 
 * si está en uno de los posibles estados: en uso, bloqueado, 
 * desbloqueado para repostar sin límite, desbloqueado para una cantidad 
 * de euros (se informar� la cantidad de euros), desbloqueado para 
 * una cantidad de litros (se indicará la cantidad de litros). 
 * En uso y litros consumidos. Al mismo tiempo se incluirá información 
 * de si la manguera se encuentra colgada o descolgada.
 */


// GET api.alvic.com/pumps?station=<idstation>&pump=<idpump>
GET api.alvic.com/pumps?station=1&pump=1

{
    "idpump": "1",
    "fuel_station_idstation": "1",
    "fuel_pump_statuses_idpumpstatus": "1",
    "fuel_pump_payment_type": "1",
    "fuel_pump_payment_available_units": "10",
    "fuel_pump_payment_available_price": "10.000",
    
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
 * Fuel+ indicará el código de transacción de Fuel+, 
 * el cliente (código numérico de fuel+) y código de cliente 
 * de la estación si existiera, también informará de las 
 * promociones aplicables en función de las campañas de 
 * fidelización a las que está adscrito el cliente y la matr�cula 
 * del vehículo. Siempre se incluirá el NIF del cliente
 */

// POST api.alvic.com/startrefuel
POST api.alvic.com/startrefuel

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
    "loyalty_program":1,
    "discount":"10%"
}
        
RESULT OK
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
    "result":"OK"
}
RESULT KO
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
    "result":"KO",
    "iderror":1,
    "message":"Mensaje de ERROR"
}


/**
 * Descolgar manguera (to Fuel +)
 * 
 * <id_transaction>: identificador de la transaccion Sistema
 * <idrefuel>: identificador de la transaccion Fuel +
 * 
 */

//PATCH api.fuelplus.com/lifthose/<idtransaction>
PATCH api.fuelplus.com/lifthose/10

{
    "idrefuel": "100",
    "idstation":"1",
    "idstatus":"1"
}

/**
 * Iniciar repostaje (to Fuel +)
 * 
 * <id_transaction>: identificador de la transaccion Sistema
 * <idrefuel>: identificador de la transaccion Fuel +
 * 
 */

//PATCH api.fuelplus.com/startrefuel/<idtransaction>
PATCH api.fuelplus.com/startrefuel/10

{
    "idrefuel": "100",
    "idstation":"1",
    "idstatus":"2"
}

/**
 * Colgar manguera (to Fuel +)
 * 
 * <id_transaction>: identificador de la transaccion Sistema
 * <idrefuel>: identificador de la transaccion Fuel +  
 * 
 */

// PATCH api.fuelplus.com/hanghose/<idtransaction>
PATCH api.fuelplus.com/hanghose/10

{
    "idrefuel": "100",
    "idstation":"1",
    "idstatus":"3",
    "quantity":"28" // informa en units o en price?
}


/**
 * Finalizar repostaje espontaneo (to Fuel +)
 * 
 * <id_transaction>: identificador de la transaccion Sistema
 * <idrefuel>: identificador de la transaccion Fuel + 
 *  
 */

// PATCH api.fuelplus.com/haltrefuel/<idtransaction>
PATCH api.fuelplus.com/haltrefuel/10

{
    "idrefuel": "100",
    "idstation":"1"',
    "idstatus":"4",
    "ALBARAN"
}

/**
 * Finalizar repostaje.
 * 
 * <id_transaction>: identificador de la transaccion Sistema
 * <idrefuel>: identificador de la transaccion Fuel + 
 * 
 */

// POST api.alvic.com/stoprefuel/<idtransaction>
POST api.alvic.com/stoprefuel

{
    "idrefuel": "100",
    "id_transaction":"10",
    "idstatus":"5",
}

RESULT
{
    "idrefuel": "100",
    "id_transaction":"10",
    "idstatus":"5",
    "ALBARAN"   
}




/**
 * Albaran
 * 
 * Fuel+ indica el número de operación sobre el cual se quiere obtener el albar�n. 
 * Se podr� indicar tanto el código de transacción de fuel+ como el de 
 * la estaci�n. Poder consultar una transacción en función del identificador 
 * de fuel+ es necesario para controlar la excepción en la que se produzca 
 * un error en las comunicaciones una vez iniciado el repostaje pero sin 
 * confirmaci�n por parte del sistema. El sistema solamente contestará con 
 * informaci�n sobre los albaranes realizados mediante la plataforma Fuel+. 
 * Informa del albarán con los datos de cabecera y las líneas 
 * (habitualmente solamente una) de las operaciones realizadas en esa transacci�n. 
 * Entre los datos de cabecera se incluirá obligatoriamente el código de cliente 
 * (Fuel +), código del centro y datos fiscales. Para cada línea de albarán 
 * debe incluir el identificador de la operación, la fecha y hora, tipo de combustible, 
 * unidad de medida, número de unidades solicitadas, número de unidades servidas, 
 * surtidor utilizado, manguera utilizada,
 */

GET api.alvic.com/receipts/1
{
    "station_name":"Name",
    "station_nif":"NIF",
    "station_address":"Address",
    "station_phone":"Phone",
    "client_nif":"NIF",
    "product": "Product 1",
    "commercial_name": "Commercial name 1",
    "unit":"lts",
    "price":"10.000",
    "price_iva":"1.00",
    "price_total":"11.000",
    "quantity":"45.000",
    "loyalty_program":1,
    "base":"45.983",
    "iva":"4.598",
    "total":"50.581"
}

/**
 * Factura
 * 
 * Fuel+ indica el nú�mero o n�meros de albarán sobre el cual se quiere 
 * obtener la factura. El sistema Informa de la factura con los 
 * datos de cabecera de la factura, todos los albaranes y las 
 * líneas (habitualmente solamente una) de las operaciones 
 * realizadas en esa transacción. La información suministrada será la 
 * misma que en el caso de la línea de albarán. Se generará factura
 * simplificada siempre que se haya informado del NIF del cliente al 
 * Iniciar Repostaje.
 */

GET api.alvic.com/invoices
{
    "id_transaction":"1",
    "id_refuel":"10",
    "id_transaction":"2",   
    "id_refuel":"20",
}

RESULT
{
    "station_name":"Name",
    "station_nif":"NIF",
    "station_address":"Address",
    "station_phone":"Phone",
    "client_name":"Name",
    "client_nif":"NIF",
    "client_address":"Address",
    "client_phone":"Phone",
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
                "commercial_name": "Commercial name 1",
                "unit":"lts",
                "price":"10.000",
                "price_iva":"1.00",
                "price_total":"11.000",
                "quantity":"45.000",
                "loyalty_program":1,
                "base":"45.983",
                "iva":"4.598",
                "total":"50.581"                       
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
                "unit":"lts",
                "price":"10.000",
                "price_iva":"1.00",
                "price_total":"11.000",
                "quantity":"45.000",
                "loyalty_program":1,
                "base":"45.983",
                "iva":"4.598",
                "total":"50.581"     
            }            
        ]
    }    
}


/**
 * Informar Comisión operación
 * 
 * Fuel+ Indicará a la estaci�n cual es la comisión que se 
 * aplicará a Fuel+ por las operativas realizadas a través 
 * de su plataforma. Será un porcentaje utilizando 3 decimales. 
 * La tarifa tendrá un periodo de tiempo de vigencia con una fecha 
 * inicio y otra de fin. En el caso de que la fecha de fin no está 
 * informada se considerará sin caducidad. En caso de conflicto de 
 * periodo con comisiones anteriormente definidas prevalecerá la última 
 * informada.
 */

POST api.alvic.com/commisionoperation
{
    "commision_type":"1",
    "commision_unit":"percentage",
    "commision_value":"2.456",
    "start_date":"DATE",
    "end_date":"DATE"
}

/**
* Informar Comisión alta
*
* Fuel+ Indicará a la estación cual es la comisión
* que se aplicará a Fuel+ por el alta de un nuevo 
* vehículo o cliente. Este será un precio fijo en € 
* con 2 decimales por matrícula registrada. 
* La tarifa tendrá un periodo de tiempo de 
* vigencia con una fecha inicio y otra de fin. 
* Esta comisión se aplicará por vehículo registrado en caso de 
* flotas.
*/

POST api.alvic.com/commisionsingup
{
    "commision_type":"2",
    "commision_unit":"price",
    "commision_value":"10.00",
    "start_date":"DATE",
    "end_date":"DATE"
}



/**
 * Registro Cliente
 * 
 */

POST api.alvic.com/clients
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