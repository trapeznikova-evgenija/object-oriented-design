#include "stdafx.h"
#include "../WeatherStationDuo/Observer.h"
#include "../WeatherStationDuo/WeatherData.h"

using namespace std;

class CTestedObserver : public IObserver<SWeatherInfo>
{
public:
	CTestedObserver(string& position_name)
		:m_position_name(position_name)
	{
	}

private:
	void Update(const SWeatherInfo& data) override
	{
		m_position_name = data.position_name;
	}

	string& m_position_name;
};

TEST_CASE("Supervision over several subjects")
{
	SECTION("Getting a name from the subject")
	{
		CWeatherData wdOutPosition1("out");
		CWeatherData wdInPosition1("in");

		CHECK(wdInPosition1.GetWeatherDataName() == "in");
		CHECK(wdOutPosition1.GetWeatherDataName() == "out");
	}

	SECTION("The observer will know from which subject the notification was received.")
	{
		CWeatherData wdOutPosition2("out");
		CWeatherData wdInPosition2("in");

		string observerPositionName = "";

		CTestedObserver observer1(observerPositionName);
		
		wdOutPosition2.RegisterObserver(observer1, 1);
		wdOutPosition2.NotifyObservers();

		CHECK(observerPositionName == "out");

		wdInPosition2.RegisterObserver(observer1, 1);
		wdInPosition2.NotifyObservers();

		CHECK(observerPositionName == "in");

	}
}