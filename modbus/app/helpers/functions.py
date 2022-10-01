from pyModbusTCP.client import ModbusClient
from pymodbus.client.sync import ModbusSerialClient as ModbusRTUClient
from pymodbus.payload import BinaryPayloadDecoder
from pymodbus.constants import Endian
# from pymodbus.client.sync import ModbusSerialClient as ModbusRTUClient
import time
import os
import json
import datetime



def Merge(dict1, dict2):
    return(dict2.update(dict1))

def readHolding(client, start_add, count_reg):
    data = {}

    iterator = 0
    result=client.read_holding_registers(int(start_add),int(count_reg))
    print(result, start_add, count_reg)
    while(result ==  None):
        result=client.read_holding_registers(int(start_add),int(count_reg))
        print(result, start_add, count_reg)
        time.sleep(0.5)
    if (result != None):
        for x in range(start_add, start_add+count_reg):
            data[x] = result[iterator]
            iterator = iterator + 1
    return data


def readInputRegisters(client, start_add, count_reg):
    data = {}

    iterator = 0
    result=client.read_input_registers(int(start_add),int(count_reg))
    print(result, start_add, count_reg)

    while(result ==  None):
        result=client.read_input_registers(int(start_add),int(count_reg))
        print(result, start_add, count_reg)
        time.sleep(0.5)
    if (result != None):
        for x in range(start_add, start_add+count_reg):
            data[x] = result[iterator]
            iterator = iterator + 1
    return data


def readInputRTU(client, start_add, count_reg, unit_id):
    data = {}
    flag = 0
    result = []

    iterator = 0
    read=client.read_input_registers(address = int(start_add),count =int(count_reg), unit=int(unit_id))

    while(flag ==  0):
        read=client.read_input_registers(address = int(start_add),count =int(count_reg), unit=int(unit_id))
        try:
            result = read.registers
            flag = 1
        except Exception as e:
            flag = 0
        time.sleep(0.5)

    for x in range(start_add, start_add+count_reg):
        data[x] = result[iterator]
        iterator = iterator + 1
    return data

def format_hex (reg_value):
    hex_value = hex (reg_value)
    hex_value = hex_value.replace('0x', '')
    hex_value = hex_value.zfill(4)
    return hex_value

def twos_comp(val, bits):
    """compute the 2's complement of int value val"""
    if (val & (1 << (bits - 1))) != 0: # if sign bit is set e.g., 8bit: 128-255
        val = val - (1 << bits)        # compute negative value
    return val




def parseData(data, file_name):
    parameters_data_list = []

    f = open(file_name)
    parameters_data = json.load(f)
    for element in parameters_data:
        parameters_data_dict = {}
        parameters_data_dict['register_address'] = element['register_address']
        parameters_data_dict['display_point'] = element['display_point']
        parameters_data_dict['alias'] = element['alias']
        if (element['data_type'] == 'integer'):
            parameters_data_dict['value'] = data[element['register_address']] * element['multiplier']
        elif(element['data_type'] == 'signedint'):
            reg1_hex = format_hex (data[element['register_address']])
            reg2_hex = format_hex (data[element['register_address']+1])
            hex_val = reg1_hex + reg2_hex
            parameter_value = twos_comp(int(hex_val,16), 16)
            parameters_data_dict['value'] = parameter_value * element['multiplier']
        elif(element['data_type'] == '32bit_int'):
            result=[data[element['register_address']],data[element['register_address']+1]]
            decoder = BinaryPayloadDecoder.fromRegisters(result, Endian.Big, wordorder=Endian.Big)
            parameter_value=decoder.decode_32bit_int()
            parameters_data_dict['value'] = parameter_value * element['multiplier']
        parameters_data_dict['col_name'] = element['col_name']

        parameters_data_list.append(parameters_data_dict)
        #redisClient.hset("hardware-1",  element['display_point'], str(parameters_data_dict))
    return parameters_data_list
    f.close()
def connectModbusTCP(IP, port, unit_id):
    client = ModbusClient(host=IP, port=int(port), unit_id=int(unit_id))
    client.open()
    return client

def connectModbusRTU(baud_rate, comm_port):
    client = ModbusRTUClient(method='rtu', port=comm_port, baudrate=int(baud_rate), timeout=0.5)
    client.connect()
    read=client.read_input_registers(address = 1000,count =1, unit=1)
    for i in range(0,5):
        try:
            return client
        except Exception as e:
            print("Error")
    return False
