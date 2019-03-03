// WeatherStationProDuo.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include "WeatherData.h"

int main()
{
	StationInfo inStation;
	inStation.position = "in";

	StationInfo outStation;
	outStation.position = "out";

	CWeatherData wd(inStation);
	CWeatherDataPro wdPro(outStation);

	CDisplay display;
	CDisplayPro displayPro;

	CStatsDisplay statsDisplay;
	CStatsDisplayPro statsDisplayPro;

	wd.RegisterObserver(display, 1);
	wd.RegisterObserver(statsDisplay, 2);
	wdPro.RegisterObserver(displayPro, 2);
	wdPro.RegisterObserver(statsDisplayPro, 3);

	wd.SetMeasurements(2, 23, 234);
	wdPro.SetMeasurements(5, 64, 543, 3, 90);

    return 0;
}

