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
    x = [
        0,
        10,
        20,
        30,
        40,
        50,
        60,
        ]
    data = json.load(f)

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

    X_Y_Spline = make_interp_spline(x, hitachi)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Test Curve')

    X_Y_Spline = make_interp_spline(x, min_allowed)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Min Allowed')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)

    plt.axvline(x=data['FL'], color='g', label='F.L.', linewidth=2)
    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('Measured Efficiency, in %')
    plt.grid(True)


    major_ticks = np.arange(0, 60, 5)
    minor_ticks = np.arange(0, 60, 5)

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
    plt.legend(bbox_to_anchor = (1.25, 0.6), loc='center right')

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
    x = [
        0,
        10,
        20,
        30,
        40,
        50,
        60,
        ]
    data = json.load(f)

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
    iterator = 0
    for i in data['Max_Allowed']:
        max_allowed.insert(iterator, data['Max_Allowed'][i])
        iterator = iterator + 1

    X_Y_Spline = make_interp_spline(x, hitachi)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve)

    # X_ = np.linspace(min(x), max(x), 500)
    # Y_ = X_Y_Spline(X_)
    # plt.plot(X_, Y_, label='Test Curve')

    X_Y_Spline = make_interp_spline(x, min_allowed)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Min Allowed')

    X_Y_Spline = make_interp_spline(x, max_allowed)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Max Allowed')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)

    plt.axvline(x=data['FL'], color='g', label='F.L.', linewidth=2)
    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('Speed, in RPM')
    plt.grid(True)

    major_ticks = np.arange(0, 60, 5)
    minor_ticks = np.arange(0, 60, 5)

    ax.set_xticks(major_ticks)
    #ax.set_xticks(minor_ticks, minor=True)
    low_y_axis__point = min(max_allowed)-50
    high_y_axis__point = max(max_allowed)+100
    number_of_points_major = int((high_y_axis__point - low_y_axis__point)/50)
    number_of_points_minor = int((high_y_axis__point - low_y_axis__point)/10)
    ax.set_yticks(np.arange(low_y_axis__point, high_y_axis__point, number_of_points_major), minor=False)
    ax.set_yticks(np.arange(low_y_axis__point, high_y_axis__point, number_of_points_minor), minor=True)
    #ax.set_yticks(np.arange(0, 300, 5), minor=True)

    # And a corresponding grid
    ax.grid(which='both')

    # Or if you want different settings for the grids:
    #ax.grid(which='minor', alpha=0.2)
    ax.grid(which='major', alpha=0.5)



    # plt.grid()
    plt.legend(bbox_to_anchor = (1.25, 0.6), loc='center right')

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
    x = [
        0,
        10,
        20,
        30,
        40,
        50,
        60,
        ]
    data = json.load(f)

    iterator = 0
    for i in data['Hitachi_Curve']:
        hitachi.insert(iterator, data['Hitachi_Curve'][i])
        iterator = iterator + 1
    iterator = 0
    for i in data['Test_Curve']:
        test_curve.insert(iterator, data['Test_Curve'][i])
        iterator = iterator + 1

    X_Y_Spline = make_interp_spline(x, hitachi)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve)

    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Test Curve')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)

    plt.axvline(x=data['FL'], color='g', label='F.L.', linewidth=2)
    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('Current, in Amps')
    plt.grid(True)

    major_ticks = np.arange(0, 60, 5)
    minor_ticks = np.arange(0, 60, 5)

    ax.set_xticks(major_ticks)
    #ax.set_xticks(minor_ticks, minor=True)
    ax.set_yticks(np.arange(0, 200, 10))
    #ax.set_yticks(np.arange(0, 300, 5), minor=True)

    # And a corresponding grid
    ax.grid(which='both')

    # Or if you want different settings for the grids:
    #ax.grid(which='minor', alpha=0.2)
    ax.grid(which='major', alpha=0.5)



    # plt.grid()
    plt.legend(bbox_to_anchor = (1.25, 0.6), loc='center right')

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
    x = [
        0,
        10,
        20,
        30,
        40,
        50,
        60,
        ]
    data = json.load(f)

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

    X_Y_Spline = make_interp_spline(x, hitachi)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label=data['Hitachi_Curve_Legend'])

    X_Y_Spline = make_interp_spline(x, test_curve)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Test Curve')

    X_Y_Spline = make_interp_spline(x, min_allowed)
    X_ = np.linspace(min(x), max(x), 500)
    Y_ = X_Y_Spline(X_)
    plt.plot(X_, Y_, label='Min Allowed')

    # plt.plot(x, hitachi, "-b", label="average temp",linewidth=2)
    # plt.plot(x, test_curve, "-c", label="average temp1",linewidth=2)

    plt.axvline(x=data['FL'], color='g', label='F.L.', linewidth=2)
    plt.xlabel('Shaft Power (P2), in kW')
    plt.ylabel('CosØ , in %')
    plt.grid(True)

    major_ticks = np.arange(0, 60, 5)
    minor_ticks = np.arange(0, 60, 5)

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
    plt.legend(bbox_to_anchor = (1.25, 0.6), loc='center right')

    # plt.show()
    #os.remove('C:/wamp64/www/mak_rmc/assets/images/speed_graph.png')

    plt.savefig('C:/wamp64/www/mak_rmc/assets/images/cos_graph.png'
                )
    plt.close()


# returns JSON object as
# a dictionary

while True:
    efficiency_graph()
    speed_graph()
    current_graph()
    cos_graph()
    time.sleep(2)
