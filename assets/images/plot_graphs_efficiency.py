#!/usr/bin/python
# -*- coding: utf-8 -*-

import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
from scipy.interpolate import make_interp_spline
import time
import json
import os

# Opening JSON file

def efficiency_graph():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    ax.margins(x=0, y=0)
    f = open('C:/wamp64/www/mak_rmc/assets/images/efficiency_data.json')
    hitachi = []
    test_curve = []
    min_allowed = []
    x = []
    data = json.load(f)

    iterator = 0
    for i in data['Shaft_Power']:
        x.insert(iterator, float(data['Shaft_Power'][i]))
        iterator = iterator + 1
    #print("Shaft_Power_efficiency", x)
    plt.axvline(x = float(data['FL']), ymin = 0, ymax = 1,color ='blue')

    iterator = 0
    for i in data['Hitachi_Curve']:
        hitachi.insert(iterator, data['Hitachi_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Test_Curve']:
        test_curve.insert(iterator, data['Test_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Min_Allowed']:
        min_allowed.insert(iterator, data['Min_Allowed'][i])
        iterator = iterator + 1

    X_Y_Spline = make_interp_spline(x, hitachi, k=5)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve, k=5)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Test Curve')

    X_Y_Spline = make_interp_spline(x, min_allowed, k=5)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Min Allowed')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)


    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('Measured Efficiency, in %')
    plt.grid(True)


    major_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))
    minor_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))

    ax.set_xticks(major_ticks)
    #ax.set_xticks(minor_ticks, minor=True)
    ax.set_yticks(np.arange(0, 100, 5))
    #ax.set_yticks(np.arange(0, 300, 5), minor=True)

    # And a corresponding grid
    ax.grid(which='both')

    # Or if you want different settings for the grids:
    #ax.grid(which='minor', alpha=0.2)
    ax.grid(which='major', alpha=0.5)


    # plt.grid()
    plt.legend(loc='upper center', bbox_to_anchor=(0.5, 1.1),
          fancybox=True, shadow=True, ncol=5)

    # plt.show()
    #os.remove('C:/wamp64/www/mak_rmc/assets/images/efficiency_graph.png')

    plt.savefig('C:/wamp64/www/mak_rmc/assets/images/efficiency_graph.png'
                )
    plt.close()

def speed_graph():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    ax.margins(x=0, y=0)
    f = open('C:/wamp64/www/mak_rmc/assets/images/speed_data.json')
    hitachi = []
    test_curve = []
    min_allowed = []
    max_allowed = []
    x = []
    data = json.load(f)

    iterator = 0
    for i in data['Shaft_Power']:
        x.insert(iterator, float(data['Shaft_Power'][i]))
        iterator = iterator + 1
    #print("Shaft_Power_speed", x)
    iterator = 0
    for i in data['Hitachi_Curve']:
        hitachi.insert(iterator, data['Hitachi_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Test_Curve']:
        test_curve.insert(iterator, data['Test_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Min_Allowed']:
        min_allowed.insert(iterator, float(data['Min_Allowed'][i]))
        iterator = iterator + 1
    iterator = 0
    for i in data['Max_Allowed']:
        max_allowed.insert(iterator, float(data['Max_Allowed'][i]))
        iterator = iterator + 1

    X_Y_Spline = make_interp_spline(x, hitachi, k=5)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve, k=5)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Test Curve')

    X_Y_Spline = make_interp_spline(x, min_allowed, k=5)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Min Allowed')

    X_Y_Spline = make_interp_spline(x, max_allowed, k=5)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Max Allowed')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)
    #plt.axvline(x=0, color='g', label='F.L.', linewidth=2)
    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('Speed, in RPM')
    plt.grid(True)



    major_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))
    minor_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))

    ax.set_xticks(major_ticks)
    low_y_axis__point = int(min(test_curve)-20)
    high_y_axis__point = int(max(test_curve)+20)

    #plt.plot([data['FL'], 0], [data['FL'], high_y_axis__point], 'bo', linestyle="-")
    number_of_points_major = int((high_y_axis__point - low_y_axis__point)/10)
    number_of_points_minor = int((high_y_axis__point - low_y_axis__point)/20)
    # print("number_of_points_major", number_of_points_major)
    # print("number_of_points_minor", number_of_points_minor)
    ax.set_yticks(np.arange(low_y_axis__point, high_y_axis__point, number_of_points_major), minor=False)
    ax.set_yticks(np.arange(low_y_axis__point, high_y_axis__point, number_of_points_minor), minor=True)
    #ax.set_yticks(np.arange(0, 300, 5), minor=True)

    # And a corresponding grid
    plt.axvline(x = float(data['FL']), ymin = 0, ymax = 1,color ='blue')
    ax.grid(which='both')

    # Or if you want different settings for the grids:
    #ax.grid(which='minor', alpha=0.2)
    ax.grid(which='major', alpha=0.5)



    # plt.grid()
    plt.legend(loc='upper center', bbox_to_anchor=(0.5, 1.2),
          fancybox=True, shadow=True, ncol=5)
    plt.tight_layout()

    # plt.show()
    #os.remove('C:/wamp64/www/mak_rmc/assets/images/speed_graph.png')

    plt.savefig('C:/wamp64/www/mak_rmc/assets/images/speed_graph.png'
                )
    plt.close()

def current_graph():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    ax.margins(x=0, y=0)
    f = open('C:/wamp64/www/mak_rmc/assets/images/current_data.json')
    hitachi = []
    test_curve = []
    min_allowed = []
    max_allowed = []
    x = []
    data = json.load(f)

    iterator = 0
    for i in data['Shaft_Power']:
        x.insert(iterator, float(data['Shaft_Power'][i]))
        iterator = iterator + 1
    #print("Shaft_Power_current", x)
    iterator = 0
    for i in data['Hitachi_Curve']:
        hitachi.insert(iterator, data['Hitachi_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Test_Curve']:
        test_curve.insert(iterator, data['Test_Curve'][i])
        iterator = iterator + 1

    X_Y_Spline = make_interp_spline(x, hitachi, k=5)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve, k=5)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Test Curve')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)

    plt.axvline(x = float(data['FL']), ymin = 0, ymax = 1,color ='blue')
    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('Current, in Amps')
    plt.grid(True)

    major_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))
    minor_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))

    ax.set_xticks(major_ticks)
    #ax.set_xticks(minor_ticks, minor=True)
    y_axis_highest_limit = float(max(hitachi))
    y_axis_highest_limit = (y_axis_highest_limit*1.5)
    ax.set_yticks(np.arange(0,y_axis_highest_limit, 5))
    #ax.set_yticks(np.arange(0, 300, 5), minor=True)

    # And a corresponding grid
    ax.grid(which='both')

    # Or if you want different settings for the grids:
    #ax.grid(which='minor', alpha=0.2)
    ax.grid(which='major', alpha=0.5)



    # plt.grid()
    plt.legend(loc='upper center', bbox_to_anchor=(0.5, 1.1),
          fancybox=True, shadow=True, ncol=5)

    # plt.show()
    #os.remove('C:/wamp64/www/mak_rmc/assets/images/speed_graph.png')

    plt.savefig('C:/wamp64/www/mak_rmc/assets/images/current_graph.png'
                )
    plt.close()


def cos_graph():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    ax.margins(x=0, y=0)
    f = open('C:/wamp64/www/mak_rmc/assets/images/cos_data.json')
    hitachi = []
    test_curve = []
    min_allowed = []
    x = []
    data = json.load(f)

    iterator = 0
    for i in data['Shaft_Power']:
        x.insert(iterator, float(data['Shaft_Power'][i]))
        iterator = iterator + 1
    #print("Shaft_Power_cos", x)
    iterator = 0
    for i in data['Hitachi_Curve']:
        hitachi.insert(iterator, data['Hitachi_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Test_Curve']:
        test_curve.insert(iterator, data['Test_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Min_Allowed']:
        min_allowed.insert(iterator, data['Min_Allowed'][i])
        iterator = iterator + 1

    X_Y_Spline = make_interp_spline(x, hitachi, k=5)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve, k=5)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Test Curve')

    X_Y_Spline = make_interp_spline(x, min_allowed, k=5)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Min Allowed')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)

    plt.axvline(x = float(data['FL']), ymin = 0, ymax = 1,color ='blue')
    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('CosØ , in %')
    plt.grid(True)

    major_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))
    minor_ticks = np.arange(0, int(float(data['FL'])*1.5), int((float(data['FL'])*1.5)/6))

    ax.set_xticks(major_ticks)
    #ax.set_xticks(minor_ticks, minor=True)
    ax.set_yticks(np.arange(0, 100, 5))
    #ax.set_yticks(np.arange(0, 300, 5), minor=True)

    # And a corresponding grid
    ax.grid(which='both')

    # Or if you want different settings for the grids:
    #ax.grid(which='minor', alpha=0.2)
    ax.grid(which='major', alpha=0.5)



    # plt.grid()
    plt.legend(loc='upper center', bbox_to_anchor=(0.5, 1.1),
          fancybox=True, shadow=True, ncol=5)

    # plt.show()
    #os.remove('C:/wamp64/www/mak_rmc/assets/images/speed_graph.png')

    plt.savefig('C:/wamp64/www/mak_rmc/assets/images/cos_graph.png'
                )
    plt.close()


# returns JSON object as
# a dictionary

while True:
    #start_time = time.time()
    efficiency_graph()
    speed_graph()
    current_graph()
    cos_graph()
    time.sleep(2)
    #print("--- %s seconds ---" % (time.time() - start_time))
