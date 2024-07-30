from pyais.encode import encode_dict
import sys

def encodeAIS(a, b, c, d):

    data = {
        'course': a,
        'lat': b,
        'lon': c,
        'mmsi': d,
        'type': 1,
    }
    encoded = encode_dict(data, radio_channel="B", talker_id="AIVDM")[0]
    print(encoded, end = "")

if __name__== "__main__":
    encodeAIS(float(sys.argv[1]), float(sys.argv[2]), float(sys.argv[3]), (sys.argv[4]))

