// WeatherStationDuo.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include "WeatherData.h"


int main()
{
	StationInfo infoIn;
	infoIn.position = "in";
	CWeatherData wd(infoIn);

	CDisplay display;
	wd.RegisterObserver(display, 1);

	CStatsDisplay statsDisplay;
	wd.RegisterObserver(statsDisplay, 2);

	wd.SetMeasurements(3, 0.7, 760);
    return 0;
}

