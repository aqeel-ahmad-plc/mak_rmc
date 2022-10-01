
from helpers.functions import *
import datetime
import requests
url = 'http://localhost/mak_rmc/stats/create'

while 1:
    client = connectModbusTCP("10.10.100.254", 8899, 1)
    if(client != None):
        x={}
        # data1 = readHolding(client, 1, 10)
        # data2 = readHolding(client, 11, 10)
        # Merge(data1, data2)
        # data1 = readHolding(client, 21, 10)
        # Merge(data1, data2)
        # data1 = readHolding(client, 31, 10)
        # Merge(data1, data2)
        # data1 = readHolding(client, 41, 10)
        # Merge(data1, data2)
        # data1 = readHolding(client, 51, 10)
        # Merge(data1, data2)

        # data2 = readHolding(client, 1, 100)
        data2 = readHolding(client, 1, 100)
        print(data2)
        result = parseData(data2, 'config/energy_meter/parameters_config.json')
        for param in result:
            x[param['col_name']] = param['value']
        x['sysdt'] = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        print(x)
        ret = requests.post(url, data = x)
        result = json.loads(ret.text)
        if((result["status"]) == 200):
            print("Data saved successfully")
        else:
            print("Error occurred in saving to db")

    time.sleep(1)
client.close()
