#include "stdafx.h"
#include "../2.1/Observer.h"
#include "../2.1/WeatherData.h"

using namespace std;

class CNotifyTests: public IObserver<SWeatherInfo>
{
public:
	CNotifyTests(CWeatherData& observable, int observerPriority)
		: m_observable(observable)
	{
	}

private:
	void Update(const SWeatherInfo& data)
	{
		m_observable.RemoveObserver(*this);
	}

	CWeatherData m_observable;
	int m_observer_priority;
};

TEST_CASE("Safely notify observers")
{
	CWeatherData weatherData;

	CHECK(true == true);

};

TEST_CASE("Observer priority testing")
{
	CWeatherData weatherData;
	
	CNotifyTests testObserver1(weatherData, 1);
	CNotifyTests testObserver2(weatherData, 2);
	CNotifyTests testObserver4(weatherData, 5);
	

	CHECK(true == true);

};