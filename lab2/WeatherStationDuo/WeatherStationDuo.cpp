// WeatherStationDuo.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include "WeatherData.h"


int main()
{
	CWeatherData wdIn;
	wdIn.SetLocationName("in");
	CWeatherData wdOut;
	wdOut.SetLocationName("out");

	CDisplay display(wdIn, wdOut);
	wdIn.RegisterObserver(display, 1);

	CStatsDisplay statsDisplay(wdIn, wdOut);
	wdIn.RegisterObserver(statsDisplay, 2);

	wdIn.SetMeasurements(3, 0.7, 760);
    return 0;
}

