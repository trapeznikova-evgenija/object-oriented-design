// 2.1.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include "WeatherData.h"

int main()
{
	CWeatherData wd;

	CDisplay display;
	CStatsDisplay statsDisplay;
	wd.RegisterObserver(display, 3);
	wd.RegisterObserver(statsDisplay, 1);

	wd.SetMeasurements(3, 0.7, 760, 10, 90);
	wd.SetMeasurements(4, 0.8, 761, 7, 170);

    return 0;
}

