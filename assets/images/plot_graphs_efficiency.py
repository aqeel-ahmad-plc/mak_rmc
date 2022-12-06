
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
from scipy.interpolate import make_interp_spline
import time
import json

# Opening JSON file
f = open('C:/wamp64/www/mak_rmc/assets/images/efficiency_data.json')
hitachi = []
test_curve = []
min_allowed = []
x = [0, 10, 20, 30, 40, 50, 60]

# returns JSON object as
# a dictionary
while True:
    data = json.load(f)

    iterator = 0;
    for i in data['Hitachi_Curve']:
        hitachi.insert(iterator, data['Hitachi_Curve'][i])
        iterator = iterator + 1
    iterator = 0;
    for i in data['Test_Curve']:
        test_curve.insert(iterator, data['Test_Curve'][i])
        iterator = iterator + 1
    iterator = 0;
    for i in data['Min_Allowed']:
        min_allowed.insert(iterator, data['Min_Allowed'][i])
        iterator = iterator + 1

    X_Y_Spline = make_interp_spline(x, hitachi)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label="Hitachi Curve")

    X_Y_Spline = make_interp_spline(x, test_curve)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label="Test Curve")


    X_Y_Spline = make_interp_spline(x, min_allowed)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label="Min Allowed")

#plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
#plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)
    plt.axvline(x = 7, color = 'g', label = 'F.L.', linewidth=2)
    plt.xlabel("Shaft Power (P2), in kW")
    plt.ylabel("Measured Efficiency, in %")
    plt.grid(True)
# plt.grid()
    plt.legend(loc="lower right")
# plt.show()

    plt.savefig('C:/wamp64/www/mak_rmc/assets/images/efficiency_graph.png')
    time.sleep(2);
