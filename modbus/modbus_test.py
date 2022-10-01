## TCP

from pyModbusTCP.client import ModbusClient
import time
import os
import json
import datetime
IP = "10.10.100.254"
PORT = 8899

count = 2
start_add = 49
slave_id = 1
iter = 0
while 1:
    client = ModbusClient(host=IP, port=PORT, unit_id=1)
    client.open()
    iter = iter + 1
    result=client.read_input_registers(int(start_add),int(count))
    print(result)
    time.sleep(2)
    client.close()


## rtu
#
# from pymodbus.client.sync import ModbusSerialClient as ModbusClient
# import time
#
# client = ModbusClient(method='rtu', port='COM7', baudrate=9600, timeout=0.5)
#
# client.connect()
# print(client)
# while 1:
#     read=client.read_input_registers(address = 1000,
#                                      count =1,
#                                      unit=1)
#
#
#     try:
#         print(read.registers)
#     except Exception as e:
#         print("Error")
#
#     # if read.isError():
#     #     print("Error reading")
#     # else:
#     #     print(read.registers)
#     time.sleep(1)
