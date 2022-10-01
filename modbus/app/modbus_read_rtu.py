
from helpers.functions import *
import requests
url = 'http://localhost/inventory/temperature/create'

while 1:
    client = connectModbusRTU(9600, 'COM7')
    if(client != False):
        x={}
        data = readInputRTU(client, 1000, 1, 1)
        result = parseData(data, 'config/temp_sensor/parameters_config.json')
        x['amb_temperature'] = result[0]['value']

        data = readInputRTU(client, 1000, 1, 2)
        result = parseData(data, 'config/temp_sensor/parameters_config.json')
        x['motor_temperature'] = result[0]['value']
        print(x)
        # for param in result:
        #     x[param['col_name']] = param['value']
        ret = requests.post(url, data = x)
        result = json.loads(ret.text)
        print(result)
        if((result["status"]) == 200):
            print("Data saved successfully")
        else:
            print("Error occurred in saving to db")


    time.sleep(0.5)
    client.close()
