#!/usr/bin/python
# -*- coding: utf-8 -*-
import time
import serial
import requests
import json
import struct
from tkinter import *

url = 'http://localhost/mak_rmc/torque/create'



# configure the serial connections (the parameters differs on the device you are connecting to)
average_torque = 0

ser = serial.Serial(
    port='COM9',
    baudrate=9600,
    parity=serial.PARITY_NONE,
    stopbits=serial.STOPBITS_ONE,
    bytesize=serial.EIGHTBITS,
    timeout=0.15
    #inter_byte_timeout=0.100
    )
ser.close()

#ser.open()

def ReadData():
    ser.open()
    ser.flushInput()
    ser.flushOutput()
    data = {}
    cw = [0x23, 0x30, 0x30, 0x30, 0x0d]
    ser.write(serial.to_bytes(cw))
    #time.sleep(0.200)
    #data = ser.read(58)
    #ser.read_until (terminator='>', size=100)
    data = ser.read_until (terminator='\r', size=100)
    if len(data) == 0:
        ser.close()
        return -1
    ser.close()
    #print (len(data))
    #print (data)
    #torque = data[1:8]
    #float(data[1:8]) * 200
    #print(torque)
    #print (round(float(data[1:9]),3)*200)
    return round(float(data[1:9])*200/0.998,2)

average_torque = 0

## Code added by Umer to diplay on the windows screen as a combobox widget.
#DisplayWindow = Tk()
#DisplayWindow.after(1,ReadData())
#DisplayWindow.mainloop()
##

while 1:
    x = {}

    # print((data.decode("utf-8")))
    #average_torque = 0
    #start_time = time.time()
    #for i in range(0,2):
        #torque = ReadData()
        #average_torque = average_torque + torque
        #time.sleep(0.05)
    #average_torque = round (average_torque/10,3)*200
    average_torque = ReadData()
    print("%.3f" % average_torque, " Nm" , end="\r")
    x['torque'] = average_torque
    # print('--- %s seconds ---' % (time.time() - start_time))
    print(x)
    #
    # ret = requests.post(url, data = x)
    # result = json.loads(ret.text)
    # print(result)
    # if((result["status"]) == 200):
    #     print("Data saved successfully")
    # else:
    #     print("Error occurred in saving to db")
