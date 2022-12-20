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
	timeout=2
)
ser.close()


while 1 :
    ser.open()
    x = {}
    #ser.write(bytes(b'05010000000006AA'))
    cw = [0x23,0x30,0x30,0x0d]
    ser.write(serial.to_bytes(cw))
    print("write command")
    print("reading the data")
    time.sleep(0.001)
    print("After delay")
    data = ser.read(20)
    if len(data) == 0:
        print("data is none")
        time.sleep(5)
        ser.close()
        continue
    print((data.decode("utf-8")))
    torque = float(data[1:8]) * 200;
    print(torque)
    #
    x['torque'] = torque
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
    #
    #     # for line in ser.read():
    #     #     print("line", line)
    # # except:
    # #     print("Keyboard Interrupt")
    #     break
    ser.close()
    time.sleep(0.002)


    print("====================================")
