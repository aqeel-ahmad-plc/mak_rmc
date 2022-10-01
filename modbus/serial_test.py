import time
import serial
import requests
import json
import struct
url = 'http://localhost/inventory/rpm/create'
# configure the serial connections (the parameters differs on the device you are connecting to)
ser = serial.Serial(
	port='COM8',
	baudrate=9600,
	parity=serial.PARITY_NONE,
	stopbits=serial.STOPBITS_ONE,
	bytesize=serial.EIGHTBITS
)
ser.close()


while 1 :
    ser.open()
    x = {}
    #ser.write(bytes(b'05010000000006AA'))
    cw = [0x05,0x01,0x00,0x00,0x00,0x00,0x06,0xAA]
    ser.write(serial.to_bytes(cw))
    print("write command")

    #print(ser.readlines())
    #try:
    print("reading the data")
    time.sleep(1)
    print("After delay")
    data = ser.read(14)
    print(data)
    print((data.decode("utf-8")))
    #reverse_data = data[::-1]
    #print(reverse_data)
    rpm = float(data[9:13])

    x['rpm'] = rpm
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

        # for line in ser.read():
        #     print("line", line)
    # except:
    #     print("Keyboard Interrupt")
        break
    ser.close()
    time.sleep(2)


    print("====================================")
