from pymodbus.payload import BinaryPayloadDecoder
from pymodbus.constants import Endian


result=[5,41560]
decoder = BinaryPayloadDecoder.fromRegisters(result, Endian.Big, wordorder=Endian.Big)
parameter_value=decoder.decode_32bit_int()
print(parameter_value)
