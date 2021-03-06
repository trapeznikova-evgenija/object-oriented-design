// WeatherStationProInterestingEvents.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include "WeatherData.h";
#include "InterestEvents.h"

int main()
{
	CWeatherData wd;
	CDisplay display;

	InterestingEvents events;
	events.PushEvent("temperature");
	events.PushEvent("pressure");

	wd.RegisterObserver(display, 3, events);

    return 0;
}

