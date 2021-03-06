// WeatherStationProDuo.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include "WeatherData.h"

int main()
{

	CWeatherData wdIn;
	wdIn.SetLocationName("in");
	CWeatherDataPro wdOut;
	wdOut.SetLocationName("out");

	CDisplay display(wdIn, wdOut);

	CStatsDisplay statsDisplay;
	CStatsDisplayPro statsDisplayPro;

	wdIn.RegisterObserver(display, 1);
	wdIn.RegisterObserver(statsDisplay, 2);
	wdOut.RegisterObserver(display, 2);
	wdOut.RegisterObserver(statsDisplayPro, 3);

	wdIn.SetMeasurements(2, 23, 234);
	wdOut.SetMeasurements(5, 64, 543, 3, 90);

    return 0;
}

