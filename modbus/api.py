import socket
import time
import json
import datetime
import requests
url = 'http://localhost/inventory/stats/create'

x = {'voltage_a': 53.3, 'voltage_b': 11.5, 'voltage_c': 53.4, 'voltage_ab': 11, 'voltage_bc': 28, 'voltage_ca': 218, 'current_a': 12.0, 'current_b': 10.0, 'current_c': 53.3, 'pf_a': 2, 'pf_b': 4, 'pf_c': 3.03, 'power_a': 1.5, 'power_b': 1.5, 'power_c': 100, 'frequency': 60}
x = requests.post(url, data = x)
    #print(x.text)
result = json.loads(x.text)
if((result["messages"]["status"]) == 200):
    print("Data saved successfully")
else:
    print("Error occurred in saving to db")
