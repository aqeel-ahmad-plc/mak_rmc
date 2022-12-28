#!/usr/bin/python
# -*- coding: utf-8 -*-
import time
import serial
import requests
import json
import struct
url = 'http://localhost/mak_rmc/torque/create'

# configure the serial connections (the parameters differs on the device you are connecting to)

ser = serial.Serial(
    port='COM9',
    baudrate=9600,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS,
    timeout=2,
    )
ser.close()


def ReadData():
    ser.open()
    cw = [0x23, 0x30, 0x30, 0x0d]
    ser.write(serial.to_bytes(cw))
    time.sleep(0.001)
    data = ser.read(20)
    if len(data) == 0:
        ser.close()
        return -1
    ser.close()
    torque = float(data[1:8]) * 200
    return torque


while 1:
    x = {}

    # print((data.decode("utf-8")))
    average_torque = 0
    start_time = time.time()
    for i in range(0,10):
        torque = ReadData()
        average_torque = average_torque + torque
        time.sleep(0.05)
    average_torque = average_torque/10
    x['torque'] = average_torque
    print('--- %s seconds ---' % (time.time() - start_time))
    print(x)

    ret = requests.post(url, data = x)
    result = json.loads(ret.text)
    print(result)
    if((result["status"]) == 200):
        print("Data saved successfully")
    else:
        print("Error occurred in saving to db")
