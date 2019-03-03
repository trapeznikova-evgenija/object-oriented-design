#include "stdafx.h"
#include "../WeatherStationDuo/Observer.h"
#include "../WeatherStationDuo/WeatherData.h"

using namespace std;

class CTestedObserver : public IObserver<SWeatherInfo>
{
public:
	CTestedObserver(StationInfo& info)
		:m_stationInfo(info)
	{
	}

private:
	void Update(const SWeatherInfo& data) override
	{
		m_stationInfo = data.stationInfo;
	}

	StationInfo& m_stationInfo;
};

TEST_CASE("Supervision over several subjects")
{
	StationInfo infoIn;
	infoIn.position = "in";

	StationInfo infoOut;
	infoOut.position = "out";

	SECTION("Getting a name from the subject")
	{

		CWeatherData wdOutPosition1(infoOut);
		CWeatherData wdInPosition1(infoIn);

		StationInfo testInfo;

		testInfo = wdInPosition1.GetStationInfo();
		CHECK(testInfo.position == "in");
		testInfo = wdOutPosition1.GetStationInfo();
		CHECK(testInfo.position == "out");
	}

	SECTION("The observer will know from which subject the notification was received.")
	{

		CWeatherData wdOutPosition2(infoOut);
		CWeatherData wdInPosition2(infoIn);

		string observerPositionName = "";

		CTestedObserver observer1(infoOut);
		
		wdOutPosition2.RegisterObserver(observer1, 1);
		wdOutPosition2.NotifyObservers();

		observerPositionName = infoOut.position;

		CHECK(observerPositionName == "out");

		CTestedObserver observer2(infoIn);

		wdInPosition2.RegisterObserver(observer2, 1);
		wdInPosition2.NotifyObservers();

		observerPositionName = infoIn.position;

		CHECK(observerPositionName == "in");
	}
}