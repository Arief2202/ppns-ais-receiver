from pyais import decode
import sys
import json

def decodeAIS(a):
    decoded = decode(a)
    x = {
      "course": decoded.course,
      "lat": decoded.lat,
      "lon": decoded.lon,
      "mmsi": decoded.mmsi,
      "type": decoded.msg_type
    }
    x = json.dumps(x)
    print(x)

if __name__== "__main__":
    decodeAIS((sys.argv[1]))
